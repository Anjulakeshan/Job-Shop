<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_jobs_tables extends CI_Migration {

	public function up()
	{    
		$job_infor = array(
			'job_code' => array( 'type' => 'INT', 'auto_increment' => TRUE),
			'type_of_material' => array('type' => 'VARCHAR', 'constraint' => 64),
			'height' => array( 'type' => 'VARCHAR', 'constraint' => 20),
			'width' => array( 'type' => 'VARCHAR', 'constraint' => 20),
			'length' => array( 'type' => 'VARCHAR', 'constraint' => 20),
			'colour' => array( 'type' => 'VARCHAR', 'constraint' => 20),
			'user_description' => array( 'type' => 'VARCHAR', 'constraint' =>250),
			'dateval' => array( 'type' => 'VARCHAR', 'constraint' => 20),
			'user_budget' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'discount' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'amount' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'tax' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'quantity' => array( 'type' => 'decimal', 'constraint' => '10,2'),
			'admin_description' => array( 'type' => 'VARCHAR', 'constraint' => 250),
			'state' => array( 'type' => 'VARCHAR', 'constraint' => 20)
		);
		$this->dbforge->add_field($job_infor);
		$this->dbforge->add_key('job_code', TRUE);
		$this->dbforge->create_table('job_infor');
 
		$jobin_progress = array(
			'id' => array( 'type' => 'INT', 'auto_increment' => TRUE),
			'jobcode' => array( 'type' => 'VARCHAR', 'constraint' => 64),
			'user_id' => array( 'type' => 'VARCHAR', 'constraint' => 64),
			'progress_state' => array( 'type' => 'VARCHAR', 'constraint' => 64),
			'de_date' => array( 'type' => 'VARCHAR', 'constraint' => 20),
			'progress_state' => array( 'type' => 'VARCHAR', 'constraint' => 64),
			'note' => array( 'type' => 'VARCHAR', 'constraint' => 250),
			
		);
		$this->dbforge->add_field($jobin_progress);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('jobin_progress'); 

	}

	public function down()
	{
		$this->dbforge->drop_table('job_infor');
		$this->dbforge->drop_table('jobin_progress');
	}
}

?>
