<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
    include ("koneksi.php");

    // kalau tidak ada id di query string
    if( !isset($_GET['id_kriteria']) ){
        header('Location: kriteria.php');
    }

    //ambil id dari query string
    $id_kriteria= $_GET['id_kriteria'];

    // buat query untuk ambil data dari database
    $sql = "SELECT * FROM tb_kriteria WHERE id_kriteria='$id_kriteria'";
    $query = mysqli_query($db, $sql);
    $data_kriteria = mysqli_fetch_assoc($query);

    $id_kriteria = $data_kriteria['id_kriteria'];
    $nama_kriteria = $data_kriteria['nama_kriteria'];
    $bobot = $data_kriteria['bobot'];
    $cost_benefit = $data_kriteria['cost_benefit'];

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
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Kriteria</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="kriteria.php">Kriteria</a></li>
                            <li class="breadcrumb-item active">Edit Kriteria</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit Kriteria
                            </div>
                            <div class="card-body">
                                <form class="form" action="proseseditkriteria.php" method="post">
                                <div class="mb-3">
                                    <label for="id_kriteria" class="form-label">Id Kriteria</label>
                                    <input required class="form-control" type="text" name="id_kriteria" value="<?php echo $id_kriteria; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                                    <input required class="form-control" type="text" name="nama_kriteria" value="<?php echo $nama_kriteria; ?>" placeholder="Nama Kriteria">
                                </div>
                                <div class="mb-3">
                                    <label for="bobot" class="form-label">Bobot</label>
                                    <input required type="float" min="0" class="form-control" type="text" name="bobot" value="<?php echo $bobot; ?>" placeholder="Bobot">
                                </div>
                                <div class="mb-3">
                                    <label for="cost_benefit" class="form-label">Cost/Benefit</label>
                                    <select required class="form-select" name="cost_benefit" aria-label="Default select example">
                                            <option value="<?php echo $cost_benefit; ?>" selected hidden><?php echo $cost_benefit; ?></option>
                                            <option value="Cost">Cost</option>
                                            <option value="Benefit">Benefit</option>
                                    </select>
                                </div>
                                    <a href="kriteria.php" type="button" name="batal" class="btn btn-danger" onclick = "return confirm('Yakin batal mengubah data kriteria?');">Batal</a>
                                    <input type="submit" name="submit" class="btn btn-primary" onclick = "return confirm('Yakin akan mengubah data kriteria?');">
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
