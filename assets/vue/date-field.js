Vue.component('date-field', {
	props: ['value', 'name', 'type'],
	methods: {
		init: function (){
			var self = this;
			var calander_type =  (this.type == null) ? 'date': this.type;
			$(this.$el).calendar({
				type: calander_type, 
				formatter: {
					date: function (date, settings) {
						if (!date) return '';
						var day = date.getDate();
						var month = date.getMonth() + 1;
						var year = date.getFullYear();
						return year + '-' + month + '-' + day;
					}
				},
				onChange: function (date, text, mode){
					self.updateValue(text);
				}
			});
		},
		updateValue: function (value) {
			this.$emit('input', value);
		}
	},
	mounted: function () {
		this.init();
	},
	template: '<div class="ui calendar left icon input">\
					<input \
						v-bind:value="value" \
						v-on:input="updateValue($event.target.value)"\
						v-bind:name="name" placeholder="Date" type="text" >\
					<i class="calendar icon"></i>\
				</div>'
});