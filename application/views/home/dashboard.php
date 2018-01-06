<script src="<?php echo base_url('assets/js/utility.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/chart.min.js'); ?>"></script>

<?php
	$tran_types = array("Credit" ,"Debit");
?>
<div class="ui grid dashboard">
	<div class="row">
		<div class="sixteen wide column">
			<div class="ui segments">
				<div class="ui segment">
					<h4 class="ui header">On Going Projects</h4>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('.table .label,.cards .label').each(function(){
		$(this).addClass(stringToLabelColor($(this).text()));
	});
</script>