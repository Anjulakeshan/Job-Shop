<?php
class Received_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
/*
 *Functions for pending jobs
 */
	function get_pending_job($id){
		$this->db->where('state', 'pending');
		$this->db->where('id', $id);
		return $this->db->get('jobs')->row_array();
	}
	function get_pending_jobs(){
		$this->db->order_by('date', 'desc');
		return $this->db->get_where('jobs',array('state'=>'pending'))->result_array();
	}
	function get_paged_pending_jobs($offset=0, $count=500){
		$this->db->order_by('date', 'desc');
		$this->db->limit($count, $offset);
		return $this->db->get_where('jobs',array('state'=>'pending'))->result_array();
	}
	function get_all_pending_jobs_count(){
		$this->db->from('jobs');
		$this->db->where('state', 'pending');
		return $this->db->count_all_results();
	}
	function pending_first_date(){
		$query = $this->db->query("SELECT min(date) as date FROM jobs WHERE state='pending'");
		
		return $query->row_array()['date'];
	}
	
/*
 *Functions for received jobs
 */
	function get_received_job($id){
		$this->db->where('state', 'received');
		$this->db->where('id', $id);
		return $this->db->get('jobs')->row_array();
	}
	function get_received_jobs(){
		$this->db->order_by('date', 'desc');
		return $this->db->get_where('jobs',array('state'=>'received'))->result_array();
	}
	function get_paged_received_jobs($offset=0, $count=500){
		$this->db->order_by('date', 'desc');
		$this->db->limit($count, $offset);
		return $this->db->get_where('jobs',array('state'=>'received'))->result_array();
	}
	function get_all_received_jobs_count(){
		$this->db->from('jobs');
		$this->db->where('state', 'received');
		return $this->db->count_all_results();
	}
	function accept_received($id, $customer, $material, $height, $width, $length, $colour, $user_description, $date, $quantity, $budget, $tax, $discount, $amount, $admin_description, $state){
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
	function received_first_date(){
		$query = $this->db->query("SELECT min(date) as date FROM jobs WHERE state='received'");
		
		return $query->row_array()['date'];
	}
}
