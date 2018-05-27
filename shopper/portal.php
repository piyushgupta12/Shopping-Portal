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
$units=$mobile=$units=$cname=$ccount=$company=$name=$mobid=$price=$count=$desc=$image="";
$mobilecountid=$unitsid=$mobileid=$unitsid=$cnameid=$ccountid=$companyid=$nameid=$mobidid=$priceid=$countid=$descid=$imageid="";
$f=1;
if($_SERVER["REQUEST_METHOD"]=="POST"){   
    if(isset($_POST['cname'])){
    
            if(!empty($_POST['cname'])){
            $cname=$_POST['cname'];
            $cname=str_val($cname,$mysqli);    
            $q1="select * from company where company='".$cname."'";
            $ret=mysqli_query($mysqli,$q1);
            if(mysqli_num_rows($ret)!=0)
                {
                $companyid="dont manipulate";
                $f=0;
                }
            }else{
            $companyid="Field Required";
            $f=0;
            }
        
         
        if($f){
        $q=$mysqli->prepare("insert into company values(?,?)");
            $q->bind_param('ss',$cname,$ccount);
            $ccount=0;
            $q->execute();
        }
            
    }
    
    if(isset($_POST['mob'])){
    
        if(!empty($_POST['company'])){
            $company=$_POST['company'];
            $company=str_val($company,$mysqli);    
            $q1="select * from company where company='".$company."'";
            $ret=mysqli_query($mysqli,$q1);
            if(mysqli_num_rows($ret)!=1)
            {
                $companyid="dont manipulate";
                $f=0;
            }
  //          var_dump($company);
        }else{
            $companyid="Field Required";
            $f=0;
        }
       if(!empty($_POST['name'])){
            $name=$_POST['name'];
            $name=str_val($name,$mysqli);    
            $q1="select * from mobiles where     mobile='".$name."'";
            $ret=mysqli_query($mysqli,$q1);
            if(mysqli_num_rows($ret)!=0)
            {
                $nameid="Name exists";
                $f=0;
            }
    //       var_dump($name);
        }else{
            $nameid="Field Required";
           $f=0;
        }
        
        if(!empty($_POST['mobid'])){
            $mobid=$_POST['mobid'];
            $mobid=str_val($mobid,$mysqli);    
            $q1="select * from mobiles where mobile_hash='".$mobid."'";
            $ret=mysqli_query($mysqli,$q1);
            if(mysqli_num_rows($ret)!=0)
            {
                $mobidid="ID exists";
                $f=0;
            }
      //      var_dump($mobid);
        }else{
            $mobidid="Field Required";
            $f=0;
        }
        
        if(!empty($_POST['price'])){
            $price=$_POST['price'];    
            if(filter_var($price, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false)
            {
               
                $priceid="enter only digits";
                $f=0;
            } 
        }else{
            $priceid="Fields Required";
            $f=0;
            }
        
        if(!empty($_POST['count'])){
            $count=$_POST['count'];
            if(filter_var($count, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false)
            {
                
                $countid="enter only digits";
                $f=0;
            }
        }else{
            $countid="Fields Required";
            $f=0;
        }
        
        if(!empty($_POST['desc'])){
            $desc=$_POST['desc'];
            $desc=str_val($desc,$mysqli);
        }else{
            $descid="Field Required";
            $f=0;
        }
/*        
$image=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $image_name=addslashes($_FILES['image']['name']);
    $imageFileType = pathinfo($image_name,PATHINFO_EXTENSION);
    $image_size = getimagesize($_FILES["image"]["tmp_name"]);
    if($image_size == false) {
        $imageid="File is not an image.";
        $f= 0;
    }
    if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $f = 0;
}
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $imageid="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $f= 0;
}
*/       
 //echo $f;      
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
    $imageid="File is an image - " . $check["mime"] . ".";
    } else {
    $imageid="File is not an image.";
        $f = 0;
    }


if (file_exists($target_file)) {
   $imageid="Sorry, file already exists.";
    $f = 0;
}

if ($_FILES["image"]["size"] > 5000000) {
   $imageid="Sorry, your file is too large.";
    $f = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" 
&& $imageFileType != "gif" ) {
    $imageid="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $f = 0;
}

if (!$f) {
  $imageid="Sorry, your file was not uploaded.";
}else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
     $imageid="The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
    $imageid="Sorry, there was an error uploading your file.";
    }
}
        
        if($f){
            $q=$mysqli->prepare("insert into mobiles values(?,?,?,?,?,?,?,?,?)");
            $q->bind_param('sssssssss',$company,$name,$price,$count,$mobid,$desc,$target_file,$x1,$x2);
            $x1=$x2=0;
            $q->execute();            
            $q1="update company set mobile_count=mobile_count+1 where company='".$company."'";
            $ret1=mysqli_query($mysqli,$q1);
        }
        
    }
    
  if(isset($_POST['mobilecount'])){
  
            if(!empty($_POST['mobile'])){
            $mobile=$_POST['mobile'];
            $mobile=str_val($mobile,$mysqli);    
            $q1="select * from mobiles where mobile='".$mobile."'";
            $ret=mysqli_query($mysqli,$q1);
            if(mysqli_num_rows($ret)==0)
                {
                $mobileid="dont manipulate";
                $f=0;
                }
            }else{
            $mobileid="Field Required";
            $f=0;
            }
      
            if(!empty($_POST['units'])){
            $units=$_POST['units'];
            if(filter_var($units, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false)
            {
                $unitsid="enter only digits";
                $f=0;
            }
        }else{
            $unitsid="Fields Required";
            $f=0;
        }
        
         
      
        if($f){
        
        $q="update mobiles set count=count + ".$units." where mobile='".$mobile."'";
        if(mysqli_query($mysqli,$q)){
        $mobilecountid="Successfully Updated";
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
include 'header1.php';
    ?>

	
	<section>
		<div class="container">
			<div class="row">
				
				
				<div class="col-sm-9 col-sm-offset-1 padding-right">
					<div class="features_items"><!--features_items-->
                       
                        <div class="col-sm-3 col-sm-offset-1">
                            <p style="text-color:green"><?php  ?></p>
                            <form enctype="multipart/form-data" class="form-horizontal" name="comp" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> "><fieldset>
                                  <h2 class="title text-center">Add Company</h2>
                                  
                              <div class="control-group">
                <label class="control-label" for="userid"><strong>COMPANY NAME</strong></label>
              <div class="controls">
                  <input id="name" name="cname" class="form-control" type="text" placeholder="Name" class="input-large" value="<?php ?>" required=""><span id="nameid"><?php ?></span>

              </div>
            </div>
                                
                               
                    <div class="control-group">
              <label class="control-label" for="confirmsignup"></label>
              <div class="controls">
                <input id="confirmsignup" name="comp" class="btn btn-success" value="Sign Up" type="submit" onclick="return re()">
                  
              </div>
            </div>             
                                </fieldset></form>
                        </div>
				
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
                        						
                        <div class="col-sm-3 ">
                            <p style="text-color:green"><?php  ?></p>
                            <h2 class="title text-center">Add Mobile</h2>
				<!--	<div class="signup-form"><!--sign up form-->
						
<form enctype="multipart/form-data" class="form-horizontal" name="mob" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> ">
            <fieldset>
                
            <!-- Sign Up Form -->
                
            <!-- Text input-->
                <p style="text-color:green"><?php  ?></p>
           
            
                        <!-- Text input-->
                            <div class="control-group">
              <label class="control-label" for="userid"><strong>COMPANY</strong></label>
              <div class="dropdown" style="color:black;">
 <select name="company">
     <?php
     $q="select * from company";
$ret= mysqli_query($mysqli,$q);
while($q1=mysqli_fetch_assoc($ret)){
    echo "<option value='".$q1['company']."'>".$q1['company']."</option>";
    }
     ?>           </select>
                  <span id="categoryid" ><?php ?></span>
</div>            </div>
             
                <div class="control-group">
                <label class="control-label" for="userid"><strong>MOBILE NAME</strong></label>
              <div class="controls">
                  <input id="name" name="name" class="form-control" type="text" placeholder="Name" class="input-large" value="<?php echo $name; ?>" required=""><span id="nameid"><?php echo $nameid; ?></span>
              </div>
            </div>
                
            <div class="control-group">
                <label class="control-label" for="userid"><strong>MOBILE ID</strong></label>
              <div class="controls">
                  <input id="mobile" name="mobid" class="form-control" type="text" placeholder="ID" class="input-large" value="<?php echo $mobid; ?>" required=""><span id="nameid"><?php echo $mobidid; ?></span>
              </div>
            </div>
                
             

                <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="userid"><strong>PRICE</strong></label>
              <div class="controls">
                <input id="price" name="price" class="form-control" type="text" placeholder="Price" value="<?php echo $price; ?>" class="input-large" required=""><span id="phoneid" ><?php echo $priceid; ?></span>
              </div>
            </div>
                
           
                
                    <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="userid"><strong>COUNT</strong></label>
              <div class="controls">
                <input id="count" name="count" class="form-control" type="text" placeholder="Count" value="<?php echo $count; ?>" class="input-large" required=""><span id="fphoneid" ><?php echo $countid; ?></span>
              </div>
            </div>
                
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="userid"><strong>DESCRIPTION</strong></label>
              <div class="controls">
                  <textarea id="desc" name="desc" class="form-control"  placeholder="Features" value="<?php echo $desc; ?>" class="input-large" required=""></textarea><span id="addressid" ><?php echo $descid; ?></span>
              </div>
            </div>
                    

            
              <!-- Text input-->
            <div class="control-group">
              <label class="control-label" for="reenterpassword"><strong>UPLOAD IMAGE</strong></label>
              <div class="controls">
                <input id="image" class="form-control" name="image" type="file" placeholder="********" class="input-large" required=""><span id="image1id"><?php echo $imageid; ?></span>
              </div>
            </div> 
                <!--
                <div class="control-group">
              <label class="control-label" for="reenterpassword"><strong>UPLOAD IMAGE</strong></label>
              <div class="controls">
                <input id="image" class="form-control" name="image2" type="file" placeholder="********" class="input-large" required=""><span id="image2id"><?php //echo $imageid; ?></span>
              </div>
            </div> 
                <div class="control-group">
              <label class="control-label" for="reenterpassword"><strong>UPLOAD IMAGE</strong></label>
              <div class="controls">
                <input id="image" class="form-control" name="image3" type="file" placeholder="********" class="input-large" required=""><span id="image3id"><?php //echo $imageid; ?></span>
              </div>
            </div> 
                -->         
            <!-- Button -->
            <div class="control-group">
              <label class="control-label" for="confirmsignup"></label>
              <div class="controls">
                <input id="mob" name="mob" class="btn btn-success" value="Sign Up" type="submit"><!-- onclick="return re()">
                  -->
              </div>
            </div>
            </fieldset>
            </form>
					<!--</div><!--/sign up form-->
				</div>
						
					<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
                        
                     <div class="col-sm-3 ">
                            <p style="text-color:green"><?php  ?></p>
                            <form enctype="multipart/form-data" class="form-horizontal" name="mobilecount" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> "><fieldset>
                                  <h2 class="title text-center">INCREASE QUANTITY</h2>
                                  
                               <div class="control-group">
              <label class="control-label" for="userid"><strong>MOBILE</strong></label>
              <div class="dropdown" style="color:black;">
 <select name="mobile">
     <?php
     $q="select * from mobiles";
$ret= mysqli_query($mysqli,$q);
while($q1=mysqli_fetch_assoc($ret)){
    echo "<option value='".$q1['mobile']."'>".$q1['mobile']."</option>";
    }
     ?>           </select>
                  <span id="categoryid" ><?php ?></span>
</div>            </div>
                        
                                
                        <div class="control-group">
              <label class="control-label" for="userid"><strong>COUNT INCREASE</strong></label>
              <div class="controls">
                <input id="units" name="units" class="form-control" type="text" placeholder="Price" value="<?php echo $units; ?>" class="input-large" required=""><span id="unitsid" ><?php echo $unitsid; ?></span>
              </div>
            </div>
                                
                                <div class="control-group">
              <label class="control-label" for="confirmsignup"></label>
              <div class="controls">
                <input id="confirmsignup" name="mobilecount" class="btn btn-success" value="Sign Up" type="submit" onclick="return re()">
                  <span><?php echo $mobilecountid; ?></span>
              </div>
            </div>
                        
                                </fieldset></form>
                        </div>
                      	
					</div><!--features_items-->

					
				</div>
			</div>
		</div>
	</section>
	<br>
	<?php
    include 'footer.php';
    ?>
	

  
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
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