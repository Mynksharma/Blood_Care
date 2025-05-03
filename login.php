<?php require 'common/configurations.php';
if(isset($_SESSION['id']) && $_SESSION['per']=='hospital'){header('location:hospital.php');}
elseif(isset($_SESSION['id']) && $_SESSION['per']=='receiver'){header('location:samples.php');}
$as=(isset($_GET['login']) ? $_GET['login'] : '');
$person=(isset($_GET['per']) ? $_GET['per'] : '');
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css" /> 	
	<script>
function messag(){
	var a=<?php if($as!="") echo $as; else echo 1; ?>;
if(a==0){alert("Enter valid email or password");}}
	</script>
</head>
<body onLoad="messag();">
<?php  include 'common/header.php'; ?>
 <div class="container ab">
 <div class="row" style="justify-content:center;margin:0;">
 <div class="col-md-8 col-lg-5">
 <div class="login">
 <div class="heading"><h2 style="font-weight:bold;">LOGIN</h2></div>
 <div class="body">
 <?php if($person=="hospital"){?>
<p>Login to help people to get blood</p><?php }?>
<?php if($person=="receiver"){?>
<p>Login to get blood</p><?php }?>
 <form method="POST" action="loginsubmit.php?per=<?php echo $person;?>">
 <div class="form-group">
 <input type="email" class="form-control" placeholder="Email" name="email" required /></div>
 <div class="form-group">
 <input type="password" class="form-control" placeholder="Password" name="password" required /></div>
<div class="form-group"> <input type="submit" class="btn btn-primary" value="Submit"/></div>
 </form></div>
 <div class="loginfooter" >Don't have an account?<a href="signup.php?per=<?php echo $person ?>" style="color:red;"> Register</a></div>
 </div></div>
 </div>
 </div>
 <?php require 'common/footer.php' ?>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
 </body></html>