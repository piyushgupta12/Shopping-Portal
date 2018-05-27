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
date_default_timezone_set("Asia/Kolkata"); 
$z=date("D d M Y g:i A");
$x=$_POST['add'];
$q="select * from register where email='".$_SESSION['id']."'";
$ret=mysqli_query($mysqli,$q);
$row=mysqli_fetch_assoc($ret);
$file=fopen("install.txt",'r');
$f=fread($file,filesize("install.txt"));
fclose($file);
$f=$f."Thankyou ".$row['name']." for having faith in us!\r\n\r\nOrder Details: \r\n\r\n";
$f=$f."Date: ".$z."\r\n\r\n";
$f=$f."Name: ".$row['name']."\r\n\r\n";
$f=$f."Email: ".$row['email']."\r\n\r\n";
$q1="select * from address where addressid='".$x."'";
$ret1=mysqli_query($mysqli,$q1);
$row1=mysqli_fetch_assoc($ret1);
$f=$f."Contact Number: ".$row1['contact']."\r\n\r\nAddress:\r\n\r\n";
$f=$f."Street Address: ".$row1['street']." \r\n\r\n";
$f=$f."City: ".$row1['city']." \r\n\r\n";
$f=$f."State: ".$row1['state']." \r\n\r\n";
$f=$f."Pin Code: ".$row1['pin']." \r\n\r\n";
$file=fopen("address.txt","w");
fwrite($file,$f);
fclose($file);
header('Location:bill.php');
die();
?>