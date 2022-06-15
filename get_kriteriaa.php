<?php
	include 'a_kon.php';
	// $alternatif = $_POST['alternatif'];
	$id_alternatif_get = $_GET['id_alternatif'];


	echo "<option value='' hidden>Pilih Kriteria</option>";

	$query = "SELECT * FROM tb_kriteria WHERE id_kriteria NOT IN (SELECT id_kriteria FROM tb_topsis WHERE id_alternatif='7')";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("i", $id_alternatif_get);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['id_kriteria'] . "'>" . $row['nama_kriteria'] . "</option>";
	}
?>