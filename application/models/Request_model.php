<?php
class Request_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_requested_job($id){
		$this->db->where('state', 'request');
		$this->db->where('id', $id);
		return $this->db->get('jobs')->row_array();
	}
	function get_requested_jobs(){
		$this->db->order_by('date', 'desc');
		return $this->db->get_where('jobs',array('state'=>'request'))->result_array();
	}
	function get_paged_requested_jobs($offset=0, $count=500){
		$this->db->order_by('date', 'desc');
		$this->db->limit($count, $offset);
		return $this->db->get_where('jobs',array('state'=>'request'))->result_array();
	}
	function get_all_requested_jobs_count(){
		$this->db->from('jobs');
		$this->db->where('state', 'request');
		return $this->db->count_all_results();
	}
	function accept_request($id, $customer, $material, $height, $width, $length, $colour, $user_description, $date, $quantity, $budget, $tax, $discount, $amount, $admin_description, $state){
		$data = array(
			'customer' => $customer,
			'material' => $material,
			'height' => $height,
			'width' => $width,
			'length' => $length,
			'colour' => $colour,
			'user_description' => $user_description,
			'date' => $date,
			'quantity' => $quantity,
			'budget' => $budget,
			'tax' => $tax,
			'discount' => $discount,
			'amount' => $amount,
			'admin_description' => $admin_description,
			'state' => $state);
		$this->db->where('id', $id);
		return $this->db->update('jobs', $data);
	}
}
