<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
    include ("koneksi.php");


    //pemberian kode id secara otomatis
    $carikode = $db->query("SELECT id_kriteria FROM tb_kriteria") or die(mysqli_error());
    $datakode = $carikode->fetch_array();
    $jumlah_data = mysqli_num_rows($carikode);

    if ($datakode) {
        $nilaikode = substr($jumlah_data[0], 1);
        $kode = (int) $nilaikode;
        $kode = $jumlah_data + 1;
        $kode_otomatis = str_pad($kode, 0, STR_PAD_LEFT);
    } else {
        $kode_otomatis = "1";
    }

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kriteria</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
            <?php
              include ('nav.php');
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4" >
                        <h1 class="mt-4" >Tambah Kriteria</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="kriteria.php">Kriteria</a></li>
                            <li class="breadcrumb-item active">Tambah Kriteria</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah Kriteria
                            </div>
                            <div class="card-body">
                            <form class="form" action="addkriteria.php" method="post">
                            <div class="mb-3">
                                <label for="id_kriteria" class="form-label">Id Kriteria</label>
                                <input required class="form-control" type="text" name="id_kriteria" value="<?php echo $kode_otomatis; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                <input required class="form-control" type="text" name="nama_kriteria" placeholder="Nama Kriteria">
                            </div>
                            <div class="mb-3">
                                <label for="bobot" class="form-label">Bobot</label>
                                <input required type="number" min="0" class="form-control" type="text" name="bobot" placeholder="Bobot">
                            </div>
                            <div class="mb-3">
                                <label for="cost_benefit" class="form-label">Cost/Benefit</label>
                                <select required class="form-select" name="cost_benefit" aria-label="Default select example">
                                    <option autofocus value="" hidden>Select</option>
                                    <option value="Cost">Cost</option>
                                    <option value="Benefit">Benefit</option>
                                </select>
                            </div>
                                <input class="btn btn-primary" type="submit" name="simpan" value="Tambah">
                            </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include ('footer.php');
                ?>
            </div>
        </div>

        <?php
            if (isset($_POST['simpan'])) {
            $id_kriteria    = $_POST['id_kriteria'];
            $nama_kriteria  = $_POST['nama_kriteria'];
            $bobot          = $_POST['bobot'];
            $cost_benefit   = $_POST['cost_benefit'];

            $sql    = "SELECT * FROM tb_kriteria";
            $tambah = $db->query($sql);


            $sqlcek="SELECT nama_kriteria FROM tb_kriteria WHERE nama_kriteria='$nama_kriteria'";
            $cek_proses= mysqli_query($db, $sqlcek);
            $data_kriteria = mysqli_fetch_array ($cek_proses, MYSQLI_NUM);

            if($data_kriteria>0){
                echo "<script>alert('Maaf, kriteria tersebut sudah Ada!') </script>";
            } else {
                if ($row = $tambah->fetch_row()) {

                    $masuk = "INSERT INTO tb_kriteria VALUES ('$id_kriteria','$nama_kriteria','$bobot','$cost_benefit')";
                    $buat  = $db->query($masuk);
    
                    echo "<script>alert('Input Data Berhasil') </script>";
                    echo "<script>window.location.href = \"kriteria.php\" </script>";
                }
            }

            }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
