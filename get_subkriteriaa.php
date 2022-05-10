<?php
	include 'a_kon.php';
	$kriteria = $_POST['kriteria'];

	echo "<option value=''>Pilih Subkriteria</option>";

	$query = "SELECT * FROM tb_subkriteria WHERE id_kriteria=? ORDER BY id_subkriteria ASC";
	$dewan1 = $db1->prepare($query);
	$dewan1->bind_param("i", $kriteria);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['id_subkriteria'] . "'>" . $row['nama_subkriteria'] ." [".$row['nilai']."]". "</option>";
    }
?>