<div class="ui computer only fixed inverted vertical labeled icon menu" id="sidebar" style="padding-right: 35px;">
    
	<div class="item" style="height: 50px; padding-right: 60px;">
		<span class="ui image"><img src="<?=base_url('assets/img/logo.png')?>"/ height="70" width="100"></span>
		
	</div>
	<h3 class="ui inverted small header">Hello <?=$this->session->userdata('username'); ?> !</h3>
	<div class="ui divider" style="padding-right: 60px"></div>
	<a class="item" style="font-size: 13px; padding: 8px;" href="<?php echo base_url(''); ?>"><i class="large dashboard icon"></i>Dashboard</a>
	<a class="item" style="font-size: 13px; padding: 8px;" href="<?php echo base_url('requests'); ?>"><i class="large send icon"></i>Inbound Requests</a>
	<a class="item" style="font-size: 13px; padding: 8px;" href="<?php echo base_url('received'); ?>"><i class="large in cart icon"></i>Received Jobs</a>
	<a class="item" style="font-size: 13px; padding: 8px;" href="<?php echo base_url('rejected'); ?>"><i class="large remove circle icon"></i>Rejected Jobs</a>
	<a class="item" style="font-size: 13px; padding: 8px;" href="<?php echo base_url('in_progress'); ?>"><i class="large write icon"></i>Jobs in Progress</a>
	<a class="item" style="font-size: 13px; padding: 8px;" href="<?php echo base_url('dispatch'); ?>"><i class="large credit card alternative icon"></i>Ready to Dispatch</a>
	<a class="item" style="font-size: 13px; padding: 8px;" href="<?php echo base_url('completed'); ?>"><i class="large check mark icon"></i>Completed Jobs</a>

	<div class="ui divider"></div>
	<?php if($this->aauth->is_admin()){ ?>
	<a class="item" href="<?php echo base_url('users'); ?>"><i class="user icon"></i>Users</a>
	<?php } ?>
	<a class="item" style="font-size: 10px; padding: 8px;" href="<?php echo base_url('settings'); ?>"><i class="settings icon"></i>Account Settings</a>
	<a class="item" style="font-size: 10px; padding: 8px;" href="<?php echo base_url('logout'); ?>">Logout</a>
</div>