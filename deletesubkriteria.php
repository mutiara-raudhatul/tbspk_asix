<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
//untuk koneksi ke database
include ("koneksi.php");
    // ambil id dari query string
    $id_subkriteria = $_GET['id_subkriteria'];

    // ambil id kriteria
    $sqlid= "SELECT id_kriteria FROM tb_subkriteria WHERE id_subkriteria='$id_subkriteria'";
    $queryid = mysqli_query($db, $sqlid);
    $data_id = mysqli_fetch_assoc($queryid);
    $id=$data_id['id_kriteria'];

//proses delete
if(isset($_GET['id_subkriteria']) ){

    // buat query hapus
    $sql = "DELETE FROM tb_subkriteria WHERE id_subkriteria='$id_subkriteria'";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        echo "<script> 
            alert('Data berhasil dihapus!');
            </script>";
            header("location: subkriteria.php?id_kriteria=".$id);

    } else {
        echo "<script> 
            alert('Data gagal dihapus, karena subkriteria sudah tercatat pada alternatif!');
            </script>";
            header("location: subkriteria.php?id_kriteria=".$id);
    }

} else {
    header("location: subkriteria.php?id_kriteria=".$id);
}

?>