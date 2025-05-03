<?php require 'common/configurations.php';
$state=$_GET['state'];
$type=$_GET['type'];
if(stristr($type,'pos')){
    $type=str_replace("pos","+",$type);
}
if($state=="all" && $type=="all")
$sql="select hosid,hosname,state,contact,availbloodtype from hospital";
elseif ($state!="all" && $type=="all")
$sql="select hosid,hosname,state,contact,availbloodtype from hospital where state='$state'";
elseif ($state=="all" && $type!="all")
$sql="select hosid,hosname,state,contact,availbloodtype from hospital where FIND_IN_SET('$type',availbloodtype)";
else $sql="select hosid,hosname,state,contact,availbloodtype from hospital where state='$state' and FIND_IN_SET('$type',availbloodtype)";
$result=mysqli_query($con,$sql);$json_array=array();
while($row=mysqli_fetch_assoc($result)){
    $json_array[]=$row;
    }
     print_r(json_encode($json_array)); ?>