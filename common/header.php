<nav class="navbar navbar-expand-lg fixed-top" id="mynav" style="min-width:320px;">
<?php if(isset($_SESSION['id']) && $_SESSION['per']=='hospital'){?>
    <a class="navbar-brand brand" href="hospital.php"><span style="color:red;">Blood</span> Care</a>
<?php } else{?>
  <a class="navbar-brand brand" href="index.php"><span style="color:red;">Blood</span> Care</a>
<?php } ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color:#8cb654;margin-right:10px;">
      <i class="material-icons">&#xe8ee;</i>
    </button>
  
    <div class="navbar-collapse justify-content-lg-end collapse " id="navbarSupportedContent">
      <ul class="navbar-nav navul" >
        <li class="nav-item">
        <?php if(isset($_SESSION['id']) && $_SESSION['per']=='hospital'){?>
          <a class="nav-link navlins" href="hospital.php">Home</a>
        <?php }else{ ?>
          <a class="nav-link navlins" href="index.php">Home</a>
        <?php } ?>
        </li>
        <?php if(!isset($_SESSION['id'])){?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle  navlins" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="login.php?per=receiver">As Receiver</a>
          <a class="dropdown-item" href="login.php?per=hospital">As hospital</a>
        </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle navlins"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Signup
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="signupdropdown">
          <a class="dropdown-item" href="signup.php?per=receiver">As Receiver</a>
          <a class="dropdown-item" href="signup.php?per=hospital">As hospital</a>
        </div>
        </li>
        <?php }else{ ?>
          <li class="nav-item">
          <a class="nav-link navlins" href="logout.php">Logout</a>
        </li><?php } ?>
    </div>
  </nav>