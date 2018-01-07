Vue.component('received-table', {
	props: ['receives', 'onSend'],
	methods: {
		onSendClick: function (receive) {
			this.onSend(receive);
		}
	},
	template: '<div>\
					<table class="ui celled table">\
						<thead><tr>\
							 <th>Customer</th> <th>Product</th> <th>Colour</th> <th>Quantity</th> <th>Requested Date</th> <th>Amount</th> <th>Action</th>\
						</tr></thead>\
						<tbody>\
							<tr v-for="receive in receives">\
								<td><a class="ui small label">{{ receive.customer }}</a></td>\
								<td>{{ receive.material }}</td>\
								<td>{{ receive.colour }}</td>\
								<td>{{ receive.quantity }}</td>\
								<td>{{ receive.date }}</td>\
								<td>{{ receive.amount }}</td>\
								<td>\
									<a class="ui mini green button" v-on:click="onSendClick(receive)"><i class="send outline icon"></i>Ready to Process</a>\
								</td>\
							</tr>\
						</tbody>\
					</table>\
					<message-dialog ref="msgdialog"></message-dialog>\
				</div>'
});

Vue.component('received-add', {
	props: ['onAdd', 'receives'],
	data: function () {
		return { id: null, customer: 0, material: '', height: 0, width: 0, length: 0, colour: '', user_description: '',
		date: DATE_TODAY, quantity: 0, budget: 0, tax: 0, discount: 0, admin_description: '', amount: 0,
		state: 'in_progress', busy : false, showAdd : true};
	},
	methods: { 
		init: function (id, customer, material, height, width, length, colour, user_description, date, quantity, budget, tax, discount, amount, admin_description, state, showAdd) {
			this.id = id;
			this.customer = customer; this.material = material;
			this.height = height; this.width = width;
			this.length = length; this.colour = colour;
			this.user_description = user_description; this.date = date;
			this.quantity = quantity; this.budget = budget;
			this.tax = tax; this.discount = discount;
			this.amount = amount; this.admin_description = admin_description;
			this.state = state; this.showAdd = showAdd;
			
			var datefield = this.$refs.datefield;	//hacky way of making sure calendar initialized
			setTimeout(function () { datefield.init(); }, 1001);
		},
		add: function () {
			if(!this.isFormValid()) return;	//validate form
			var data = { id: this.id, customer : this.customer, material : this.material, height : this.height,
				width : this.width, length : this.length, colour : this.colour, user_description : this.user_description,
				date : this.date, quantity : this.quantity, budget : this.budget, tax : this.tax,
				discount : this.discount, amount : this.amount, admin_description : this.admin_description, state : this.state,
				new: 1*this.showAdd };
			this.busy = true;
			this.$http.post(AJAX_ROOT+'received/accept_received', data).then(response => {
				this.busy = false;
				if(response.body.status <=0) this.$refs.msgdialog.show('An Error Occured', response.body.detail, 'error');
				else{
					this.onAdd();
				}
			}, response => { // error callback
				this.busy = false;
			});
		},
		isFormValid: function () {
			return $(this.$el).form('validate form');
		}
	},
	mounted: function () {	//validation rules set when compponent mounted in dom
		$(this.$el).form({
			fields: { id : 'empty', customer : 'minLength[1]', date : 'minLength[8]', amount : 'decimal', state : 'in_progress'}
		});
		$(this.$el).find('.ui.dropdown').dropdown();
	},
	template: '<form class="ui form" id="request-add" onsubmit="return false;" v-on:keydown.enter="add">\
				<div class="two fields">\
					<div class="field">\
						<label for="customer">Customer</label>\
						<input type="text" v-model="customer" name="customer" disabled>\
					</div>\
					<div class="field" >\
						<label for="date">Requested Date</label>\
						<div class="ui calender input left icon" >\
							<i class="calendar icon"></i>\
							<date-field v-model="date" v-bind:name="\'date\'" ref="datefield"></date-field>\
						</div>\
					</div>\
				</div>\
				<div class="field">\
					<label for="material">Material</label>\
					<input v-model="material" type="text" name="material">\
				</div>\
				<div class="field">\
					<label for="height">Height</label>\
					<input v-model="height" type="text" name="height">\
					<label for="width">Width</label>\
					<input v-model="width" type="text" name="width">\
					<label for="length">Length</label>\
					<input v-model="length" type="text" name="length">\
				</div>\
				<div class="field">\
					<label for="colour">Colour</label>\
					<input v-model="colour" type="text" name="colour">\
					<label for="quantity">Quantity</label>\
					<input v-model="quantity" type="text" name="quantity">\
				</div>\
				<div class="field">\
					<label for="user_description">User Description</label>\
					<input v-model="user_description" type="text" name="user_description" disabled>\
				</div>\
				<div class="field">\
					<label for="budget">Budget</label>\
					<input v-model="budget" type="text" name="budget">\
					<label for="tax">Tax</label>\
					<input v-model="tax" type="text" name="tax">\
					<label for="discount">Discount</label>\
					<input v-model="discount" type="text" name="discount">\
				</div>\
				<div class="field">\
					<label for="amount">Amount</label>\
					<input v-model="amount" type="text" name="amount" disabled>\
				</div>\
				<div class="field">\
					<label for="admin_description">Admin Description</label>\
					<input v-model="admin_description" type="text" name="admin_description" disabled>\
				</div>\
				<div class="field" v-if="showAdd">\
					<div v-on:click="add" class="ui primary button">Process</div>\
				</div>\
				<div v-if="busy" class="ui active inverted dimmer"><div class="ui text loader">Saving</div></div>\
				<message-dialog ref="msgdialog"></message-dialog>\
			</form>'
});

Vue.component('received-accept', {
	props: ['onUpdate','receives'],
	data: function () {
		return { id: null, customer: 0, material: '', height: 0, width: 0, length: 0, colour: '', user_description: '',
		date: DATE_TODAY, quantity: 0, budget: 0, tax: 0, discount: 0, admin_description: '', amount: 0,
		state: 'in_progress', busy : false };
	},
	methods: { 
		showDialog: function (receive) {
			var editfield = this.$refs.editfield;
			editfield.init(receive.id, receive.customer, receive.material, receive.height, receive.width, receive.length, receive.colour,
				receive.user_description, receive.date, receive.quantity, receive.budget, receive.tax, receive.discount, receive.amount,
				receive.admin_description, 'in_progress', false);
			$(this.$el).modal({}).modal({ 
				onApprove: function(){
					editfield.add();
					return false;
				}
			}).modal('setting', 'closable', false).modal('show');
		},
		closeDialog: function (receive) {
			this.onUpdate();
			$(this.$el).modal({}).modal('hide');
		}
	},
	template: '<div class="ui small modal" id="received-accept">\
				<div class="header">Ready to process the job</div>\
					<div class="content">\
						<received-add v-bind:on-add="closeDialog" :receives="receives" ref="editfield"></received-add>\
					</div>\
					<div class="actions">\
						<div class="ui blue approve button">Process</div>\
						<div class="ui cancel button">Cancel</div>\
					</div>\
				</div>'
});