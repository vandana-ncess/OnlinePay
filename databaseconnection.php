<?php

$username="root";
$password="";
$database="ncess_onlinepayment";
$conn=mysqli_connect("localhost",$username,$password);
mysqli_select_db($conn,$database);
return $conn;
?>