<?php

include("koneksi.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $id_alternatif    = $_POST['id_alternatif'];
    $nama_alternatif  = $_POST['nama_alternatif'];

    $sqlcheck = "SELECT id_alternatif FROM tb_alternatif WHERE NOT EXISTS 
                (SELECT id_alternatif FROM tb_alternatif WHERE id_alternatif='$id_alternatif')";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);
    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("id alternatif tidak dapat diubah");
              window.location="alternatif.php";
              </script>';
        exit();
    }
    else{
        // buat query update
        $sql = "UPDATE tb_alternatif SET id_alternatif='$id_alternatif', nama_alternatif='$nama_alternatif'
                WHERE id_alternatif ='$id_alternatif'";

        $query = mysqli_query($db, $sql);

        // apakah query update berhasil?
        if( $query ) {
            echo '<script language="javascript">
                  alert ("Berhasil menyimpan perubahan");
                  window.location="alternatif.php";
                  </script>';
        } else {
            echo '<script language="javascript">
                  alert ("Gagal menyimpan perubahan");
                  window.location="alternatif.php";
                  </script>';
        }
    }
} else {
    header('Location: alternatif.php');
}

?>