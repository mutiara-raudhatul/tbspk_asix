<?php

include("koneksi.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['submit'])){

    // ambil data dari formulir
    $id_alternatif    = $_POST['id_alternatif'];
    $nama_alternatif  = $_POST['nama_alternatif'];
    // $kelas_pokdakan  = $_POST['kelas_pokdakan'];
    // $usia_pokdakan  = $_POST['usia_pokdakan'];
    // $luas_kolam  = $_POST['luas_kolam'];
    // $lokasi_kolam  = $_POST['lokasi_kolam'];
    // $jumlah_anggota  = $_POST['jumlah_anggota'];
    // $rata2_produksi  = $_POST['rata2_produksi'];
    // $domisili_anggota  = $_POST['domisili_anggota'];


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

        // $sql = "UPDATE tb_alternatif SET id_alternatif='$id_alternatif', nama_alternatif='$nama_alternatif', kelas_pokdakan='$kelas_pokdakan',usia_pokdakan='$usia_pokdakan',luas_kolam='$luas_kolam',lokasi_kolam='$lokasi_kolam',jumlah_anggota='$jumlah_anggota',rata2_produksi='$rata2_produksi',domisili_anggota='$domisili_anggota'
        // WHERE id_alternatif ='$id_alternatif'";

        $query = mysqli_query($db, $sql);
        
        $sqlcek="SELECT nama_alternatif FROM tb_alternatif WHERE nama_alternatif='$nama_alternatif'";
        $cek_proses= mysqli_query($db, $sqlcek);
        $data_alternatif = mysqli_fetch_array ($cek_proses, MYSQLI_NUM);

            if($data_alternatif>0){
                echo "<script>alert('Maaf, Alternatif tersebut sudah Ada!') </script>";
                echo "<script>window.location.href = \"alternatif.php\" </script>";
            } else {
                // apakah query update berhasil?
                if( $query ) {
                    echo '<script language="javascript">
                        alert ("Berhasil menyimpan perubahan");
                        window.location="alternatif.php";
                        </script>';
                } else {
                    echo '<script language="javascript">
                        alert ("Gagal menyimpan perubahan");
                        
                        </script>';
                    echo mysqli_error($db);
                }
            }
    }
} else {
    header('Location: alternatif.php');
}

?>