<?php  
include('config/conn.php');


$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$charactersLength = strlen($characters);
$randomString = '';
for ($i = 0; $i < 10; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
}

$name = $_POST['name'];
$key = $randomString;

$result = mysqli_query($conn, "INSERT INTO names (name, Pkey) VALUES ('$name', '$key')");


?>