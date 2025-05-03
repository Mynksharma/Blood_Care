<?php require 'common/configurations.php';
  if(isset($_SESSION['id']) && $_SESSION['per']=='receiver'){
$sql="select hospital.hosname from receiver,request,hospital where receiver.recid=request.recid and request.hosid=hospital.hosid and receiver.recid='".$_SESSION['id']."'";
$result=mysqli_query($con,$sql);$array1[]=0;
    while($find=mysqli_fetch_assoc($result)){
     $array1[]=$find['hosname'];
   }
  }elseif(isset($_SESSION['id']) && $_SESSION['per']=='hospital'){
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
    <link rel="stylesheet" href="css/samples.css" /> 
    <title>Document</title>
    <script>
    function data(type,st){
        <?php if(isset($_SESSION['id'])){ ?>
                        var userblood='<?php echo $_SESSION['bloodtype']; ?>';
                        var ar = <?php echo '["' . implode('", "', $array1) . '"]' ?>;
                   <?php } ?>
        var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var c=this.responseText;
				var decode=JSON.parse(c);
        var tabledata=document.querySelector(".table_row div table");
        while(tabledata.children.length!=1){
            tabledata.removeChild(tabledata.lastChild);
            k++;
        }
        if(decode.length==0){
            document.getElementById('norecords').style.display="block";
        }else{
            document.getElementById('norecords').style.display="none";
        }
        for(d of decode){
        var tr=document.createElement('tr');var td;
        var datasample=[d['hosname'],d['state'],d['availbloodtype'],d['contact']];
        for(var i=0;i<4;i++){
            td=document.createElement('td');
            td.classList.add('thhidden');
                tr.appendChild(td);
            if(i==2){       
                var blood=datasample[2].split(",");var box,bloodspan;
                for(var k=0;k<blood.length;k++){
                    if(k%2==0){
                        box=document.createElement('div');
                        box.style.marginBottom="10px";
                        td.appendChild(box);
                    }
                    bloodspan=document.createElement('span');
                    bloodspan.classList.add('bloodspan');
                    bloodspan.innerHTML=blood[k];
                    <?php if(isset($_SESSION['id'])){ ?>
                        if(blood[k]!=userblood){bloodspan.style.color="#b9b4b4";}
                   <?php } ?>
                    box.appendChild(bloodspan);
                }
                continue;
            }
            td.innerHTML=datasample[i];
        }
        td=document.createElement('td');
        td.classList.add('thhidden');
        var btn=document.createElement('button');
        btn.setAttribute('data-x',d['hosid']);
        <?php if(isset($_SESSION['id'])){ ?>
                if(ar.includes(d['hosname'])){
                    btn.classList.add("btn","btn-success");
                    btn.innerHTML="Requested";
                }else{
            btn.classList.add("btn","btn-outline-success");
            btn.innerHTML="Request"; 
                }
                btn.addEventListener('click',function(){reqbtnupdate(this,this.parentElement.nextElementSibling.lastElementChild)});
            <?php }else{?>
            btn.classList.add("btn","btn-outline-success");
            btn.innerHTML="Request";
            btn.addEventListener('click',function(){
                location.href="login.php?per=receiver";
            });
            <?php } ?>
        td.appendChild(btn);
        tr.appendChild(td);
        var td=document.createElement('td');
        td.classList.add('mob');var p;
        for(var i=0;i<4;i++){
            p=document.createElement('p');
            p.innerHTML=datasample[i];td.appendChild(p);
            }
            btn=document.createElement('button');
            btn.setAttribute('data-x',d['hosid']);
            <?php if(isset($_SESSION['id'])){ ?>
                if(ar.includes(d['hosname'])){
                    btn.classList.add("btn","btn-success");
            btn.innerHTML="Requested";
                }else{
            btn.classList.add("btn","btn-outline-success");
            btn.innerHTML="Request"; 
                }
             btn.addEventListener('click',function(){reqbtnupdate(this,this.parentElement.previousElementSibling.firstElementChild);}
            );
            <?php }else{?>
            btn.classList.add("btn","btn-outline-success");
            btn.innerHTML="Request";
            btn.addEventListener('click',function(){
                location.href="login.php?per=receiver";
            });
            <?php } ?>
            td.appendChild(btn);
            tr.appendChild(td);
        tabledata.appendChild(tr);
        <?php if(isset($_SESSION['id'])){  ?>
        if(d['availbloodtype'].indexOf("<?php echo $_SESSION['bloodtype']?>")==-1){
             tr.children[4].firstElementChild.setAttribute('disabled',true);
             tr.children[5].lastElementChild.setAttribute('disabled',true);
                }
            <?php } ?>
        }
        }
    }
    xhttp.open("GET","getsampledata.php?type="+type+"&state="+st,true);xhttp.send();
    }
    function reqbtnupdate(btn1,btn2,hosid){
        if(btn1.innerHTML=='Requested' && btn2.innerHTML=="Requested"){
                    btn1.setAttribute('disabled',true);
                    btn2.setAttribute('disabled',true);return;
                }else{
                    btn1.innerHTML="Requested";
                    btn2.innerHTML="Requested";
                    btn1.classList.remove("btn-outline-success");
                    btn2.classList.remove("btn-outline-success");
                    btn1.classList.add("btn-success");
                    btn2.classList.add("btn-success");
                }
                var xht=new XMLHttpRequest();
                xht.open("GET","addrequest.php?hosid="+btn1.getAttribute('data-x'),true);xht.send();
    }
</script>
</head>
<body onload="data('all','all');">
<?php require 'common/header.php' ?>
<div class="row choose">
<div class="col-md-5 col-12">
    <span>Blood Group</span>
    <select style="border:none;border-radius:5px;background-color:white;" id="type">
    <option selected value="all">--All--</option>
    <option value="Apos">A+</option>
    <option value="A-">A-</option>
    <option value="Bpos">B+</option>
    <option value="B-">B-</option>
    <option value="ABpos">AB+</option>
    <option value="AB-">AB-</option>
</select>
</div>
<div  class="col-md-5 col-12">
<span>State</span>
<select id="states" style="border:none;border-radius:5px;background-color:white;">
</select>
</div>
<div  class="col-md-2 col-12">
    <button class="btn searchbtn" type="button" onClick="search();">Search</button>
</div>
</div>
<div class="row table_row">
    <div class="col-12" id="tab">
        <table ><tr>
        <th>HOSPITAL</th>
        <th class="thhidden">STATE</th>
        <th class="thhidden">BLOOD GROUP</th>
        <th class="thhidden">CONTACT</th>
        <th class="thhidden">REQUEST SAMPLE</th>
        </tr>
        </table>
        <span id="norecords" style="display:none;margin:0 auto;width:200px;padding:20px;">No Records Found</span>
    </div>
    <div style="color:red;text-align:center;margin:5px;width:100%;"><i>*You can only request for your blood group 
    <?php   if(isset($_SESSION['id'])){echo ":".$_SESSION['bloodtype'];}  ?>
    </i></div>
</div>
<?php require 'common/footer.php' ?>
<script>
   var states=document.getElementById('states');
        states.style.width="160px";
        states.style.fontSize="14px";
        var option=document.createElement('option');
        option.setAttribute('selected','true');
        option.innerHTML="--All--";
        option.setAttribute('value','all');
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
        <?php } ?>
function search(){
    var type=document.getElementById('type').value;
    var state=document.getElementById('states').value;
    data(type,state);
}
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
</body>
</html>