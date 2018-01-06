<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Default_admin extends CI_Migration {

	public function up()
	{
		$this->load->library('aauth');
		$this->aauth->create_user('admin@admin.com', '123456', 'admin');
		$this->aauth->add_member(1 , 'Admin');
	}

	public function down()
	{
	}
}
?>