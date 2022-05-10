<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
    include ("koneksi.php");
    $id_kriteria_get = $_GET['id_kriteria'];
    
    //ambil kriteria
    $sqlid= "SELECT * FROM tb_kriteria WHERE id_kriteria='$id_kriteria_get'";
    $queryid = mysqli_query($db, $sqlid);
    $data_kriteria = mysqli_fetch_assoc($queryid);
    $id=$data_kriteria['id_kriteria'];
    $nama_kriteria= $data_kriteria['nama_kriteria'];

    //pemberian kode id secara otomatis
    $carikode = $db->query("SELECT id_subkriteria FROM tb_subkriteria WHERE id_kriteria=$id_kriteria_get") or die(mysqli_error());
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
        <title>Subkriteria</title>
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
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Tambah Subkriteria: <?php echo $nama_kriteria ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="kriteria.php">Kriteria</a></li>
                            <li class="breadcrumb-item active"><a href="subkriteria.php?id_kriteria=<?php echo $id ?>">Subkriteria</a></li>
                            <li class="breadcrumb-item active">Tambah subkriteria</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah Subkriteria
                            </div>
                            <div class="card-body">
                            <form class="form" action="prosesaddsubkriteria.php" method="post">
                            <div class="mb-3">
                                <label for="id_subkriteria" class="form-label">Id Subkriteria</label>
                                <input required class="form-control" type="text" name="id_subkriteria" value="<?php echo "S".$id_kriteria_get."0".$kode_otomatis; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="id_kriteria" class="form-label">Id Kriteria</label>
                                <input required class="form-control" type="text" name="id_kriteria" value="<?php echo $id_kriteria_get; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_subkriteria" class="form-label">Nama Subkriteria</label>
                                <input required class="form-control" type="text" name="nama_subkriteria" placeholder="Nama Subkriteria">
                            </div>
                            <div class="mb-3">
                                <label for="nilai" class="form-label">Nilai</label>
                                <input required type="number" min="0" class="form-control" type="text" name="nilai" placeholder="Nilai">
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
