<?php
        include("koneksi.php");

            if (isset($_POST['simpan'])) {
            $id_subkriteria = $_POST['id_subkriteria'];
            $id_kriteria    = $_POST['id_kriteria'];
            $nama_subkriteria  = $_POST['nama_subkriteria'];
            $nilai          = $_POST['nilai'];

            $sql    = "SELECT * FROM tb_subkriteria";
            $tambah = $db->query($sql);

            $sqlcek="SELECT nama_subkriteria FROM tb_subkriteria WHERE nama_subkriteria='$nama_subkriteria'";
            $cek_proses= mysqli_query($db, $sqlcek);
            $data_subkriteria = mysqli_fetch_array ($cek_proses, MYSQLI_NUM);

                if($data_subkriteria>0){
                    echo "<script>alert('Maaf, Subkriteria tersebut sudah Ada!') </script>";
                    echo "<script>window.location.href = \"subkriteria.php?id_kriteria=$id_kriteria\" </script>";
                } else {
                    if ($row = $tambah->fetch_row()) {

                        $masuk = "INSERT INTO tb_subkriteria VALUES ('$id_subkriteria','$id_kriteria','$nama_subkriteria','$nilai')";
                        $buat  = $db->query($masuk);

                        echo "<script>alert('Input Data Berhasil') </script>";
                        header("location: subkriteria.php?id_kriteria=$id_kriteria");
                    }
                }
            }
?>