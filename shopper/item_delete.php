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
$x=0;
$cartid=$_POST['cartid'];
$cartid=str_val($cartid,$mysqli);
$q4="delete from cart where cartid='".$cartid."'";
if(mysqli_query($mysqli,$q4))
$x=1;
else
$x=0;

echo $x;
?>