<?php
$db = mysqli_connect("localhost", "root", "", "db_spk");

function signup($data){
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    //confirm password
    if($password !== $password2){
        echo"
        <script>
                alert('konfirmasi password tidak sesuai!');
        </script>
        ";
        return false;
    }
    //cek username
    $result = mysqli_query($db,"SELECT username FROM users WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert ('username telah terdaftar!');    
            </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($db, "INSERT INTO users VALUES('','$username','$password')");
    return mysqli_affected_rows($db);
}