<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
    include ("koneksi.php");

    // kalau tidak ada id di query string
    if( !isset($_GET['id_alternatif']) ){
        header('Location: alternatif.php');
    }

    //ambil id dari query string
    $id_alternatif= $_GET['id_alternatif'];

    // buat query untuk ambil data dari database
    $sql = "SELECT * FROM tb_alternatif WHERE id_alternatif='$id_alternatif'";
    $query = mysqli_query($db, $sql);
    $data_alternatif = mysqli_fetch_assoc($query);

    $id_alternatif = $data_alternatif['id_alternatif'];
    $nama_alternatif = $data_alternatif['nama_alternatif'];

    // jika data yang di-edit tidak ditemukan
    if( mysqli_num_rows($query) < 1 ){
        die("data tidak ditemukan...");
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
        <title>Dashboard - SB Admin</title>
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
                        <h1 class="mt-4">Edit alternatif</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="alternatif.php">alternatif</a></li>
                            <li class="breadcrumb-item active">Edit alternatif</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit alternatif
                            </div>
                            <div class="card-body">
                                <form class="form" action="proseseditalternatif.php" method="post">
                                <div class="mb-3">
                                    <label for="id_alternatif" class="form-label">Id alternatif</label>
                                    <input required class="form-control" type="text" name="id_alternatif" value="<?php echo $id_alternatif; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_alternatif" class="form-label">Nama alternatif</label>
                                    <input required class="form-control" type="text" name="nama_alternatif" value="<?php echo $nama_alternatif; ?>" placeholder="Nama alternatif">
                                </div>
                                    <a href="alternatif.php" type="button" name="batal" class="btn btn-danger" onclick = "return confirm('Yakin batal mengubah data alternatif?');">Batal</a>
                                    <input type="submit" name="submit" class="btn btn-primary" onclick = "return confirm('Yakin akan mengubah data alternatif?');">
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
