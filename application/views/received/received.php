<script src="<?=base_url('assets/js/calendar.min.js'); ?>"></script>
<script src="<?=base_url('assets/js/vue.js'); ?>"></script>
<script src="<?=base_url('assets/js/vue-resource.js'); ?>"></script>
<script src="<?=base_url('assets/vue/config.js'); ?>"></script>
<script src="<?=base_url('assets/vue/confirmation-dialog.js'); ?>"></script>
<script src="<?=base_url('assets/vue/date-field.js'); ?>"></script>
<script src="<?=base_url('assets/vue/received.js'); ?>"></script>

<div id="app">
	<div class="fire horizontal menubar">
		<a href="<?=base_url('received')?>"><i class="reply icon"></i></a>
		<span class="ui header">Received Jobs</span>
	</div>
	<div class="ui grid" >
		<div class="sixteen wide column">
			<div class="ui segments">
				<div class="ui segment">
					<div class="ui grid">
						<div class="twelve wide column"><h3 class="ui red header">Jobs which are waiting to process!</h3></div>
					</div>
				</div>
				<div class="ui segment">
					<received-table 
						v-bind:on-send="showEditDialog"
						:receives="receives">
					</received-table>
				</div>
				<div class="ui segment">
					<a v-for="i in pages" class="ui label" v-bind:class="{teal: (i == current_page)}"  v-on:click="setPage(i)">{{ i }}</a>
				</div>
			</div>
		</div>
		<received-accept v-bind:on-update="refreshData" v-bind:on-add="refreshData" :receives="receives" ref="editdialog"></received-accept>
	</div>
</div>

<script>
	var PER_PAGE = 3;
	var app = new Vue({
		el: '#app',
		data: {
			receives: [],
			pages: Math.ceil(<?=$count?>/PER_PAGE),
			addVisibility: 'hidden',
			current_page: 1
		},
		methods: {
			refreshData: function () {
				var data = { offset: (this.current_page - 1)*PER_PAGE, count: PER_PAGE };
				this.$http.post(AJAX_ROOT+'received/get_received', data).then(response => {
					this.receives = response.body.detail.receives;
					this.pages = Math.ceil(response.body.detail.count/PER_PAGE);
				}, response => {
					 //error callback
				});
			},
			showEditDialog: function (receive) {
				this.$refs.editdialog.showDialog(receive);
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
	$('.ui.button.toggle').state();
</script>