<?php
class Dashboard extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->library("Aauth");
		if(!$this->aauth->is_loggedin()) redirect('/login');
    }

    function index() {
		
		$data['_view'] = 'home/dashboard';
		$this->load->view('layouts/main',$data);
    }

	function backup() {
		$this->load->dbutil();
		$prefs = array(     
				'format'      => 'zip',             
				'filename'    => 'firo_backup.sql'
			  );
		$backup =$this->dbutil->backup($prefs); 
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'files/'.$db_name;

		$this->load->helper('file');
		write_file($save, $backup); 

		$this->load->helper('download');
		force_download($db_name, $backup); 
	}
}
