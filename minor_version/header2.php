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
				<?php if(function_exists('spg_htmlUserBar')) echo spg_htmlUserBar(); ?>
				
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
			
<?php
	function spg_htmlUserBar(){
		global $adminConfig, $Translation;
		global $app_title;
		if(!defined('PREPEND_PATH')) define('PREPEND_PATH', '');

		ob_start();
		$home_page = (basename($_SERVER['PHP_SELF'])=='index.php' ? true : false);

		?>		
		<?php 
			$memID = getLoggedMemberID();
			if(!$_REQUEST['Embedded'] && $memID !=  $adminConfig['anonymousMember']){
			?>
		<div class="sidebar" data-color="purple" data-color="orange" data-image="<?php echo PREPEND_PATH; ?>assets/img/sidebar-1.jpg">
            <div class="logo">
                <a href="./index.php" class="simple-text">
                    <i class="material-icons">home</i> <?php echo $app_title; ?>
                </a>
            </div>
            <div class="sidebar-wrapper" style="overflow:auto">
                <ul class="nav">
                    <li id="tbl_syed_dashboard" class="active">
                        <a href="index.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
			<?php
					$arrTables = getTableList();
					if(is_array($arrTables) && count($arrTables)){
						$i=0;
						foreach($arrTables as $tn=>$tc){
							$tChkFF = array_search($tn, array());
							$tChkHL = array_search($tn, array());
							if($tChkHL !== false && $tChkHL !== null) continue;

							$searchFirst = (($tChkFF !== false && $tChkFF !== null) ? '?Filter_x=1' : '');
							?>
							
								<li id="tbl_<?php echo $tn; ?>">
									<a  href="<?php echo $tn; ?>_view.php<?php echo $searchFirst; ?>">
									 <i class="menu-icon" style="margin-top:0px;"><?php echo ($tc[2] ? '<img style="height:24px;" src="' . $tc[2] . '">' : '');?></i>
										<p><?php echo $tc[0]; ?></p>
									</a>
								</li>
										
									
							<?php
							$i++;
						}
					}
					?>
				</ul>
            </div>
        </div>
		<div class="main-panel" style="overflow-y:scroll">
			<nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
						
						<h4 class="hidden-lg hidden-md text-center">
                    <i class="material-icons">home</i> <?php echo $app_title; ?>
                </h4>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
							<li>
								<a class="hidden-xs hidden-sm" style="text-transform:none;font-size:20px"><?php echo $Translation['signed as']; ?> <strong><?php echo getLoggedMemberID(); ?></strong></a>
							</li>

							 
							<?php if(getLoggedAdmin()){ ?>
							<li >
                                <a href="#" class="btn btn-success" data-toggle="dropdown">
                                    <i class="material-icons">graphic_eq</i>
                                    Add Widget
                                </a>
                                 <ul class="dropdown-menu">
                                    <li>
                                        <a data-toggle="modal" href="#modal_card">Card</a>
                                    </li>
                                    <li>
                                        <a data-toggle="modal" href="#modal_chart">Chart</a>
                                    </li>
                                   
                                </ul>
                            </li>
                            <li>
                                <a href="admin/pageHome.php" class="btn btn-danger btn-just-icon" data-toggle="tooltip" data-placement="bottom" title="Admin Area">
                                    <i class="material-icons">settings</i>
                                    <p class="hidden-lg hidden-md">Admin Area</p>
                                </a>
                            </li>

                            
                            <?php } ?>
                            <li>
                                <a href="index.php?signOut=1" class="btn btn-default btn-just-icon" data-toggle="tooltip" data-placement="bottom" title="Signout">
                                    <i class="material-icons">power_settings_new</i>
                                    <p class="hidden-lg hidden-md text-white">Signout</p>
                                </a>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search">
                            
                        
                        </form>
                    </div>
               
						
					
			</div>
		</nav>
				<div style="height: 70px;" class="hidden-print"></div>
			<?php }

			else{
				
			?>
				
			<nav class="navbar navbar-default">
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-info">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="index.php"><i class="material-icons">home</i> Sales</a>
							</div>

							<div class="collapse navbar-collapse" id="example-navbar-info">
								<?php if(!$_GET['signIn'] && !$_GET['loginFailed']){ ?>
					<?php if(getLoggedMemberID() == $adminConfig['anonymousMember']){ ?>
						<p class="navbar-text navbar-right" style="margin:0px">&nbsp;</p>
						<a href="<?php echo PREPEND_PATH; ?>index.php?signIn=1" class="btn btn-success navbar-btn navbar-right"><?php echo $Translation['sign in']; ?></a>
						<p class="navbar-text navbar-right" style="margin:0px">
							<?php echo $Translation['not signed in']; ?>
						</p>
					<?php }else{ ?>
						<ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
							<a class="btn navbar-btn btn-default" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text" style="margin:0px">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
							</p>
						</ul>
						<ul class="nav navbar-nav visible-xs">
							<a class="btn navbar-btn btn-default btn-lg visible-xs" href="<?php echo PREPEND_PATH; ?>index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
							<p class="navbar-text text-center" style="margin:0px">
								<?php echo $Translation['signed as']; ?> <strong><a href="<?php echo PREPEND_PATH; ?>membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
							</p>
						</ul>
						<script>
							/* periodically check if user is still signed in */
							setInterval(function(){
								$j.ajax({
									url: '<?php echo PREPEND_PATH; ?>ajax_check_login.php',
									success: function(username){
										if(!username.length) window.location = '<?php echo PREPEND_PATH; ?>index.php?signIn=1';
									}
								});
							}, 60000);
						</script>
					<?php } ?>
				<?php } ?>
							</div>
						</div>
					</nav>
			<?php
				
			}?>
		<?php

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
?>