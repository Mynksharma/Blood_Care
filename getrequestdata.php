<?php require 'common/configurations.php';
$sql="select receiver.recname,request.id,receiver.address,receiver.contact,request.resolved,receiver.bloodtype from hospital,receiver,request where request.hosid=hospital.hosid and request.recid=receiver.recid and hospital.hosid=".$_SESSION['id'];
$result=mysqli_query($con,$sql);$arr=array();
while($r=mysqli_fetch_assoc($result)){
$arr[]=$r;
}
print_r(json_encode($arr));
?>