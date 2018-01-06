<div class="ui computer only fixed inverted vertical menu" id="sidebar">
    
    <div class="item">
		Hello <?=$this->session->userdata('username'); ?> !
	</div>
	<div class="ui divider"></div>
	<a class="item" href="<?php echo base_url(''); ?>"><i class="block layout icon"></i>Dashboard</a>

	<div class="ui divider"></div>
	<?php if($this->aauth->is_admin()){ ?>
	<a class="item" href="<?php echo base_url('users'); ?>"><i class="user icon"></i>Users</a>
	<?php } ?>
	<a class="item" href="<?php echo base_url('settings'); ?>"><i class="settings icon"></i>Settings</a>
	<a class="item" href="<?php echo base_url('logout'); ?>">Logout</a>
</div>