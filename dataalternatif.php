<?php
//koneksi
include ("koneksi.php");

// SELECT tb_alternatif.nama_alternatif, tb_kriteria.nama_kriteria, tb_subkriteria.nama_subkriteria,  tb_topsis.nilai, tb_kriteria.bobot FROM tb_topsis JOIN tb_alternatif USING (id_alternatif) JOIN tb_kriteria USING (id_kriteria) JOIN tb_subkriteria USING (id_subkriteria);
$tampil = $db->query("SELECT b.nama_alternatif,c.nama_kriteria,a.nama_subkriteria,a.nilai,c.bobot
      FROM
        tb_topsis a
        JOIN
          tb_alternatif b USING(id_alternatif)
        JOIN
          tb_kriteria c USING(id_kriteria)
        JOIN
          tb_subkriteria d USING(id_subkriteria");

$data      =array();
$kriterias =array();
$bobot     =array();
$subkriteria = array ();
$nilai_kuadrat =array();

if ($tampil) {
  while($row=$tampil->fetch_object()){
    if(!isset($data[$row->nama_alternatif])){
      $data[$row->nama_alternatif]=array();
    }
    if(!isset($data[$row->nama_alternatif][$row->nama_kriteria])){
      $data[$row->nama_alternatif][$row->nama_kriteria]=array();
    }
    if(!isset($subkriteria[$row->nama_alternatif][$row->nama_kriteria])){
        $subkriteria[$row->nama_alternatif][$row->nama_kriteria]=array();
    }
    if(!isset($nilai_kuadrat[$row->nama_kriteria])){
      $nilai_kuadrat[$row->nama_kriteria]=0;
    }
    $bobot[$row->nama_kriteria]=$row->bobot;
    $data[$row->nama_alternatif][$row->nama_kriteria]=$row->nama_subkriteria;
    $subkriteria[$row->nama_alternatif][$row->nama_kriteria]=$row->nama_subkriteria;
    $nilai_kuadrat[$row->nama_kriteria]+=pow($row->nilai,2);
    $kriterias[]=$row->nama_subkriteria;
  }
}
$kriteria     =array_unique($kriterias);
$jml_kriteria =count($kriteria);
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
                        <h1 class="mt-4">Metode Topsis</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Proses topsis</li>
                        </ol>
                        <ol class="breadcrumb mb-4">
                            <a href="addkriteria.php" class="btn btn-primary">Add</a>
                        </ol>

    <!-- DATA ALTERNATIF-->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Alternatif
                            </div>
                            <div class="card-body">
                            <p><?php echo $tampil; ?></p>

                                <div class="row">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                        <table id="datatablesSimple">
                                            <thead>
                                            <tr>
                                                <th rowspan='3'>No</th>
                                                <th rowspan='3'>Alternatif</th>
                                                <th rowspan='3'>Nama</th>
                                                <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                                            </tr>
                                            <tr>
                                                <?php
                                                foreach($kriteria as $k)
                                                echo "<th>$k</th>\n";
                                                ?>
                                            </tr>
                                            <tr>
                                                <?php
                                                for($n=1;$n<=$jml_kriteria;$n++)
                                                echo "<th style='width:80px'>K$n</th>";
                                                ?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $i=0;
                                            foreach($kriteria as $nama=>$krit){
                                                echo "<tr>
                                                <td>".(++$i)."</td>
                                                <th>A$i</th>
                                                <td>$nama</td>";
                                                foreach($kriteria as $k){
                                                echo "<td align='center'>$krit[$k]</td>";
                                                }
                                                echo "</tr>\n";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
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
