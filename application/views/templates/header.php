<?php  
	$this->load->helper('url');
	if(!isset($title)) $title = 'Job Shop';
?>
<html>
	<head>
		<title><?=$title ?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/semantic.css'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
		<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/semantic.min.js'); ?>"></script>
		
		<link rel="manifest" href="<?php echo base_url('assets/manifest.json'); ?>">
	</head>
	<body>