<?php 

class User_model extends CI_model{
	
	public function __construct() {
		parent::__construct();
		$this->load->library("Aauth");
	}
	
	public function login($identifier, $pass, $remember){
		return $this->aauth->login($identifier, $pass, $remember);
	}

	public function add_user($username, $pass , $email){
		$id	= $this->aauth->create_user($email, $pass, $username);
		return $id;
	}

	public function update_user($id, $email){
		$data = array('email'  => $email);
		$this->db->where('id', $id);
		$this->db->update('aauth_users', $data);
	}
	public function update_user_name($id ,$name){
		$data = array('name'  => $name);
		$this->db->where('id', $id);
		$this->db->update('aauth_users', $data);
	}
	
	public function remove_user($userid){
		$this->aauth->delete_user($userid);
	}

	public function get_users(){
		$this->db->select('id, username, email');
		$this->db->from('aauth_users');
		$query = $this->db->get();
		return $query ->result_array();
	}
}

?>
