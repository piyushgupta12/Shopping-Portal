<?php 
require 'connect.php';
?>
<?php
$phoneid=$emailid=$nameid=$contactid=$signid="";
$f=1;
if($_SERVER["REQUEST_METHOD"]=="POST"){

    if(isset($_POST['sign'])){
        if(!empty($_POST['contact_name'])){
$name=$_POST['contact_name'];
$name=str_val($name);
$name=str_replace("'",";",$name);
$name=str_replace('"',';',$name);
}else{
$nameid="Field Required";
$f=0;
}

        if(!empty($_POST['contact_email'])){
        $contact_email=$_POST['contact_email'];
        
$contact_email=filter_var($contact_email,FILTER_SANITIZE_EMAIL);    
if(filter_var($contact_email,FILTER_VALIDATE_EMAIL)){
}else{
$emailid="enter formatted email";
$f=0;
}
    

        }else{
        $emailid="Field Required";
           $f=0;
        }
           
        if(!empty($_POST['contact_tel'])){
        $contact_tel=$_POST['contact_tel'];
        if(!filter_var($contact_tel,FILTER_VALIDATE_INT))
        {
    $phoneid="enter only digits";
        $f=0;
            }
        
        }else{
        $phoneid="Field Required";
           $f=0;
        }
           
           if(!empty($_POST['contact_message'])){
        $contact_message=$_POST['contact_message'];
        $contact_message=str_val($contact_message,$mysqli);
           }else{
           $contactid="Field Required";
           $f=0;
           }
        if($f){
        $to='cachme07@gmail.com';
        $subject='Contact form submitted';
        $body=$contact_message;
        $headers='From: '.$contact_email; 
        if(mail($to,$subject,$body,$headers)){
        }
        $to=$contact_email;
        $subject='Contact form submitted';
        $body='Hi'.$contact_name.'\n Thanks for contacting us.We\'ll be in touch soon.Regards: Piyush :D ';
        $headers='From: cachme07@gmail.com'; 
        if(mail($to,$subject,$body,$headers)){
        $signid= 'Check your mail folks!! .';
        }else{
        $signid= 'Sorry, an error occured.Try again later ';
        }
            
    }else{
    $signid=""; 
        }}
    
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
	 
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Contact <strong>Us</strong></h2>    			    				    				
					
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Name</label>
                                <input name="contact_name" type="text" maxlength="40" class="form-control">
                                <span><?php echo $nameid; ?> </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Email Address</label>
                                <input type="email" name="contact_email" maxlength="20" class="form-control">
                                <span><?php echo $emailid; ?> </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Phone Number</label>
                                <input type="tel" name="contact_tel" maxlength="12" class="form-control">
                                <span><?php echo $phoneid; ?> </span>
                            </div>
                            
                            <div class="form-group col-md-12">
                                <label>Message</label>
                                <textarea name="contact_message" class="form-control" maxlength="100" rows="6"></textarea>
                                <span><?php echo $contactid; ?> </span>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="submit" name="sign" class="btn btn-default">
                                <span><?php echo $signid; ?> </span>
                            </div>
                        </div>
                    </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>Address 1</p>
							<p>Address 1 Address 1 Address 1 Address 1 </p>
							<p>Address 1 Address 1 Address 1 </p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-111-111-111</p>
							<p>Email: Address 1</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	
<?php
    include 'footer.php';
    ?>
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="js/gmaps.js"></script>
	<script src="js/contact.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
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