<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
//untuk koneksi ke database
include ("koneksi.php");

//proses delete
if(isset($_GET['id_alternatif']) ){

    // ambil id dari query string
    $id_alternatif = $_GET['id_alternatif'];

    // buat query hapus
    $sql = "DELETE FROM tb_alternatif WHERE id_alternatif='$id_alternatif'";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        echo "<script> 
            alert('Data berhasil dihapus!');
            document.location.href = 'alternatif.php';
            </script>";;
    } else {
        echo "<script> 
            alert('Data gagal dihapus, karena alternatif sudah tercatat pada alternatif!');
            document.location.href = 'alternatif.php';
            </script>";
    }

} else {
    header('Location: alternatif.php');
}

?>