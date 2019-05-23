<?php  
include('config/conn.php');

$id = $_POST['id'];
$result = mysqli_query($conn, "DELETE FROM names WHERE id='$id'")


?>