<?php require 'common/configurations.php';
$str=$_GET['addordel'];
$sql="select availbloodtype from hospital where hosid=".$_SESSION['id'];
$res=mysqli_query($con,$sql);
$r=mysqli_fetch_assoc($res);
if($pos=strpos($str,"add")){
    $blood=substr($str,0,$pos);
    $blood=(strpos($str,'-')!=FALSE) ? $blood : $blood.="+";
    $blood=$r['availbloodtype'].",".$blood;
    $blood=trim($blood,',');
    $sql="UPDATE hospital SET availbloodtype='$blood' WHERE hosid=".$_SESSION['id'];
    mysqli_query($con,$sql);
    
}else if($pos=strpos($str,"del")){
    $blood=substr($str,0,$pos);
    $blood=(strpos($str,'-')!=FALSE) ? $blood : $blood.="+";
    $availbloodtype=explode(',',$r['availbloodtype']);
    $b='';
    for($i=0;$i<count($availbloodtype);$i++){
            if($availbloodtype[$i]==$blood){
                continue;
            }else{
                $b=$b.$availbloodtype[$i].",";
            }
    }
    $b=trim($b,',');
    $sql="UPDATE hospital SET availbloodtype='$b' WHERE hosid=".$_SESSION['id'];
    mysqli_query($con,$sql);
}
$sql="select availbloodtype from hospital where hosid=".$_SESSION['id'];
$res=mysqli_query($con,$sql);
$r=mysqli_fetch_assoc($res);
die($r['availbloodtype']);
?>