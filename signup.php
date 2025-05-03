<?php require 'common/configurations.php';
if(isset($_SESSION['id']) && $_SESSION['per']=='hospital'){header('location:hospital.php');}
elseif(isset($_SESSION['id']) && $_SESSION['per']=='receiver'){header('location:samples.php');}
$as=(isset($_GET['sign']) ? $_GET['sign'] : '');
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
    <link rel="stylesheet" href="css/signup.css" /> 
	<script>
function messag(){
	var a=<?php if($as!="") echo $as; else echo 1; ?>;
if(a==0){alert("Email id already Registered");}}
	</script>
</head>
<body onLoad="messag();">
<?php include 'common/header.php' ;?>
 <div class="container ab">
 <div class="row"  style="justify-content:center;margin:0;">
 <div class=" col-md-8 col-lg-4">
 <h1><b>SIGN UP</b></h1><?php if($person=="hospital"){?><p>For Hospitals</p><?php } if($person=="receiver"){?>
 <p>For Receivers</p><?php } ?>

 <form method="POST" action="signup_script.php?per=<?php echo $person;?>">

 <div class="form-group">
 <input type="text" class="form-control" placeholder="Name" name="name"  required /></div>
 <div class="form-group">
 <input type="email" class="form-control" placeholder="Email" name="email"   required /></div>
  <div class="form-group">
 <input type="password" class="form-control" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}" title="Must contain at least one number,one uppercase and lowercase letter, and at least 5 or more characters" required /></div>
 <div class="form-group">
 <input type="tel" class="form-control" placeholder="Contact" name="contact" pattern="[0-9]{10}" title="Enter 10-digit phone no. e.g.-9971099999" required /></div>
 <?php if($person=="receiver"){?>
    <div class="form-group">
 <input type="text" class="form-control" placeholder="Address" name="address" required /></div>
 <div class="form-group">
<select class="form-control" name="bloodtype">
<option value="" disabled selected>--Blood Type--</option>
<option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option></select>
    </div>
<?php } else{?>
    <div class="form-group">
    <select id="states" class="form-control" name="address">
</select>
 </div>
<?php }?>
<div class="form-group">
     <input type="submit" class="btn btn-primary" value="Submit"/></div></form>
    </div></div></div>
    <?php require 'common/footer.php' ?>
    <script><?php if($person=="hospital"){?>
     var states=document.getElementById('states');
        var option=document.createElement('option');
        option.setAttribute('selected','true');
        option.setAttribute('value',"");
        option.innerHTML="--State--";
        option.setAttribute('disabled','true');
        states.appendChild(option);
        <?php $states=file_get_contents("states.json");
        $states=json_decode($states);
        sort($states);
        foreach($states as $state){
        ?>
            option=document.createElement('option');
            option.innerHTML="<?php echo $state; ?>";
            option.setAttribute('value','<?php echo $state ?>');
            states.appendChild(option);
        <?php } }?>
    </script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 </body></html>