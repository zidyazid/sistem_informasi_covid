<?php
	include_once '../../config/koneksi.php';
	include_once 'class.vaksin.php';
	$vaksin_ = new vaksin($pdo);
	$id = $_GET['id_vaksin'];
	$vaksin_->delete($id);
	header('location:data_vaksin.php')
?>