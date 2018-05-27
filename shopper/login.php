<?php
//db connection
require 'connect.php';
?>
<?php
if(isset($_SESSION['id'])&&isset($_SESSION['type'])){
header('Location:index.php');
}
?>
<?php
if(isset($_SESSION['id'])&&isset($_SESSION['type'])){
header('Location:index.php');
}
?>
<?php

//form variables

$name=$email1=$email2=$pass=$cpass=$password="";

//form span error variables
$loginid=$registerid=$nameid=$email1id=$email2id=$passid=$cpassid=$passwordid="";
$f=1;
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['login'])){
        
        if(!empty($_POST['email1'])){
            $email1=$_POST['email1'];
            $email1=filter_var($email1,FILTER_SANITIZE_EMAIL);    
            if(!filter_var($email1,FILTER_VALIDATE_EMAIL)){
                $email1id="enter formatted email";
                $f=0;
                }       
        }else{
            $email1id="enter valid email";
            $f=0;
        }
        
        if(isset($_POST['password'])){
            $password=$_POST['password'];
            $password=str_val($password,$mysqli);
            //salting can be applied here  
            //$salt="piyush3";
            //$pass=md5($salt.md5($pass.$salt));
        }else{
            $passwordid="Field Required";
            $f=0;
}
        
        if($f){
          if($email1=='piyush.knl@hotmail.com'&&$password=='summerintern'){
            $_SESSION['id']=$email1;
            $_SESSION['type']='admin';
            header('Location:portal.php');
              die();
            }
            $q=$mysqli->prepare("select * from register where email=? and password=?");
            $q->bind_param('ss',$email,$passer);     
            $email=$email1;
            $passer=$password;
            $q->execute();
            $a=0;
            $q->bind_result($x1,$x2,$x3);
            while($q->fetch()){
                $a++;    
    }
        if($a!=1){
        $loginid="Email/Password is wrong";
        }else{
            session_start();
            $_SESSION['type']='member';
            $_SESSION['id']=$email1;
            header('Location:index.php');
        }
        
        }
    }
    
    if(isset($_POST['register'])){
        
        if(!empty($_POST['name'])){
            $name=$_POST['name'];
            $name=str_val($name,$mysqli);
        }else{
            $nameid="Field Required";
            $f=0;
        }
     
        if(!empty($_POST['email2'])){
            $email2=$_POST['email2'];
            $email2=filter_var($email2,FILTER_SANITIZE_EMAIL);    
            if(!filter_var($email2,FILTER_VALIDATE_EMAIL)){
                $email2id="enter formatted email";
                $f=0;
                }       
        }else{
            $email2id="enter valid email";
            $f=0;
        }
        
        if(isset($_POST['pass'])){
            $pass=$_POST['pass'];
            $pass=str_val($pass,$mysqli);
            //$salt="b2015";
            //$pass=md5($salt.md5($pass.$salt));
            
            if(isset($_POST['cpass'])){
                $cpass=$_POST['cpass'];
                $cpass=str_val($cpass,$mysqli);
                //$salt="b2015";
                //$pass=md5($salt.md5($pass.$salt));
                if($cpass!=$pass){
                    $cpassid="Fields dont match";
                    $f=0;
                }
            }else{
                $cpassid="Field Required";
                $f=0;
            }
            
        }else{
            $passid="Field Required";
            $f=0;
}
        if($f){
            $q=$mysqli->prepare("select * from register where email=?");
            $q->bind_param('s',$email);     
         $email=$email2;
            $q->execute();
            $a=0;
            $q->bind_result($x1,$x2,$x3);
            while($q->fetch()){
                $a++;    
    }if($a!=0){
    $email2id="This is already registered";
    }else{
        $q=$mysqli->prepare("insert into register values(?,?,?)");
        $q->bind_param('sss',$x4,$x5,$x6);
        $x4=$name;
        $x5=$email2;
        $x6=$pass;        
        $q->execute();
        $registerid="Successfully registered";
    }  
        
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
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form name="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<input name="email1" type="email" placeholder="Email Address" /><span class=""><?php echo $email1id; ?></span>
							<input name="password" type="password" placeholder="Password" /><span class=""><?php echo $passwordid; ?></span>
                            <!--
                            <span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>-->
							<button name="login" type="submit" class="btn btn-default">Login</button><span class=""><?php echo $loginid; ?></span>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form name="register" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
							<input name="name" type="text" placeholder="Name"/><span class=""><?php echo $nameid; ?></span>
							<input name="email2" type="email" placeholder="Email Address"/><span class=""><?php echo $email2id; ?></span>
							<input name="pass" type="password" placeholder="Password"/><span class=""><?php echo $passid; ?></span>
							<input name="cpass" type="password" placeholder="Confirm Password"/><span class=""><?php echo $cpassid; ?></span>
							<button name="register" type="submit" class="btn btn-default">Signup</button><span class=""><?php echo $registerid; ?></span>
						</form>
					</div><!--/sign up form-->
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