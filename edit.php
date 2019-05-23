<?php  
include('config/conn.php');


$name = $_POST['name'];
$id = $_POST['id'];


$result = mysqli_query($conn, "UPDATE names SET name='$name' WHERE id='$id'")

?>