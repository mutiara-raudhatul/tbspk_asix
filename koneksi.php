<?php 
	$db = new mysqli('localhost', 'root', '', 'db_sekolah');

	if($db->connect_errno>0){
		die('Koneksi ke database gagal');
	}

 ?>