<?php
		include 'a_kon.php';
		$subkriteria = $_POST['subkriteria'];
	
		// echo "<option value=''>Pilih Nilai</option>";
	
		$query = "SELECT * FROM tb_subkriteria WHERE id_subkriteria=?";
		$dewan1 = $db1->prepare($query);
		$dewan1->bind_param("s", $subkriteria);
		$dewan1->execute();
		$res1 = $dewan1->get_result();
		while ($row = $res1->fetch_assoc()) {
			echo "<option value='" . $row['nilai'] . "' selected>" . $row['nama_subkriteria'] ." [".$row['nilai']."]". "</option>";
		}

	// include 'a_kon.php';
	// // $subkriteria = $_POST['subktiteria'];

	// // $query = "SELECT * FROM tb_subkriteria WHERE id_subkriteria=? ORDER BY id_subkriteria ASC";
	// // $dewan1 = $db1->prepare($query);
	// // $dewan1->bind_param("i", $subkriteria);
	// // $dewan1->execute();
	// // $res1 = $dewan1->get_result();

	// // // echo "<input value='nilai'>";

	// // while ($row = $res1->fetch_assoc()) {
	// // 	echo "<option value='" . $row['nilai'] . "'>" . $row['nilai'] . "</option>";
    // // }

	// // include('config.php');
  
	// $subkriteria = $_POST["subkriteria"];
	// $nilai = mysql_query("SELECT * FROM tb_subkriteria WHERE id_subkriteria='$subkriteria'");
	// while($data=mysql_fetch_array($nilai)){
	// echo "$data[nilai]";
	// }
?>