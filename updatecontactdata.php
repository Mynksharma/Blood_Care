<?php require 'common/configurations.php';
$cn=$_GET['con'];
$sql="UPDATE hospital SET contact='$cn' WHERE hosid=".$_SESSION['id'];
mysqli_query($con,$sql);
$sql="select contact from hospital where hosid=".$_SESSION['id'];
$result=mysqli_query($con,$sql);
$r=mysqli_fetch_assoc($result);
echo $r['contact'];
?>