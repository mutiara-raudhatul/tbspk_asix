<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
    include('koneksi.php');

    $query="SELECT * FROM tb_kriteria";
    $result= mysqli_query($db,$query);

    //hitung pokdakan berdasarkan kategori dari kriteria
    //SELECT tb_topsis.id_kriteria, tb_topsis.id_subkriteria, tb_subkriteria.nama_subkriteria, COUNT(tb_topsis.id_subkriteria) AS jumlah_pokdakan FROM tb_topsis JOIN tb_subkriteria USING (id_subkriteria) WHERE tb_topsis.id_kriteria=2 GROUP BY id_subkriteria
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charts - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Nama_Kriteria', 'Bobot'],
            <?php
                while($chart=mysqli_fetch_assoc($result))
                {
                    echo "['".$chart['nama_kriteria']."',".$chart['bobot']."],";
                }
            ?>
            ]);

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data);
        }
        </script>
    </head>
    <body class="sb-nav-fixed">
            <?php
            include ('nav.php');
            ?>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</a></li>
                        </ol>
                        
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title">Alternatif</h5>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                    $sqlalt="SELECT count(id_alternatif) as jumlah_alt FROM tb_alternatif";
                                                    $queryalt= mysqli_query($db,$sqlalt);    
                                                    $countalt = mysqli_fetch_assoc($queryalt);  
                                                ?>
                                                <h5 style="text-align: right; text-shadow: 1px 1px 1px lightblue;"> <?php echo $countalt['jumlah_alt']; ?> </h5>
                                            </div>
                                            <p class="card-text">Calon kelompok budidaya ikan yang akan menerima bantuan</p>
                                            <br>
                                        </div>                                        
                                        <a href="alternatif.php" class="btn btn-primary">Lihat detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title">Kriteria</h5>
                                            </div>
                                            <div class="col-4">
                                                <?php
                                                    $sqlkriteria="SELECT count(id_kriteria) as jumlah_kriteria FROM tb_kriteria";
                                                    $querykriteria= mysqli_query($db,$sqlkriteria);    
                                                    $countkriteria = mysqli_fetch_assoc($querykriteria);  
                                                ?>
                                                <h5 style="text-align: right;   text-shadow: 1px 1px 1px lightgreen;"> <?php echo $countkriteria['jumlah_kriteria']; ?> </h5>
                                            </div>
                                            <p class="card-text">Kriteria yang menjadi acuan dalam menentukan keputusan</p>
                                            <br>
                                        </div>
                                        <a href="kriteria.php" class="btn btn-success">Lihat detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title">Data Analisis</h5>
                                            </div>
                                            <div class="col-4"></div>
                                            <p class="card-text">Data penilaian alternatif berdasarkan kriteria</p>
                                            <br>
                                        </div>
                                        <a href="dataanalisis.php" class="btn btn-warning">Lihat detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mb-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <h5 class="card-title">Topsis</h5>
                                            </div>
                                            <div class="col-4"></div>
                                            <p class="card-text">Metode yang digunakan untuk memproses keputusan</p>
                                            <br>
                                        </div>
                                        <a href="topsis.php" class="btn btn-danger">Lihat detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-pie me-1"></i>
                                        Bobot Preferensi Kriteria
                                    </div>
                                    <div id="piechart" style=" width: 600px; height: 400px;"></div>
                                </div>
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
        <script src="assets/demo/chart-pie-demo.js"></script>
    </body>
</html>
