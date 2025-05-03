<?php require 'common/configurations.php';
 if(isset($_SESSION['id']) && $_SESSION['per']=='hospital'){
  header('location:hospital.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css" /> 
    <title>Blood Bank</title>
</head>
<body>
 <?php require 'common/header.php' ?>
  <div class="banner">
        <div class="banner_content">
        <h2>Need blood</h2>
        <h2>We are here to help you</h2>
       <a class="hyperlink" href="samples.php"><button class="btn-lg" type="button">Search for blood</button> </a>
        </div>
  </div>
  <div class="row whoweare_row" >
    <div class="col-md-6 who_we_are">
        <h1>Who We Are?</h1>
<p>
Blood Buddies is for public donation center with blood donation members in the changing health care system.</p>
<ul>
<li>Specialist blood donors and clinical supervision.</li>
<li>Increasing communication with our members.</li>
<li>Specialist blood donors and clinical supervision.</li>
<li>Increasing communication with our members.</li>
</ul>
    </div>
    <div class="col-md-6 col-0">
<img src="images/doc.jpg" alt="" style="width:100%;height:300px;" id="docimg"/>
</div>
  </div>
  <div class="row achievements_row">
  <div class="col-12 achievements">
  <h1>OUR ACHIEVEMENTS</h1>
  <hr style="border:2px solid red;width:50%;margin-top:0;"/>
  <p>We have been working since 1956 with a prestigious vision to helping patient to provide blood.</p>
  <div class="row cards">
      <div class="cards_inner col-12 col-sm-3">
        <div>
          <img src="images/user.png" alt="">
          <p style="color:red;font-size:30px;">3434</p>
          <p>Happy Recipient</p>
        </div>
      </div>
      <div class="cards_inner col-12 col-sm-3">
      <div>        
          <img src="images/star.png" alt="">
          <p style="color:red;font-size:30px;">3434</p>
          <p>Total Awards</p>
        </div>
      </div>
  </div>
  </div>
  </div>
<?php require 'common/footer.php' ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</body>
</html>