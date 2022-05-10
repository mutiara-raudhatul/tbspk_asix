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
        <nav class="navbar navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            Dewan Komputer
        </a>
        </nav>

        <div class="container mb-5">
            <h2 text-align="center" style="margin: 60px 10px 10px 10px;">Dewan Demo Combobox Bertingkat Daerah Indonesia</h2><hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>kriteria</label>
                        <select class="form-control" name="kriteria" id="kriteria">
                            <option value=""> Pilih kriteria</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>subkriteria</label>
                        <select class="form-control" name="subkriteria" id="subkriteria">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nilai</label>
                        <input required class="form-control" type="number" name="nilai" value="nilai">
                    </div>

                </div>
            </div>
            <hr>
        </div>

        <div class="navbar bg-dark fixed-bottom">
            <div style="color: #fff;">© <?php echo date('Y'); ?> Copyright:
                <a href="https://dewankomputer.com/"> Dewan Komputer</a>
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
                var kabupaten = $("#subkriteria").val();
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
        </script>


    </body>
</html>