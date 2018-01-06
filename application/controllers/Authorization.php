<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library("Aauth");
	}

	public function login(){
		$data['title'] = 'User Login';
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$remember = ($this->input->post('remember')=='on') ? true: false;


		if(($user!=null) && ($pass!=null)){
			$this->load->model('user_model');
			$result = $this->user_model->login($user , $pass,$remember);
			if($result){
			 redirect();
			}else{
				$data = array('failed' => 1 );
				$this->load->view('user/user_login',$data);
			}

		}else{
			$data = array('failed' => 0 );
			$this->load->view('user/user_login',$data);
		}
		
	}

	public function logout(){
		$this->load->library("Aauth");
		$this->aauth->logout();
		redirect('/login');
	}

	public function settings(){
		if(!$this->aauth->is_loggedin()) redirect('/login');
		
		$password =	   $this->input->post('password');
		if($password!=null){
			$user_id = $this->aauth->get_user_id();
			$this->aauth->update_user($user_id , FALSE , $password , FALSE );
		}

		$status = array('upload_error' => false, );
		if(!isset($_FILES['file']) || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE) {

		}else{
			$userid=$this->aauth->get_user_id();
			$config['upload_path']          = './files/users/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 4000;
			$config['max_width']            = 600;
			$config['max_height']           = 600;
			$config['overwrite']           = true;
			$config['file_name']           = $userid . ".jpg";
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file')) {
				$status['upload_error'] = true;
			}else{
				$img_config['image_library'] = 'gd2';
				$img_config['source_image'] = './files/users/'.$userid . ".jpg";
				//$img_config['create_thumb'] = TRUE;
				$img_config['maintain_ratio'] = TRUE;
				$img_config['width']         = 256;
				$img_config['height']       = 256;

				$this->load->library('image_lib', $img_config);
				$this->image_lib->resize();
			}
		}

		$data['upload_error'] = $status['upload_error'];
		$data['title'] = 'Settings';
		$data['_view'] = 'user/user_settings';
         $this->load->view('layouts/main',$data);
	}

}