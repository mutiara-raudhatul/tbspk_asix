<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
    include ("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Alternatif</title>
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
                        <h1 class="mt-4">Alternatif</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Alternatif</li>
                        </ol>
                        <ol class="breadcrumb mb-4">
                            <a href="addalternatif.php" class="btn btn-primary">Add</a>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Alternatif
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Alternatif</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = $db->query('SELECT * FROM tb_alternatif');
                                        while ($row = $sql->fetch_array()) {
                                        ?>
                                            <tr>
                                            <td><?php echo $row[0] ?></td>
                                            <td><?php echo $row[1] ?></td>
                                            <td text-align="center" >
                                                <a href="adddetailalternatif.php?id_alternatif=<?php echo $row['id_alternatif'] ?>" class="btn btn-info">Detail</a>
                                                <a href="editalternatif.php?id_alternatif=<?php echo $row['id_alternatif'] ?>" class="btn btn-warning">Edit</a>
                                                <a href="deletealternatif.php?id_alternatif=<?php echo $row['id_alternatif']?>" class='btn btn-danger' onclick = "return confirm('Yakin Data Akan Dihapus');">Delete</a>
                                            </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                include ('footer.php');
                ?>>
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
