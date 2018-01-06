Vue.component('confirmation-dialog', {
	props: ['onOk'],
	data: function () {
		return { title: '', text : '', btnText: 'Ok', btnCol: 'blue', object: null };
	},
	methods: { 
		show: function (title, text, btnText, btnCol, data) {
			var self = this;
			this.title = title;
			this.text = text;
			this.btnText = btnText;
			this.btnCol = btnCol;
			this.object = data;
			$(this.$el).modal({}).modal({ 
				onApprove: function(){
					self.onOk(self.object);
				}
			}).modal('setting', 'closable', false).modal('show');
		}
	},
	template: '<div class="ui small modal" id="confirmation-dialog">\
				<div class="header">{{ title }}</div>\
					<div class="content">\
						<p>{{ text }}</p>\
					</div>\
					<div class="actions">\
						<div class="ui approve button" v-bind:class="btnCol">{{ btnText }}</div>\
						<div class="ui cancel button">Cancel</div>\
					</div>\
				</div>'
});

Vue.component('message-dialog', {
	data: function () {
		return { title: '', text : '', type: 'error'};
	},
	methods: { 
		show: function (title, text, type) {
			var self = this;
			this.title = title;
			this.text = text;
			this.type = type;
			$(this.$el).modal('show');
		}
	},
	template: '<div class="ui small modal" id="message-dialog">\
				<div class="header">{{ title }}</div>\
					<div class="content">\
						<p>{{ text }}</p>\
					</div>\
					<div class="actions">\
						<div class="ui approve blue button">Ok</div>\
					</div>\
				</div>'
});