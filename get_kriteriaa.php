<?php
	include 'a_kon.php';

	echo "<option value=''>Pilih Kriteria</option>";

	$query = "SELECT * FROM tb_kriteria";
	$dewan1 = $db1->prepare($query);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['id_kriteria'] . "'>" . $row['nama_kriteria'] . "</option>";
	}
?>