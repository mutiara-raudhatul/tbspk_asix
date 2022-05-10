<?php
        include("koneksi.php");

            if (isset($_POST['simpan'])) {
            
            $id_alternatif = $_POST['id_alternatif'];
            $id_kriteria    = $_POST['kriteria'];
            $id_subkriteria = $_POST['subkriteria'];
            $nilai          = $_POST['nilai'];

            $sql    = "SELECT * FROM tb_topsis";
            $tambah = $db->query($sql);

            if ($row = $tambah->fetch_row()) {

                $masuk = "INSERT INTO tb_topsis VALUES ('$id_alternatif','$id_kriteria','$id_subkriteria','$nilai')";
                $buat  = $db->query($masuk);

                echo "<script>alert('Input Data Berhasil') </script>";
                // header("location: alternatif.php?id_alternatif=$id_alternatif");
                header("location: alternatif.php");
            }
            }
?>