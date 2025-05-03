<?php
require 'common/configurations.php';
$user=$_SESSION['id'];
$hosid=$_GET['hosid'];
$blood=$_SESSION['bloodtype'];
$sql="insert into request(hosid,recid,requestbloodtype,resolved) values('$hosid','$user','$blood','No')";
mysqli_query($con,$sql);
?>
