<?php
	include_once '../config/koneksi.php';
	include_once 'class.covid.php';
	$covid = new covid($pdo);
	$id = $_GET['id_covid'];
	$covid->delete($id);
	header('location:data_covid.php')
?>