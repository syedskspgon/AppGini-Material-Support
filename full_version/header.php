<!doctype html>
<?php if(!defined('PREPEND_PATH')) define('PREPEND_PATH', ''); ?>
<html lang="en">

<head>
    <meta charset="<?php echo datalist_db_encoding; ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo PREPEND_PATH; ?>assets/img/apple-icon.png" />
    <link id="browser_favicon" rel="shortcut icon" href="<?php echo PREPEND_PATH; ?>resources/images/appgini-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php echo ucwords('demo'); ?> | <?php echo (isset($x->TableTitle) ? $x->TableTitle : ''); ?></title>
		
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/initializr/css/bootstrap.css">
    
	<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/lightbox/css/lightbox.css" media="screen">
	<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/select2/select2.css" media="screen">
	<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.css" media="screen">
	<link rel="stylesheet" href="<?php echo PREPEND_PATH; ?>dynamic.css.php">
    
	<!--   Core JS Files   -->
	<!--   Core JS Files   -->
	<script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery-1.11.2.min.js"></script>
	<script>var $j = jQuery.noConflict();</script>
	
	<script src="<?php echo PREPEND_PATH; ?>resources/jquery/js/jquery.mark.min.js"></script>


	<script src="<?php echo PREPEND_PATH; ?>resources/select2/select2.min.js"></script>
	<script src="<?php echo PREPEND_PATH; ?>resources/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo PREPEND_PATH; ?>resources/jscookie/js.cookie.js"></script>
	<script src="<?php echo PREPEND_PATH; ?>common.js.php"></script>
	
	<!-- Required CSS & JS Files for Material Support -->
	
	<!--  Material Dashboard CSS    -->
	<link href="<?php echo PREPEND_PATH; ?>assets/mcs/sweetalert.css" rel="stylesheet" />
    <link href="<?php echo PREPEND_PATH; ?>assets/mcs/material-dashboard.css?v=1.2.0" rel="stylesheet" />
   <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
	<!-- Material Dashboard javascript methods -->
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/sweetalert.js" type="text/javascript"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/material.min.js" type="text/javascript"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/chartist.min.js"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/arrive.min.js"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/perfect-scrollbar.jquery.min.js"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/bootstrap-notify.js"></script>
	<script src="<?php echo PREPEND_PATH; ?>assets/mjs/material-dashboard.js?v=1.2.0"></script>
	
	<!-- End of Files-->
	
<?php if(isset($x->TableName) && is_file(dirname(__FILE__) . "/hooks/{$x->TableName}-tv.js")){ ?>
			<script src="<?php echo PREPEND_PATH; ?>hooks/<?php echo $x->TableName; ?>-tv.js"></script>
		<?php } ?>


	<style>
	#addNew, #Print, #CSV, #Filter, #NoFilter, #Search, #NoFilter_x{
		
		margin:0px 1px;
	}
	</style>

</head>

<body>
		<div class="wrapper">
			<!-- Application Title -->
			<?php $app_title = 'SPGON';?>
			<?php if(function_exists('handle_maintenance')) echo handle_maintenance(true); ?>

			
			<?php if(!$_REQUEST['Embedded']){ ?>
				<?php if(function_exists('htmlUserBar')) echo htmlUserBar(); ?>
				
			<?php } ?>	
        
			<div class="container-fluid">
			<?php if(class_exists('Notification')) echo Notification::placeholder(); ?>

			<!-- process notifications -->
			<?php $notification_margin = ($_REQUEST['Embedded'] ? '15px 0px' : '0px 0 -45px'); ?>
			<div style="height: 60px; margin: <?php echo $notification_margin; ?>; padding:0 20px">
				
				<?php if(function_exists('showNotifications')) echo showNotifications(); ?>
			</div>

			<?php if(is_file(dirname(__FILE__) . '/hooks/header-extras.php')){ include(dirname(__FILE__).'/hooks/header-extras.php'); } ?>
			<!-- Add header template below here .. -->
