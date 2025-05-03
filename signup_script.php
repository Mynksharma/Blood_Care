<?php
require 'common/configurations.php' ;
$name=$_POST['name'];
$contact=$_POST['contact'];
$password=md5($_POST['password']);
$email=$_POST['email'];
$address=$_POST['address'];
if($_GET['per']=='receiver'){
$bloodtype=$_POST['bloodtype'];
$sql="SELECT recid FROM receiver WHERE email='$email'";}
else{$sql="SELECT hosid FROM hospital WHERE email='$email'";}
$row=mysqli_query($con,$sql);
if(mysqli_num_rows($row)>0){
header('Location:signup.php?per='.$_GET['per'].'&sign=0');
}
else{
    if($_GET['per']=='receiver'){
$sql="INSERT INTO receiver(email,recname,address,password,bloodtype,contact) VALUES ('$email','$name','$address','$password','$bloodtype','$contact')";}
else{
    $sql="INSERT INTO hospital(email,hosname,password,state,contact) VALUES ('$email','$name','$password','$address','$contact')";  
}
mysqli_query($con,$sql);
$pr=mysqli_insert_id($con);
$_SESSION['id']=$pr;
if($_GET['per']=='receiver'){
    $_SESSION['bloodtype']=$_POST['bloodtype'];
    $_SESSION['per']='receiver';
header("Location:samples.php");}
if($_GET['per']=='hospital'){
    $_SESSION['per']='hospital';
    header("Location:hospital.php");}
}
?>
