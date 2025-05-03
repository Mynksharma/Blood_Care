<?php require 'common/configurations.php';
$reqid=$_GET['reqid'];
$sql="UPDATE request SET resolved='Yes' WHERE id='$reqid'";
mysqli_query($con,$sql);
?>