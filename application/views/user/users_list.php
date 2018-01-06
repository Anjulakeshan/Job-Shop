<script src="<?php echo base_url('assets/js/knockout.js'); ?>"></script>
<div class="ui grid">
	<div class="sixteen wide column">
		<div class="ui segments">
			<div class="ui segment">
				<h3 class="ui header">Users</h3>
			</div>
			<div class="ui  segment">
				<table class="ui celled table">
				   <thead>
					<tr>
						<th>Username</th>
						<th>Email</th>
						<th>Actions</th>
					</tr>
					</thead>
					<tbody class="ui items" data-bind="foreach: users">
						<td class="header" data-bind="text: username"></td>
						<td data-bind="text: email"></td>
						<td>
							<div data-bind="click: $parent.editUser" class="ui mini  primary labeled icon button"><i class="edit icon"></i>Edit</div> 
							<div data-bind="click: $parent.removeUser" class="ui mini red labeled icon button"><i class="erase icon"></i>Delete</div>
						</td>
					</tbody>
				</table>
			</div>
			<div class="ui  segment">
				<button class="ui teal button" id="addnew">Add User</button>
			</div>
		</div>
	</div>
</div>

	<div class="ui small modal">
		<i class="close icon"></i>
		<div class="header" data-bind="text: modalName"></div>

		<div class="content">
			<form class="ui form">
				<div class="field" data-bind="css: {'disabled ' : newUser.editing()}">
					<label>User Name</label>
					<input name="username" placeholder="Username" type="text"  data-bind="value: newUser.username">
				</div>

				<div class="field">
					<label>Email</label>
					<input name="email" placeholder="Email" type="text"  data-bind="value: newUser.email">
				</div>
				
				<div class="field" data-bind="visible: newUser.adding">
					<label>Password</label>
					<input name="newpassword" placeholder="Password" type="password" data-bind="value: newUser.newpassword">
				 </div>

				<div class="field" data-bind="visible: newUser.editing">
					<label>Password</label>
					<input name="editpassword" placeholder="Leave empty to not change" type="password" data-bind="value: newUser.editpassword">
				 </div>
			</form>
		</div>
		
		<div class="actions">
			<div class="ui blue approve button" href="" data-bind="text: modalName">Create</div>
			<div class="ui cancel button">Cancel</div>
		</div>
	</div>

<script type="text/javascript">
	$('.ui.form').form({
		fields: {
			email : ['empty'],
			username : ['empty'],
			newpassword : ['empty' , 'minLength[6]']}
	});

	$('#addnew').click(function(){
		appModel.mode('add');
		appModel.clearNewUser();
		showDialog();
	});

	function showDialog(){
		$('.ui.modal').modal({
			onApprove: function(){
				$('.ui.form').form('validate form');
				if($('.ui.form').form('is valid')) {
					if(appModel.mode() == 'add') appModel.addUser();
					else appModel.updateUser();
				}else return false;
			},onDeny: function(){
				appModel.clearNewUser();
			}
		}).modal('show');
	};
	
	//knockout-------------------------------------
	var json_users = <?=json_encode($users) ?>;
	
	function User(data) {
		var self = this;
		self.id = ko.observable(data.id);
		self.username = ko.observable(data.username);
		self.email = ko.observable(data.email);
		self.avatar = '<?=base_url('files/users/') ?>' + data.id + '.jpg';
		self.link = '<?=base_url('users/') ?>' + data.id;
	}
	
	function AppViewModel() {
		var self = this;
		self.mode = ko.observable('add');
		self.editingUser;
		
		self.newUser = {
			id : -1,
			username : ko.observable(),
			email : ko.observable(),
			newpassword : ko.observable(),
			editpassword : ko.observable(),
			editing : ko.observable(false),
			adding : ko.observable(true)
		};
		self.users = ko.observableArray([]);
		self.modalName = ko.computed(function() {
			return this.mode() == 'add' ? 'Add User' : 'Update User';    
		}, this);
		
		//loading
		var mappedUser = $.map(json_users, function(item) {
			return new User(item);
		});
        self.users(mappedUser);
		
		//actions
		self.addUser = function() {
			var data = {
				username: self.newUser.username(),
				email: self.newUser.email() ,
				password : self.newUser.newpassword };
			
			$.post("<?=base_url('users/ajax_add'); ?>", data, function(result){
				if(result.status == 1){
					data.id = result.detail;
					self.users.push(new User(data));
					self.clearNewUser();
				}
			},'json');
		};
		self.editUser = function(user) {
			self.newUser.id = user.id();
			self.newUser.username(user.username());
			self.newUser.email(user.email());
			self.newUser.newpassword('********');
			self.newUser.editpassword('');
			self.newUser.editing(true);
			self.newUser.adding(false);

			self.mode('edit');
			self.editingUser = user;
			showDialog();
		}
		self.updateUser = function(user) {
			self.editingUser.email(self.newUser.email());
			
			var data = {
				id: self.newUser.id,
				email: self.newUser.email() ,
				password : self.newUser.editpassword() };
			
			$.post("<?=base_url('users/ajax_update'); ?>", data, function(result){
				if(result.status == 1){
					self.clearNewUser();
				}
			},'json');
		}
		self.removeUser = function(user) {
			self.users.remove(user);
			$.post("<?=base_url('users/ajax_remove'); ?>", {id: user.id}, function(result){
			});
		}
		self.clearNewUser = function() { 
			self.newUser.id = -1;
			self.newUser.username('');
			self.newUser.email('');
			self.newUser.newpassword('');
			self.newUser.editpassword('');
			self.newUser.editing(false);
			self.newUser.adding(true);
		}
	}
	
	var appModel = new AppViewModel();
	ko.applyBindings(appModel);
</script>







