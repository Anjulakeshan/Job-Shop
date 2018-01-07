<?php
class Received extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('received_model');
		$this->load->library("Aauth");
		if(!$this->aauth->is_loggedin()) redirect('/login');
    }

    function index() {
		$data['title'] = 'Received Jobs';
		$data['count_received'] = $this->received_model->get_all_received_jobs_count();
		$data['count_pending'] = $this->received_model->get_all_pending_jobs_count();
		$data['received_date'] = $this->received_model->received_first_date();
		$data['pending_date'] = $this->received_model->pending_first_date();
		
		$data['_view'] = 'received/index';
		$this->load->view('layouts/main',$data);
    }
	function received_jobs(){
		$data['title'] = 'Received Jobs';
		$data['count'] = $this->received_model->get_all_received_jobs_count();
		
		$data['_view'] = 'received/received';
		$this->load->view('layouts/main',$data);
	}
	function pending_jobs(){
		$data['title'] = 'Pending Jobs';
		$data['count'] = $this->received_model->get_all_pending_jobs_count();
		
		$data['_view'] = 'received/pending';
		$this->load->view('layouts/main',$data);
	}
}