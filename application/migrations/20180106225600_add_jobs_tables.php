<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_jobs_tables extends CI_Migration {

	public function up()
	{    
		$job_infor = array(
			'id' => array( 'type' => 'INT', 'auto_increment' => TRUE),
			'customer' => array( 'type' => 'INT', 'constraint' => 11),
			'material' => array('type' => 'VARCHAR', 'constraint' => 64),
			'height' => array( 'type' => 'decimal', 'constraint' => '10,3'),
			'width' => array( 'type' => 'decimal', 'constraint' => '10,3'),
			'length' => array( 'type' => 'decimal', 'constraint' => '10,3'),
			'colour' => array( 'type' => 'VARCHAR', 'constraint' => 20),
			'user_description' => array( 'type' => 'VARCHAR', 'constraint' =>250),
			'date' => array( 'type' => 'DATE'),
			'quantity' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'budget' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'tax' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'discount' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'amount' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'admin_description' => array( 'type' => 'VARCHAR', 'constraint' => 250),
			'state' => array( 'type' => 'enum("request", "pending", "received", "reject", "in_progress", "complete", "distpatch")')
		);
		$this->dbforge->add_field($job_infor);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('jobs');
 
		$jobin_progress = array(
			'id' => array( 'type' => 'INT', 'auto_increment' => TRUE),
			'job' => array( 'type' => 'INT', 'constraint' => 11),
			'customer' => array( 'type' => 'INT', 'constraint' => 11),
			'date' => array( 'type' => 'DATE'),
			'progress_state' => array( 'type' => 'VARCHAR', 'constraint' => 64),
			'note' => array( 'type' => 'VARCHAR', 'constraint' => 250),
			
		);
		$this->dbforge->add_field($jobin_progress);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('job_progress'); 

	}

	public function down()
	{
		$this->dbforge->drop_table('jobs');
		$this->dbforge->drop_table('job_progress');
	}
}

?>
