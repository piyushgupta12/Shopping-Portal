<?php
require 'connect.php';
?>
<?php
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
}
?>
<?php
$hash=$_POST['wish'];
if(!filter_var($hash, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false)
        {
    $q="select * from wishlist where mobile_hash='".$hash."'";
    $ret=mysqli_query($mysqli,$q);
    if(mysqli_num_rows($ret)==0){
    $q1=$mysqli->prepare("insert into wishlist(email,mobile_hash) values (?,?)");
    $q1->bind_param('ss',$_SESSION['id'],$hash);
    $q1->execute();
    echo '<i class="fa fa-plus-square"></i>Added';
    }else{
    echo '<i class="fa fa-plus-square"></i>Already Added';
    }
            
}
?>