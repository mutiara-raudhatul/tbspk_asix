<?php

include("koneksi.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $id_kriteria    = $_POST['id_kriteria'];
    $nama_kriteria  = $_POST['nama_kriteria'];
    $bobot          = $_POST['bobot'];
    $cost_benefit   = $_POST['cost_benefit'];

    $sqlcheck = "SELECT id_kriteria FROM tb_kriteria WHERE NOT EXISTS 
                (SELECT id_kriteria FROM tb_kriteria WHERE id_kriteria='$id_kriteria')";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);
    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("id kriteria tidak dapat diubah");
              window.location="kriteria.php";
              </script>';
        exit();
    }
    else{
        // buat query update
        $sql = "UPDATE tb_kriteria SET id_kriteria='$id_kriteria', nama_kriteria='$nama_kriteria', bobot='$bobot', cost_benefit='$cost_benefit'
                WHERE id_kriteria ='$id_kriteria'";

        $query = mysqli_query($db, $sql);

        // apakah query update berhasil?
        if( $query ) {
            echo '<script language="javascript">
                  alert ("Berhasil menyimpan perubahan");
                  window.location="kriteria.php";
                  </script>';
        } else {
            echo '<script language="javascript">
                  alert ("Gagal menyimpan perubahan");
                  window.location="kriteria.php";
                  </script>';
        }
    }
} else {
    header('Location: kriteria.php');
}

?>