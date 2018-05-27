<?php
require 'connect.php';
?>
<?php
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
}else if($_SESSION['type']!='admin'){
header('Location:login.php');
}
?>
<?php
$opass=$pass=$rpass="";
$signinid=$opassid=$passid=$rpassid="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
if(isset($_POST['signin'])){
if(!empty($_POST['opass'])){
    $opass=$_POST['opass'];
    $y= $_SESSION['id'];
    $q1="select * from register where email='".$y."'";
    $ret=mysqli_query($mysqli,$q1);
    if(mysqli_num_rows($ret)!=1){
    
        $signinid="you are not registered";
    }else{
    $z=mysqli_fetch_assoc($ret);
    if($opass!=$z['password']){
    $opassid="old password is wrong";
    }else{
        if(!empty($_POST['pass'])){
    $pass=$_POST['pass'];
        if(!empty($_POST['rpass'])){
        $rpass=$_POST['rpass'];
            if($rpass!=$pass){
            $rpassid="fields dont match";    
            }else{
            $q="update register set password='".$pass."'where email='".$y."'";
            $re=mysqli_query($mysqli,$q);
            $signinid="password changed successfully";
            }
        }else{
        $rpassid="required";
        }
    
    }else{
    $passid="Field Required";
        }
    }
    }}
}else{
$opassid="Field Required";
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
include 'header1.php';
    ?>

	
	<section>
		<div class="container">
			<div class="row">
				
				
				<div class="col-sm-9 col-sm-offset-3 padding-right">
                    
					<div class="features_items"><!--features_items-->
                        <br>
                        <form enctype="multipart/form-data" class="form-horizontal" name="regform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> ">
                    <fieldset>
                        <div class="col-sm-4 col-sm-offset-1">
                            <p style="text-color:green"><?php  ?></p>
                            
                        
                    <div class="control-group">
              <label class="control-label" for="password"><strong>OLD PASSWORD</strong></label>
              <div class="controls">
                <input id="opass" name="opass" class="form-control" type="password" value="" placeholder="********" class="input-large" required=""><span id="opassid"><?php echo $opassid ?></span>
                </div>
            </div>
                        
                    <div class="control-group">
              <label class="control-label" for="password"><strong>NEW PASSWORD</strong></label>
              <div class="controls">
                <input id="pass" name="pass" class="form-control" type="password" value="" placeholder="********" class="input-large" required=""><span id="passid"><?php echo $passid ?></span>
                </div>
            </div>
            
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="reenterpassword"><strong>CONFIRM PASSWORD</strong></label>
              <div class="controls">
                <input id="rpass" class="form-control" name="rpass" type="password" placeholder="********" class="input-large" required=""><span id="rpassid"><?php echo $rpassid ?></span>
              </div>
            </div>    
                        <div class="control-group">
              <div class="controls">
                <input id="signin" name="signin" class="btn btn-success" type="submit" onclick="">
              </div><span class="signinid"><?php echo $signinid; ?></span>
            </div>
                        
                    
                        </div>
				</fieldset>
                    
                    </form>
				
                        
						
						
					</div><!--features_items-->

					
				</div>
			</div>
		</div>
	</section>

	
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!--<script src="js/jquery.scrollUp.min.js"></script>-->
	<script src="js/price-range.js"></script>
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