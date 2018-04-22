<?php

	include('../lib.php');
	include('class.php');

	$data['card_id'] 	= makeSafe($_POST['card_id']);
	$data['card_title'] = makeSafe($_POST['card_title']);
	$data['card_table'] = makeSafe($_POST['card_table']);
	$data['card_icon']  = makeSafe($_POST['card_icon']);
	$data['card_field1'] = makeSafe($_POST['card_field1']);
	$data['card_method'] = makeSafe($_POST['card_method']);
	$data['card_color']  = makeSafe($_POST['card_color']);
	$data['card_extra']  = makeSafe($_POST['card_extra']);


	/*foreach ($_POST as $key => $value) {
		$data[$key] = makeSafe($value);
	}
	*/

	$cards = new Dashboard();
	$cards->cardSubmit($data);

	header('location:../index.php');


?>