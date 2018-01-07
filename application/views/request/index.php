<script src="<?=base_url('assets/js/calendar.min.js'); ?>"></script>
<script src="<?=base_url('assets/js/vue.js'); ?>"></script>
<script src="<?=base_url('assets/js/vue-resource.js'); ?>"></script>
<script src="<?=base_url('assets/vue/config.js'); ?>"></script>
<script src="<?=base_url('assets/vue/confirmation-dialog.js'); ?>"></script>
<script src="<?=base_url('assets/vue/date-field.js'); ?>"></script>
<script src="<?=base_url('assets/vue/requests.js'); ?>"></script>

<div id="app">
	<div class="fire horizontal menubar">
		<span class="ui header">Inbound Requests</span>
	</div>
	<div class="ui grid" >
		<div class="sixteen wide column">
			<div class="ui segments">
				<div class="ui segment">
					<div class="ui grid">
						<div class="twelve wide column"><h3 class="ui header">Customer's Requested Jobs</h3></div>
					</div>
				</div>
				<div class="ui segment">
					<requests-table 
						v-bind:on-edit="showEditDialog"
						v-bind:on-delete="refreshData"
						:requests="requests">
					</requests-table>
				</div>
				<div class="ui segment">
					<a v-for="i in pages" class="ui label" v-bind:class="{teal: (i == current_page)}"  v-on:click="setPage(i)">{{ i }}</a>
				</div>
			</div>
		</div>
		<requests-accept v-bind:on-update="refreshData" v-bind:on-add="refreshData" :requests="requests" ref="editdialog"></requests-accept>
	</div>
</div>

<script>
	var PER_PAGE = 3;
	var app = new Vue({
		el: '#app',
		data: {
			requests: [],
			pages: Math.ceil(<?=$count?>/PER_PAGE),
			addVisibility: 'hidden',
			current_page: 1
		},
		methods: { 
			onDelete: function () { alert('onDelete'); },
			refreshData: function () {
				var data = { offset: (this.current_page - 1)*PER_PAGE, count: PER_PAGE };
				this.$http.post(AJAX_ROOT+'request/get_requests', data).then(response => {
					this.requests = response.body.detail.requests;
					this.pages = Math.ceil(response.body.detail.count/PER_PAGE);
				}, response => {
					 //error callback
				});
			},
			toggleAddView: function (request) {
				if(this.addVisibility == 'hidden') this.addVisibility = 'visible';
				else this.addVisibility = 'hidden';
			},
			showEditDialog: function (request) {
				this.$refs.editdialog.showDialog(request);
			},
			setPage: function (page){
				this.current_page = page;
				this.refreshData();
			}
		},
		mounted: function (){
			this.refreshData();
		}
	});
	//$('.ui.button.toggle').renewal_state;
</script>