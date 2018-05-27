<?php
session_start();
$host="localhost";
$user="root";
$pass="";
$db="shopper";
$mysqli=mysqli_connect($host,$user,$pass,$db) or die("Error " . mysqli_error($mysqli));

function str_val($str,$mysqli){
$str=filter_var($str,FILTER_SANITIZE_STRING);
$str=filter_var($str,FILTER_SANITIZE_SPECIAL_CHARS);
$str=str_replace("%","p",$str);
$str=addslashes($str);
mysqli_real_escape_string($mysqli,$str);
return $str;
}
?>