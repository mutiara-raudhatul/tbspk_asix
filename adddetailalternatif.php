<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
}
    include ("koneksi.php");
    $id_alternatif_get = $_GET['id_alternatif'];
    //ambil alternatif
    $sqlida= "SELECT * FROM tb_alternatif WHERE id_alternatif='$id_alternatif_get'";
    $queryida = mysqli_query($db, $sqlida);
    $data_alternatif = mysqli_fetch_assoc($queryida);
    $ida=$data_alternatif['id_alternatif'];
    $namaa=$data_alternatif['nama_alternatif'];

    $sqlkriteria="SELECT * FROM tb_kriteria WHERE id_kriteria = 1";
    $querykriteria= mysqli_query($db,$sqlkriteria); 
    $data_k = mysqli_fetch_assoc($queryida);   

    $sqlc="SELECT count('id_kriteria') as jumlah_kriteria FROM tb_kriteria";
    $queryc= mysqli_query($db,$sqlc); 
    $datac = mysqli_fetch_assoc($queryc);   
    $idc= $datac['jumlah_kriteria'];    

    //ambil kriteria
    $sqlidk= "SELECT tb_subkriteria.id_kriteria, tb_kriteria.nama_kriteria, tb_subkriteria.id_subkriteria, tb_subkriteria.nama_subkriteria, tb_subkriteria.nilai
              FROM tb_subkriteria
              JOIN tb_kriteria WHERE tb_subkriteria.id_kriteria=tb_kriteria.id_kriteria";
    $queryidk = mysqli_query($db, $sqlidk);
    $data_kriteria = mysqli_fetch_assoc($queryidk);
    $idk=$data_kriteria['id_kriteria'];
    $namak=$data_kriteria['nama_kriteria'];
    $ids=$data_kriteria['id_subkriteria'];
    $namas=$data_kriteria['nama_subkriteria'];
    $nilai=$data_kriteria['nilai'];
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
                        <h1 class="mt-4">Tambah Detail Alternatif: <?php echo $namaa ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="home.php">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="altenatif.php">Alternatif</a></li>
                            <li class="breadcrumb-item active">Tambah Detail Alternatif</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah detail alternatif
                            </div>
                            <div class="card-body">
                            <form class="form" action="addalternatif.php" method="post">
                            <div class="mb-3">
                                <label for="id_alternatif" class="form-label">Id Alternatif</label>
                                <input required class="form-control" type="text" name="id_alternatif" value="<?php echo $ida ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <?php 
                                    while($data_k = mysqli_fetch_assoc($querykriteria) )
                                {?>
                                <label for="kriteria" class="form-label"><?php echo $data_k['nama_kriteria']?></label>
                                <!-- <input required class="form-control" type="text" name="id_kriteria" value="<?php echo $data_k['id_kriteria'] ?>" readonly> -->
                                <select name="kriteria" class="form-select" required hidden>
                                            <option value="<?php echo $data_k['id_kriteria']; ?>" selected><?php echo $data_k['nama_kriteria']; ?></option>
                                </select>
                                <select name="subkriteria" class="form-select" required>
                                    <option value="" hidden>select jenis</option>
                                        <?php 
                                        $k=$_POST['id_kriteria'];

                                        // for($i=1;$i<=$idc;$i++){
                                        $query = "SELECT * FROM tb_subkriteria JOIN tb_kriteria WHERE tb_kriteria.id_kriteria = 2";
                                        $result = mysqli_query($db, $query);
                                        
                                        if ($data_k['id_kriteria'])
                                        while($data = mysqli_fetch_assoc($result) ){?>
                                            <option value="<?php echo $data['id_subkriteria']; ?>"><?php echo $data['nama_subkriteria']; ?></option>
                                        <?php } ?>
                                </select>
                                <?php } ?>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="usia_pokdakan" class="form-label">Usia Pokdakan</label>
                                <select required class="form-select" name="usia_pokdakan" aria-label="Default select example">
                                    <option autofocus value="" hidden>Select</option>
                                    <option value=">5 Tahun">>5 Tahun</option>
                                    <option value="3-5 Tahun">3-5 Tahun</option>
                                    <option value="1-3 Tahun">1-3 Tahun</option>
                                    <option value="0-1 Tahun">0-1 Tahun</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="luas_kolam" class="form-label">Luas Kolam</label>
                                <select required class="form-select" name="luas_kolam" aria-label="Default select example">
                                    <option autofocus value="" hidden>Select</option>
                                    <option value=">400 m2">>400 m2</option>
                                    <option value="300-400 m2">300-400 m2</option>
                                    <option value="200-300 m2">200-300 m2</option>
                                    <option value="100-200 m2">100-200 m2</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="lokasi_kolam" class="form-label">Lokasi Kolam</label>
                                <select required class="form-select" name="lokasi_kolam" aria-label="Default select example">
                                    <option autofocus value="" hidden>Select</option>
                                    <option value="Sangat Baik">Sangat Baik</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Kurang Baik">Kurang Baik</option>
                                    <option value="Tidak Baik">Tidak Baik</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_anggota" class="form-label">Jumlah Anggota</label>
                                <select required class="form-select" name="jumlah_anggota" aria-label="Default select example">
                                    <option autofocus value="" hidden>Select</option>
                                    <option value=">20 Orang">>20 Orang</option>
                                    <option value="15-20 Orang">15-20 Orang</option>
                                    <option value="10-15 Orang">10-15 Orang</option>
                                    <option value="5-10 Orang">5-10 Orang</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rata2_produksi" class="form-label">Rata-rata Produksi</label>
                                <select required class="form-select" name="rata2_produksi" aria-label="Default select example">
                                    <option autofocus value="" hidden>Select</option>
                                    <option value=">15 Kg/m3">>15 Kg/m3</option>
                                    <option value="10-15 Kg/m3">10-15 Kg/m3</option>
                                    <option value="7-10 Kg/m3">7-10 Kg/m3</option>
                                    <option value="<7 Kg/m3"><7 Kg/m3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="domisili_anggota" class="form-label">Domisili Anggota</label>
                                <select required class="form-select" name="domisili_anggota" aria-label="Default select example">
                                    <option autofocus value="" hidden>Select</option>
                                    <option value="Mayoritas anggota berdomisili di desa/kampung yang sama dengan lokasi kolam">Mayoritas anggota berdomisili di desa/kampung yang sama dengan lokasi kolam</option>
                                    <option value="Mayoritas anggota berdomisili di desa/kampung yang berbeda namun tidak terlalu jauh dengan lokasi kolam">Mayoritas anggota berdomisili di desa/kampung yang berbeda namun tidak terlalu jauh dengan lokasi kolam</option>
                                    <option value="Mayoritas anggota berdomisili jauh dari lokasi kolam">Mayoritas anggota berdomisili jauh dari lokasi kolam</option>
                                </select>
                            </div> -->
                                <input class="btn btn-primary" type="submit" name="save" value="Add">
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
