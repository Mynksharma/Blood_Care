<?php  require 'common/configurations.php';
if(isset($_SESSION['id']) && $_SESSION['per']=='receiver'){
  header('location:samples.php');
    }
$sql="select hosname,state,contact,availbloodtype from hospital where hosid=".$_SESSION['id'];
$result=mysqli_query($con,$sql);
$content=mysqli_fetch_assoc($result);
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
    <link rel="stylesheet" href="css/hospital.css" /> 
    <title>Blood Bank</title>
</head>
<body>
<?php require 'common/header.php' ?>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal-head" style="font-weight:bold;">Add or Delete blood groups</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="modcontent" style="text-align:center;">
       <h6 style="color:red;font-weight:bold">Available Blood groups at hospital</h6>
       <div class="bloodavail"><?php echo $content['availbloodtype'];?></div>
       <hr>
       <h6 style="color:red;font-weight:bold;">Add new</h6>
       <div class="bloodnew"></div>
        </div>
      </div>
    </div>
  </div>
<div class="row content">
<div class="col-12 hosdetails">
<h1><?php echo $content['hosname'];?></h1>
<h5>State: <?php echo $content['state'];?></h4>
<h5 style="display:inline-block;">Contact: <span id="con"><?php echo $content['contact'];?></span></h5>
<span id="editbtn"><img src="images/pencil.png" style="width:16px;height:16px;"/> Edit</span>
</div>
</div>
<div class="row content2">
<div class="col-sm-6 opt">
<div class="optinner" data-toggle="modal" data-target="#myModal">
    <h5 style="text-align:center;font-weight:bold;">Add or Delete Blood Groups</h5>
</div>
</div>
<div class="col-sm-6 opt">
<a href="requests.php" style="text-decoration:none;color:black;">
<div class="optinner">
    <h5 style="text-align:center;font-weight:bold;">View Requests</h5>
</div></a>
</div>
</div>
<?php require 'common/footer.php' ?>
<script>
    var editbtn=document.getElementById('editbtn');
    editbtn.addEventListener('click',function(){
        document.getElementById('con').innerHTML="";
        var input=document.createElement('input');
        input.setAttribute('type','tel');
        input.setAttribute('maxlength','10');
        input.style.width="100px";
        input.style.fontSize="1.00rem";input.setAttribute('id','contactinput');
        document.getElementById('con').appendChild(input);
        editbtn.innerHTML="";
        var newspan=document.createElement('span');
        editbtn.appendChild(newspan);
        newspan.innerHTML="Save";
        newspan.addEventListener('click',function(){
          contactupdate();
        });
    });
    function contactupdate(){
      var contact=document.getElementById('contactinput').value;
      var patt = new RegExp("[0-9]{10}");
  var res = patt.test(contact);
      if(res){
      var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var c=this.responseText;
        document.getElementById('con').innerHTML=c;
        var editbtn=document.getElementById('editbtn');
        editbtn.innerHTML="";
        var addimg=document.createElement('img');
    addimg.src="images/pencil.png";
    addimg.style.width="16px";addimg.style.height="16px";editbtn.appendChild(addimg);
    var text=document.createTextNode('Edit');
    editbtn.appendChild(text);
        }
        
        }
        xhttp.open("GET","updatecontactdata.php?con="+document.getElementById('contactinput').value,true);xhttp.send();}else{
          alert('Invalid contact number.It should be a 10-digit number');
        }
    }
    function addingstyletoblood(abc,classname){
     
      if(abc.length>0 && abc[0]!=''){
      var bloodspan;var add;var box;
      for(var k=0;k<abc.length;k++){
        if(k==0 || k==3){
           box=document.createElement('div');
           box.style.marginBottom="10px";
           document.getElementsByClassName(classname)[0].appendChild(box);
         }
    bloodspan=document.createElement('span');
    bloodspan.classList.add('bloodspan');
    bloodspan.innerHTML=abc[k];
    add=document.createElement('img');
    add.classList.add('modalimgpng');
    add.src=(classname=='bloodavail') ? "images/criss-cross.png": "images/add.png";
    add.style.width="16px";
    add.style.height="16px";let b=abc[k];let val='';
    if(abc[k].indexOf('+')>0){
      for(let m=0;m<b.length-1;m++){
        val=val+b[m];
      }
      }else{
        val=b;
      }
    add.setAttribute('data-x',(classname=='bloodavail') ? val+"del":val+"add");
    bloodspan.appendChild(add);
    add.addEventListener("click",function(){
      var xht=new XMLHttpRequest();
      xht.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
        document.getElementsByClassName('bloodavail')[0].innerHTML=	this.responseText;
        modalblood();
				}}
      xht.open("GET","addordeleteblood.php?addordel="+this.getAttribute('data-x'),true);
      xht.send();
    });
    add.style.marginLeft="5px";  
    box.appendChild(bloodspan);     
    }}else{
      document.getElementsByClassName(classname)[0].innerHTML="NO BLOOD AVAILABLE";
    }
    }
    function modalblood(){
    var modalbloodavail=document.getElementsByClassName('bloodavail')[0].innerHTML.trim();
    document.getElementsByClassName('bloodavail')[0].innerHTML="";
    document.getElementsByClassName('bloodnew')[0].innerHTML="";
    var blood=modalbloodavail.split(",");
     var allbloodsamples=['A+','A-','AB+','AB-','B+','B-'];
     console.log(blood,allbloodsamples);
     var bloodnew=allbloodsamples.filter(x=> !blood.includes(x));
    addingstyletoblood(blood,'bloodavail');
    addingstyletoblood(bloodnew,'bloodnew');
    }
    modalblood();
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</body>
</html>