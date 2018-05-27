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
$f=1;
$item=$_POST['item'];
$cartid=$_POST['cartid'];
$cartid=str_val($cartid,$mysqli);
if(filter_var($item, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false)
$f=0;
if($f){
$q5="select * from cart where cartid='".$cartid."'";
$ret5=mysqli_query($mysqli,$q5);
$row5=mysqli_fetch_assoc($ret5);
$q6="select * from mobiles where mobile_hash='".$row5['mobile_hash']."'";
$ret6=mysqli_query($mysqli,$q6);
$row6=mysqli_fetch_assoc($ret6);
if($row6['count']<$item){
    $f=0;
echo '<script type="text/javascript">alert("Select less quantity")</script>';
}else{    
$q4="update cart set quantity='".$item."' where cartid='".$cartid."'";
if(mysqli_query($mysqli,$q4)){
$f=1;
echo $f;
}}
}