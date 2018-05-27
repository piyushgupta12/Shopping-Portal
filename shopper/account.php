<?php
//db connection
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

//form variables
$name=$street=$city=$state=$pin=$contact="";
//form span error variables
$loginid=$nameid=$streetid=$cityid=$stateid=$pinid=$contactid="";

$f=1;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['login'])){
   
     
        if(!empty($_POST['street'])){
            $street=$_POST['street'];
            $street=str_val($street,$mysqli);
        }else{
            $streetid="Field Required";
            $f=0;
        }
 
        if(!empty($_POST['city'])){
            $city=$_POST['city'];
            $city=str_val($city,$mysqli);
        }else{
            $cityid="Field Required";
            $f=0;
        }
 
        if(!empty($_POST['state'])){
            $state=$_POST['state'];
            $state=str_val($state,$mysqli);
        }else{
            $stateid="Field Required";
            $f=0;
        }
 
        if(!empty($_POST['contact'])){
            $contact=$_POST['contact'];
            if(filter_var($contact, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false)
                {
                $contactid="enter only digits";
                $f=0;
                }
        }else{
            $contactid="Fields Required";
            $f=0;
        }
 
        if(!empty($_POST['pin'])){
            $pin=$_POST['pin'];
            if(filter_var($pin, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false)
                {
                $pinid="enter only digits";
                $f=0;
                }
        }else{
            $pinid="Fields Required";
            $f=0;
        }
         
        
        
        if($f){
            $q=$mysqli->prepare("insert into address(email,street,city,state,pin,contact) values(?,?,?,?,?,?)");
            $q->bind_param('ssssss',$_SESSION['id'],$street,$city,$state,$pin,$contact);
            $q->execute();
            $loginid="Successfully Added";
        }
        
}
    


}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>
<body>
<?php
    include 'header.php';
    ?>
	
	<section id="form"><!--form-->
		<div class="container">
		<div class="row">
            <h2 class="title text-center">Available Address</h2>
                    <?php 
				$q="select * from address where email='".$_SESSION['id']."'";
                $ret=mysqli_query($mysqli,$q);
                while($row=mysqli_fetch_assoc($ret)){
                echo '<div class="col-sm-4 "> <div class="'.$row['addressid'].'" >';
                echo '<p><strong>Street Address: '.$row['street'].'<p>';
                echo '<p><strong>City:</strong> '.$row['city'].'<p>';
                echo '<p><strong>State:</strong> '.$row['state'].'<p>';
                echo '<p><strong>Pin:</strong> '.$row['pin'].'<p>';
                
                    echo '</div></div>';
                }
?>
				</div>
            
            <div class="row">
                <h2 class="title text-center">Add Address</h2>
				<div class="col-sm-6 col-sm-offset-3">
					<div class="login-form"><!--login form-->
						<h2></h2>
						<form name="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<fieldset>
                            <input type="text" name="street" placeholder="Street Address" /><span class=""><?php echo $streetid; ?></span>
							<input type="text" name="city" placeholder="City" /><span class=""><?php echo $cityid; ?></span>
							<input type="text" name="state" placeholder="State" /><span class=""><?php echo $stateid; ?></span>
                            <input type="text" name="pin" placeholder="Pin Code" /><span class=""><?php echo $pinid; ?></span>
                            <input type="text" name="contact" placeholder="Contact Number" /><span class=""><?php echo $contactid; ?></span>
							<input name="login" type="submit" class="btn btn-default"><span class=""><?php echo $loginid; ?></span>
						      </fieldset>
                            </form>
					</div><!--/login form-->
				</div>
				
			</div>
		</div>
	</section><!--/form-->
	
<?php
    include 'footer.php';
    ?>
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
    <script>
$(document).ready(function(){  
  $( ".hello" ).click(function() {
        console.log("hello");
         window.location.reload(true);
});
});
</script>
</body>
</html>