<?php
        include("koneksi.php");

            if (isset($_POST['simpan'])) {
            $id_subkriteria = $_POST['id_subkriteria'];
            $id_kriteria    = $_POST['id_kriteria'];
            $nama_subkriteria  = $_POST['nama_subkriteria'];
            $nilai          = $_POST['nilai'];

            $sql    = "SELECT * FROM tb_subkriteria";
            $tambah = $db->query($sql);

            if ($row = $tambah->fetch_row()) {

                $masuk = "INSERT INTO tb_subkriteria VALUES ('$id_subkriteria','$id_kriteria','$nama_subkriteria','$nilai')";
                $buat  = $db->query($masuk);

                echo "<script>alert('Input Data Berhasil') </script>";
                header("location: subkriteria.php?id_kriteria=$id_kriteria");
            }
            }
?>