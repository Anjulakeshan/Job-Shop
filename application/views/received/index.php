<div class="ui two stackable link cards">
	<a class="blue card" href="<?=base_url('received/pending'); ?>">
		<div class="image">
			<img src="<?=base_url('assets/img/pending.jpg'); ?>">
		</div>
		<div class="content">
			<div class="header">Pending Jobs</div>
			<div class="description">Jobs which are waiting until customer's response.</div>
		</div>
		<div class="extra content">
			<span class="right floated"><?php if($pending_date!=null){ echo "From $pending_date"; } ?></span>
			<span><i class="shop icon"></i><?=$count_pending ?> Job(s)</span>
		</div>
	</a>
	<a class="red card" href="<?=base_url('received/waiting'); ?>">
		<div class="image">
			<img src="<?=base_url('assets/img/received.jpg'); ?>">
		</div>
		<div class="content">
			<div class="header">Received Jobs</div>
			<div class="description">Jobs which are waiting for process. Arrange them to process soon.</div>
		</div>
		<div class="extra content">
			<span class="right floated"><?php if($received_date!=null){ echo "From $received_date"; } ?></span>
			<span><i class="shop icon"></i><?=$count_received ?> Job(s)</span>
		</div>
	</a>
</div>
