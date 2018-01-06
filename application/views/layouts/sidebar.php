<div class="ui computer only fixed inverted vertical menu" id="sidebar">
    
	<div class="item" style="height: 150px">
		<span class="ui image"><img src="<?=base_url('assets/img/logo.png')?>"/></span>
		<h3 class="ui inverted header">Hello <?=$this->session->userdata('username'); ?> !</h3>
	</div>
	<div class="ui divider"></div>
	<a class="item" style="font-size: 16.5px" href="<?php echo base_url(''); ?>"><i class="large dashboard icon"></i>Dashboard</a>
	<a class="item" style="font-size: 16.5px" href="<?php echo base_url(''); ?>"><i class="large send icon"></i>Inbound Requests</a>
	<a class="item" style="font-size: 16.5px" href="<?php echo base_url(''); ?>"><i class="large in cart icon"></i>Received Jobs</a>
	<a class="item" style="font-size: 16.5px" href="<?php echo base_url(''); ?>"><i class="large remove circle icon"></i>Rejected Jobs</a>
	<a class="item" style="font-size: 16.5px" href="<?php echo base_url(''); ?>"><i class="large write icon"></i>Jobs in Progress</a>
	<a class="item" style="font-size: 16.5px" href="<?php echo base_url(''); ?>"><i class="large credit card alternative icon"></i>Ready to Dispatch</a>
	<a class="item" style="font-size: 16.5px" href="<?php echo base_url(''); ?>"><i class="large check mark icon"></i>Completed Jobs</a>

	<div class="ui divider"></div>
	<?php if($this->aauth->is_admin()){ ?>
	<a class="item" href="<?php echo base_url('users'); ?>"><i class="user icon"></i>Users</a>
	<?php } ?>
	<a class="item" href="<?php echo base_url('settings'); ?>"><i class="settings icon"></i>Settings</a>
	<a class="item" href="<?php echo base_url('logout'); ?>">Logout</a>
</div>