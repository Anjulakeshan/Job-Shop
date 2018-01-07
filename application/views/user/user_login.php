<?php  $this->load->view('templates/header'); ?>

<div class="ui middle aligned grid" id="login_grid">
	<div class="red row">
		<div class="five wide column"></div>
		<div class="center aligned six wide column">
			<div class="ui image"><img src="<?=base_url('assets/img/logo.png' )?>"/></div>
			
			<div class="ui left aligned segment" style="background-color: #9E93A1">
				<?php  if($failed==1){ ?>
				<div class="ui warning message">
					<div class="header">Invalied username or Password</div>
				</div>
				<?php }?>
				<form class="ui large form" action="" method="post">
					<div class="field">
						<label class="ui header"><i class="user icon"></i>Username</label>
						<input name="username" placeholder="Username" type="text">
					</div>
					<div class="field">
						<label class="ui header"><i class="privacy icon"></i>Password</label>
						<input name="password" placeholder="Password" type="password">
					</div>
					<div class="field">
						<div class="ui checkbox">
							<input tabindex="0" type="checkbox" name="remember">
							<label>Remember Me</label>
						</div>
					</div>
					<button class="ui blue button" type="submit">Login</button>
				</form>
			</div>
		</div>
		<div class="five wide column"></div>
	</div>
</div>
<script type="text/javascript">
	$('.ui.form').form({
		fields: {
			username : 'empty',
			password : ['minLength[6]', 'empty'],
		}
	});
</script>

<?php $this->load->view('templates/footer'); ?>