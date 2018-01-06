<div class="ui grid">
	<div class="eight wide column">
		<div class="ui segments">
			<div class="ui segment">
				<h3 class="ui header">Change Password</h3>
			</div>
			<div class="ui segment">
				<form class="ui form" action="" method="post">
					<div class="field">
						<label>Password</label>
						<input name="password" placeholder="New Password" type="password">
					</div>

					<div class="field">
						<label>Confirm-Password</label>
						<input name="compassword" placeholder="Confirm Password" type="password">
					</div>

					<button class="ui blue button" type="submit">Change Password</button>
				</form>
			</div>
		</div>
	</div>
	<div class="eight wide column">
		<div class="ui segments">
			<div class="ui segment">
				<h3 class="ui header">Backup</h3>
			</div>
			<div class="ui segment">
			<p>Backup your data frequently to avoid data loss in an emergency.</p>
				<a class="ui blue button" href="backup">Download</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.ui.form').form({
		fields: {
			password : ['minLength[6]', 'empty'],
			compassword : ['minLength[6]', 'match['password']']
		}
	});
</script>