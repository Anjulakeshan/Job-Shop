<?php

class Users extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library("Aauth");
		if(!$this->aauth->is_admin()) redirect('/');
	} 
	
	public function index(){
		$this->load->model('user_model');
		
		$data['users'] = $this->user_model->get_users();
		$data['title'] = 'Users';
		
		$data['_view'] = 'user/users_list';
        $this->load->view('layouts/main',$data);
	}
	
	public function ajax_add(){
		$response =  array('status' => 0, 'detail' => '');
		
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if(($email!=null) && ($username!=null) && ($password!=null)){
			$this->load->model('user_model');
			$id = $this->user_model->add_user($username, $password, $email);
			$this->aauth->add_member($id , 'Default');
			copy('assets/img/avatar.jpg' , 'files/users/'.$id.'.jpg');
			$response['status'] = 1;
			$response['detail'] = $id;
		}else{
			$response['detail'] = 'invalid data';
		}
		
		$data['json'] = $response;
		$this->load->view('templates/json', $data);
	}

	public function ajax_remove(){
		$response =  array('status' => 0, 'detail' => '');
		
		$id = $this->input->post('id');
		
		if($id!=null){
			$this->load->model('user_model');
			$this->user_model->remove_user($id);
		}else{
			$response['detail'] = 'invalid data';
		}
		
		$data['json'] = $response;
		$this->load->view('templates/json', $data);
	}
	
	public function ajax_update(){
		$response =  array('status' => 0, 'detail' => '');
		
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		if(($id!=null) && ($email!=null)){
			$this->load->model('user_model');
			$this->user_model->update_user($id, $email);
			
			if($password != null && $password != ''){	//password has changed
				$this->aauth->update_user($id, FALSE, $password, FALSE);
			}
			$response['status'] = 1;
		}else{
			$response['detail'] = 'invalid data';
		}
		
		$data['json'] = $response;
		$this->load->view('templates/json', $data);
	}
}