<?php require 'common/configurations.php';
if(isset($_SESSION['id']) && $_SESSION['per']=='receiver'){
  header('location:samples.php');
    }  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/requests.css" /> 
    <title>Document</title>
    <script>
    function data(){
        var xhttp=new XMLHttpRequest();
	xhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
				var c=this.responseText;
				var decode=JSON.parse(c);
        var tabledata=document.querySelector(".table_row div table");
        if(decode.length==0){
            document.getElementById('norecords').style.display="block";
        }else{
            document.getElementById('norecords').style.display="none";
        }
        for(d of decode){
        var tr=document.createElement('tr');var td;
        var datasample=[d['recname'],d['address'],d['bloodtype'],d['contact']];
        for(var i=0;i<4;i++){
            td=document.createElement('td');
            td.classList.add('thhidden');
                tr.appendChild(td);
            if(i==2){       
                var blood=datasample[2];
                var box,bloodspan;
                    bloodspan=document.createElement('span');
                    bloodspan.classList.add('bloodspan');
                    bloodspan.innerHTML=blood;
                    td.appendChild(bloodspan);
                continue;
            }
            td.innerHTML=datasample[i];
        }
        td=document.createElement('td');
        td.classList.add('thhidden');
        var btn=document.createElement('button');btn.setAttribute('data-x',d['id']);
        if(d['resolved']=="No"){
            btn.classList.add("btn","btn-outline-success");
        btn.innerHTML="Resolve";
        btn.addEventListener('click',function(){
            btnpress(this,this.parentElement.nextElementSibling.lastElementChild);
        })
        }
        else if(d['resolved']=="Yes"){
            btn.classList.add("btn","btn-success");
        btn.innerHTML="Resolved";btn.setAttribute('disabled',true);
        }
        td.appendChild(btn);
        tr.appendChild(td);
        var td=document.createElement('td');
        td.classList.add('mob');var p;
        for(var i=0;i<4;i++){
            p=document.createElement('p');
            p.innerHTML=datasample[i];td.appendChild(p);
            }
            btn=document.createElement('button');btn.setAttribute('data-x',d['id']);
            if(d['resolved']=="No"){
            btn.classList.add("btn","btn-outline-success");
        btn.innerHTML="Resolve";
        btn.addEventListener('click',function(){
            btnpress(this,this.parentElement.previousElementSibling.firstElementChild);
        });
        }else if(d['resolved']=="Yes"){
            btn.classList.add("btn","btn-success");
        btn.innerHTML="Resolved";btn.setAttribute('disabled',true);
        }
            td.appendChild(btn);
            tr.appendChild(td);
        tabledata.appendChild(tr);}
        }
    }
    xhttp.open("GET","getrequestdata.php",true);xhttp.send();
    }
    function btnpress(btn1,btn2){console.log(btn1,btn2);
                    btn1.innerHTML="Resolved";
                    btn2.innerHTML="Resolved";
                    btn1.classList.remove("btn-outline-success");
                    btn2.classList.remove("btn-outline-success");
                    btn1.classList.add("btn-success");
                    btn2.classList.add("btn-success");
                var xht=new XMLHttpRequest();
                xht.open("GET","resolved.php?reqid="+btn1.getAttribute('data-x'),true);xht.send();
    }
</script>
</head>
<body onload="data();">
<?php require 'common/header.php' ?>
<div class="row table_row">
    <div class="col-12" id="tab">
        <table ><tr>
        <th>REQUESTER</th>
        <th class="thhidden">ADDRESS</th>
        <th class="thhidden">BLOOD GROUP</th>
        <th class="thhidden">CONTACT</th>
        <th class="thhidden">REQUEST STATUS</th>
        </tr>
        </table>
        <span id="norecords" style="display:none;margin:0 auto;width:200px;padding:20px;">No Records Found</span>
    </div>
</div>
<?php require 'common/footer.php' ?>
</body>