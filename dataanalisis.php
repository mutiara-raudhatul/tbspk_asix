<?php
//koneksi
include ("koneksi.php");

$tampil = $db->query("SELECT b.nama_alternatif,c.nama_kriteria,a.id_subkriteria,d.nama_subkriteria,a.nilai,c.bobot
      FROM
        tb_topsis a
        JOIN
          tb_alternatif b USING(id_alternatif)
        JOIN
          tb_kriteria c USING(id_kriteria)
        JOIN
          tb_subkriteria d USING(id_subkriteria)");

$data      =array();
$kriterias =array();
$bobot     =array();

if ($tampil) {
  while($row=$tampil->fetch_object()){
    if(!isset($data[$row->nama_alternatif])){
      $data[$row->nama_alternatif]=array();
    }
    if(!isset($data[$row->nama_alternatif][$row->nama_kriteria])){
      $data[$row->nama_alternatif][$row->nama_kriteria]=array();
    }

    $data[$row->nama_alternatif][$row->nama_kriteria]=$row->nama_subkriteria;
    $kriterias[]=$row->nama_kriteria;
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
        <title>DSS ASIX</title>
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
                        <h1 class="mt-4">Data Analisis</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Analisis</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Kriteria
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                        <thead>
                                        <tr >
                                            <th rowspan='3'>No</th>
                                            <th rowspan='3'>Alternatif</th>
                                            <th rowspan='3'>Nama</th>
                                            <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach($kriteria as $k)
                                            echo "<th align='center'>$k</th>\n";
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            for($n=1;$n<=$jml_kriteria;$n++)
                                            echo "<th align='center'>K$n</th>";
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i=0;
                                        foreach($data as $nama=>$krit){
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
