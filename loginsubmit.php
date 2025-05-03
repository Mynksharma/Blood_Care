<?php 
require 'common/configurations.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$email=$_POST['email'];
$password=md5($_POST['password']);
if($_GET['per']=='hospital'){
$sql="SELECT hosid FROM hospital WHERE email='$email' AND password='$password'";  }
else{
    $sql="SELECT recid,bloodtype FROM receiver WHERE email='$email' AND password='$password'"; 
}
$query=mysqli_query($con,$sql);
if(!$query){die("connection failed:".mysqli_error());}
if(mysqli_num_rows($query)==0){
    if($_GET['per']=='hospital'){
header('Location:login.php?per=hospital&login=0');}
else if($_GET['per']=='receiver'){
    header('Location:login.php?per=receiver&login=0');}
}
else{
    $row=mysqli_fetch_array($query);
    if($_GET['per']=='hospital'){
    $_SESSION['id']= $row['hosid'];
    $_SESSION['per']="hospital";
    header('Location:hospital.php');}

    else if($_GET['per']=='receiver'){
        $_SESSION['id']= $row['recid'];
        $_SESSION['bloodtype']= $row['bloodtype'];
        $_SESSION['per']="receiver";
        header('Location:samples.php');
    }
}}
?>