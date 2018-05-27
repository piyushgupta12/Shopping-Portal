<?php
require 'connect.php';
$x=$_GET['id'];
$x=str_val($x,$mysqli);
$q="select * from mobiles where mobile_hash='".$x."'";
$ret=mysqli_query($mysqli,$q);
$row=mysqli_fetch_assoc($ret);
var_dump($row);
$image=$row['image1'];
header("Content-Type: image/jpeg");
echo file_get_contents($image);
echo $image;

?> 