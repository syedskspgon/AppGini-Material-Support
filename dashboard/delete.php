<?php

	include('../lib.php');

	$id = makeSafe($_REQUEST['id']);

	sql("DELETE FROM `meta_table` WHERE `id`='".$id."'", $eo);

	$_SESSION['spg_type'] = 'delete';
	header('location:../index.php');
?>