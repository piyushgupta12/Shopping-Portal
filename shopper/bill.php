<?php
require 'connect.php';
?>
<?php
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
}else if($_SESSION['type']=='admin'){
header('Location:portal.php');
}
?>
<?php
$q="select * from cart where email='".$_SESSION['id']."'";
$ret=mysqli_query($mysqli,$q);
$file=fopen("bill.txt","w");
$f="";
$total=0;
while($row=mysqli_fetch_assoc($ret)){
$q1="select * from mobiles where mobile_hash='".$row['mobile_hash']."'";
$ret1=mysqli_query($mysqli,$q1);
$row1=mysqli_fetch_assoc($ret1);
$f=$f.$row1['mobile'].";".$row1['mobile_hash'].";".$row1['price'].";".$row['quantity'].";".$row['quantity']*$row1['price']."\r\n";
$total+=$row['quantity']*$row1['price'];
$q2="update mobiles set count=count-".$row['quantity'].",sold=sold + ".$row['quantity']." where mobile_hash='".$row1['mobile_hash']."'";
$ret2=mysqli_query($mysqli,$q2);
$q3="delete from cart where mobile_hash='".$row1['mobile_hash']."'";
$ret3=mysqli_query($mysqli,$q3);
}
$f=$f.";;;"."Total".";".$total."\r\n";

fwrite($file,$f);
fclose($file);
header('Location:color.php');
?>