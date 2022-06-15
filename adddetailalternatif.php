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

    $sqlkriteria="SELECT * FROM tb_kriteria";
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

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                            <li class="breadcrumb-item active"><a href="alternatif.php">Alternatif</a></li>
                            <li class="breadcrumb-item active">Tambah Detail Alternatif</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tambah detail alternatif
                            </div>
                            <div class="card-body"> </div>
                            <form class="form" action="prosesadddetailalternatif.php" method="post">
                                        <div class="container">
                                       
                                                                              
                                        <div class="row">
                                            <div class="col-1">
                                                <div class="form-group">
                                                    <label hidden for="id_alternatif" class="form-label">Id Alternatif</label>
                                                    <input hidden required class="form-control" type="text" name="id_alternatif" value="<?php echo $ida ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                            <div class="form-group">
                                                <label>kriteria</label>
                                                    <select class="form-control" name="kriteria" id="kriteria">
                                                        <option value=""> Pilih kriteria</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>subkriteria</label>
                                                    <select class="form-control" name="subkriteria" id="subkriteria">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    <label hidden>nilai</label>
                                                    <select hidden class="form-control" name="nilai" id="nilai">
                                                        <!-- <option value="" selected></option> -->
                                                    </select>
                                                </div>
                                            </div>
                                       
                                            <!-- <div class="col-sm">
                                                <div class="form-group">
                                                <label>Nilai</label>
                                                <input class="form-control" type="number" id="nilai" name="nilai" value="nilai">
                                                </div>

                                            </div> -->
                                        </div>                               
                                                                        
                                    <div class="navbar bg-dark fixed-bottom">
                                        <div style="color: #fff;">
                                            <!-- 0 <?php echo date('Y'); ?>  -->
                                            Copyright:
                                            <a href="#">ASIX</a>
                                        </div>
                                    </div> 

                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $.ajax({
                                                type: 'POST',
                                                url: "get_kriteriaa.php",
                                                cache: false, 
                                                success: function(msg){
                                                $("#kriteria").html(msg);
                                                }
                                            });

                                            $("#kriteria").change(function(){
                                            var kriteria = $("#kriteria").val();
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "get_subkriteriaa.php",
                                                    data: {kriteria: kriteria},
                                                    cache: false,
                                                    success: function(msg){
                                                    $("#subkriteria").html(msg);
                                                    }
                                                });
                                            });

                                            $("#subkriteria").change(function(){
                                            var subkriteria = $("#subkriteria").val();
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "get_nilai.php",
                                                    data: {subkriteria: subkriteria},
                                                    cache: false,
                                                    success: function(msg){
                                                    $("#nilai").html(msg);
                                                    }
                                                });
                                            });
                                            

                                        });
                                        
                                        // $(document).ready(function() {
                                        // $('#subkriteria').change(function() { // Jika select box id kurir dipilih
                                        //     var subkriteria = $(this).val(); // Ciptakan variabel kurir
                                        //         $.ajax({
                                        //             type: 'POST', // Metode pengiriman data menggunakan POST
                                        //         url: 'get_nilai.php', // File pemroses data
                                        //         data: 'subkriteria=' + subkriteria, // Data yang akan dikirim ke file pemroses yaitu ada 2 data
                                        //         success: function(response) { // Jika berhasil
                                        //             $('#nilai').val(response); // Berikan hasilnya ke id biaya
                                        //             }
                                        //     });
                                        //     });
                                        // });
                                        
                                    </script>
                                
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
