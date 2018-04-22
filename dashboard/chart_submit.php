<?php

	include('../lib.php');
	include('class.php');

	$data['chart_id'] 	  = makeSafe($_POST['chart_id']);
	$data['chart_title']  = makeSafe($_POST['chart_title']);
	$data['chart_table']  = makeSafe($_POST['chart_table']);
	$data['chart_info']   = makeSafe($_POST['chart_info']);
	$data['chart_type']   = makeSafe($_POST['chart_type']);
	$data['chart_field1'] = makeSafe($_POST['chart_field1']);
	$data['chart_field2'] = makeSafe($_POST['chart_field2']);
	$data['chart_color']  = makeSafe($_POST['chart_color']);
	$data['chart_extra']  = makeSafe($_POST['chart_extra']);
	$data['chart_result'] = makeSafe($_POST['chart_result']);

	/*echo '<pre>';
	print_r($data);
	echo '</pre>';*/

	$charts = new Dashboard();
	$charts->chartSubmit($data);

	header('location:../index.php');

?>