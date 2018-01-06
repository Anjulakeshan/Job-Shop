<!DOCTYPE html>
<html>
	<?php  
		if(!isset($title)) $title = 'Online Services';
	?>
	<head>
		<title><?=$title?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	    <!-- CSS styles -->
	    <link rel="stylesheet" href="<?php echo base_url('assets/css/semantic.css'); ?>" />
	    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>" />
	  

	    <!-- JS Libs -->
		<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/semantic.min.js'); ?>"></script>

		<script>
			$(document).ready(function(){
				if ($(window).width() < 768) {
					$('#sidebar').removeClass('computer only fixed');
					$('#sidebar').addClass('sidebar icon');
					$('#sidebar').sidebar();
				}
				$('#menubtn').click(function(){ 
					$('#sidebar').sidebar('show');
				});
			});
		</script>
	</head>

	<body>
		<?php  $this->load->view('layouts/sidebar'); ?>
		<div class="pusher main-content">
			<div class="ui mobile only inverted menu" id="topbar">
				<a class="item" id="menubtn"><i class="sidebar icon"></i>Menu</a>
			</div>
			
			<?php	if(isset($_view) && $_view)
				$this->load->view($_view);
			?>
		</div>
	</body>
</html>
