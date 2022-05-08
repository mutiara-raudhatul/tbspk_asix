<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
//untuk koneksi ke database
include ("koneksi.php");

//proses delete
if(isset($_GET['id_kriteria']) ){

    // ambil id dari query string
    $id_kriteria = $_GET['id_kriteria'];

    // buat query hapus
    $sql = "DELETE FROM tb_kriteria WHERE id_kriteria='$id_kriteria'";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        echo "<script> 
            alert('Data berhasil dihapus!');
            document.location.href = 'kriteria.php';
            </script>";;
    } else {
        echo "<script> 
            alert('Data gagal dihapus, karena kriteria sudah tercatat pada alternatif!');
            document.location.href = 'kriteria.php';
            </script>";
    }

} else {
    header('Location: kriteria.php');
}

?>