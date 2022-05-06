<?php
    include ("koneksi.php");

    //ambil id dari query string
    $id_subkriteria= $_GET['id_subkriteria'];

    //ambil id kriteria
    $sqlid= "SELECT * FROM tb_subkriteria JOIN tb_kriteria WHERE id_subkriteria='$id_subkriteria' AND tb_subkriteria.id_kriteria=tb_kriteria.id_kriteria";
    $queryid = mysqli_query($db, $sqlid);
    $data_kriteria = mysqli_fetch_assoc($queryid);
    $id=$data_kriteria['id_kriteria'];
    $nama_kriteria= $data_kriteria['nama_kriteria'];

    // buat query untuk ambil data dari database
    $sql = "SELECT * FROM tb_subkriteria WHERE id_subkriteria='$id_subkriteria'";
    $query = mysqli_query($db, $sql);
    $data_subkriteria = mysqli_fetch_assoc($query);

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
                        <h1 class="mt-4">Edit Subkriteria: <?php echo $nama_kriteria ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="kriteria.php">Kriteria</a></li>
                            <li class="breadcrumb-item active"><a href="subkriteria.php?id_kriteria=<?php echo $id ?>">Subkriteria</a></li>
                            <li class="breadcrumb-item active">Edit subkriteria</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit Subkriteria
                            </div>
                            <div class="card-body">
                                <form class="form" action="proseseditsubkriteria.php" method="post">
                                <div class="mb-3">
                                    <label for="id_subkriteria" class="form-label">Id Subkriteria</label>
                                    <input required class="form-control" type="text" name="id_subkriteria" value="<?php echo $data_subkriteria['id_subkriteria']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="id_kriteria" class="form-label">Id Kriteria</label>
                                    <input required class="form-control" type="text" name="id_kriteria" value="<?php echo $data_subkriteria['id_kriteria']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_subkriteria" class="form-label">Nama Subkriteria</label>
                                    <input required class="form-control" type="text" name="nama_subkriteria" value="<?php echo $data_subkriteria['nama_subkriteria']; ?>" placeholder="Nama subkriteria">
                                </div>
                                <div class="mb-3">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input required type="number" min="0" class="form-control" type="text" name="nilai" value="<?php echo $data_subkriteria['nilai']; ?>" placeholder="Nilai">
                                </div>  
                                    <a href="subkriteria.php?id_kriteria=<?php echo $id ?>" type="button" name="batal" class="btn btn-danger" onclick = "return confirm('Yakin batal mengubah data subkriteria?');">Batal</a>
                                    <input type="submit" name="submit" class="btn btn-primary" onclick = "return confirm('Yakin akan mengubah data subkriteria?');">
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
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
