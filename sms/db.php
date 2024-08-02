<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "users";

// $server = "sql305.epizy.com";
// $username = "epiz_33343430";
// $password = "nBbT25AXMnZvhsV";
// $database = "epiz_33343430_users";
$conn = mysqli_connect($server,$username,$password,$database);
if($conn){
    
}else{
    die("Error".mysqli_connect_error());
}
?>

