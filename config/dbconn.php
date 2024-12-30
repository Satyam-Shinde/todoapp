<?php 
$localhost = "localhost";
$username = "root";
$password = "Satyam@1677";
$database = "todos";

$conn = mysqli_connect($localhost,$username,$password,$database);

if($conn){
    // echo "Connected";
}
else{
    echo $conn->error;
}
?>