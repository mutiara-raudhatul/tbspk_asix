<?php

include("koneksi.php");
// ambil id dari query string
$id_subkriteria = $_GET['id_subkriteria'];

// ambil id kriteria
$sqlid= "SELECT id_kriteria FROM tb_subkriteria WHERE id_subkriteria='$id_subkriteria'";
$queryid = mysqli_query($db, $sqlid);
$data_id = mysqli_fetch_assoc($queryid);
$id=$data_id['id_kriteria'];

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $id_subkriteria     = $_POST['id_subkriteria'];
    $id_kriteria        = $_POST['id_kriteria'];
    $nama_subkriteria   = $_POST['nama_subkriteria'];
    $nilai              = $_POST['nilai'];

    $sqlcheck = "SELECT id_subkriteria FROM tb_subkriteria WHERE NOT EXISTS 
                (SELECT id_subkriteria FROM tb_subkriteria WHERE id_subkriteria='$id_subkriteria')";
    $querycheck = mysqli_query($db,$sqlcheck);
    $cekkode    =mysqli_num_rows ($querycheck);
    if ($cekkode> 0) {
        echo '<script language="javascript">
              alert ("id subkriteria tidak dapat diubah");
              window.location="subkriteria.php=<?php echo $id_subkriteria ?>";
              </script>';
        exit();
    }
    else{
        // buat query update
        $sql = "UPDATE tb_subkriteria SET id_subkriteria='$id_subkriteria', id_kriteria='$id_kriteria', nama_subkriteria='$nama_subkriteria', nilai='$nilai'
                WHERE id_subkriteria='$id_subkriteria'";

        $query = mysqli_query($db, $sql);

        // apakah query update berhasil?
        if( $query ) {
            echo '<script language="javascript">
                  alert ("Berhasil menyimpan perubahan");
                  </script>';
            header("location: subkriteria.php?id_kriteria=".$id_kriteria);
        } else {
            echo '<script language="javascript">
                  alert ("Gagal menyimpan perubahan");
                  </script>';
            header("location: subkriteria.php?id_kriteria=".$id_kriteria);    
        }
    }
} else {
    header('Location: subkriteria.php=<?php echo $id_subkriteria ?>');
}

?>