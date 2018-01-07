<?php
class Request extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->model('request_model');
		$this->load->library("Aauth");
		if(!$this->aauth->is_loggedin()) redirect('/login');
    }

    function index() {
		$data['title'] = 'Inbound Requests';
		$data['count'] = $this->request_model->get_all_requested_jobs_count();
		//$data['requests'] = $this->request_model->get_requested_jobs();
		//$data['customers'] = $this->customer_model->get_customers();
		
		$data['_view'] = 'request/index';
		$this->load->view('layouts/main',$data);
    }
}
