<?php
/* 
 * API controller for Received and all related things
 */
class Received extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('received_model');
		$this->load->library("Aauth");
		if(!$this->aauth->is_loggedin()) redirect('/login');
	}
/*
 * Functions for projects
 */
	function get_received(){
		$offset = $this->input->post('offset');
		$count = $this->input->post('count');
		$response =  array('status' => 1, 'detail' => '');
		$response['detail'] = array(
			'receives' => $this->received_model->get_paged_received_jobs($offset, $count),
			'count' => $this->received_model->get_all_received_jobs_count()
		);
		$data['json'] = $response;
		$this->load->view('layouts/json',$data);
	}
	function accept_received(){
		$response =  array('status' => 1, 'detail' => '');
		
		$id = $this->input->post('id');
		$customer = $this->input->post('customer');
		$material = $this->input->post('material');
		$height = $this->input->post('height');
		$width = $this->input->post('width');
		$length = $this->input->post('length');
		$colour = $this->input->post('colour');
		$user_description = $this->input->post('user_description');
		$date = $this->input->post('date');
		$quantity = $this->input->post('quantity');
		$budget = $this->input->post('budget');
		$tax = $this->input->post('tax');
		$discount = $this->input->post('discount');
		$amount = $this->input->post('amount');
		$admin_description = $this->input->post('admin_description');
		$state = $this->input->post('state');

		if($id != null && $customer != null && $date != null && $material != null && $quantity != null){
			$this->received_model->accept_received($id, $customer, $material, $height, $width, $length,
													$colour, $user_description, $date, $quantity,
													$budget, $tax, $discount, $amount, $admin_description, $state );
		}
		else $response['status'] = 0;
		$data['json'] = $response;
		$this->load->view('layouts/json',$data);
	}
}