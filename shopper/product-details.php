<?php
require 'connect.php';
?>
<?php
$quantity=1;
$quantityid=$addid="";
$id="";
if(isset($_GET['id']))
$id=$_GET['id'];
if($_SERVER["REQUEST_METHOD"]=="POST")
{
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
die();
}else if($_SESSION['type']=='admin'){
header('Location:portal.php');
}

    if(isset($_POST['add'])){
             //echo "here1";
            $id=$_POST['mobile'];
            if(filter_var($id, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false){
                
                header('Location:index.php');
                die();
            }
            //echo "here2";
            
            $q1="select * from mobiles where mobile_hash='".$id."'";
            $ret1=mysqli_query($mysqli,$q1);
            if(mysqli_num_rows($ret1)==0){
            
                header('Location:index.php');
                die();
            }
            //    echo "here3";
            //echo $_SESSION['id'];
            //echo $id;
            //echo $quantity;
            $q2= $mysqli->prepare('select * from cart where email=? and mobile_hash=?');
            $q2->bind_param('ss',$_SESSION['id'],$id);
            $q2->execute();
            $q2->bind_result($x1,$x2,$x3,$x4);
            $a=0;
            while($q2->fetch()){
                $a++;
            }
        
            if($a)
		{			
            echo '<script type="text/javascript">alert("Item already in cart.You will be redirected")</script>';
                header('Location:index.php');
            die();
		}
        //echo "here4";;
        $q=$mysqli->prepare("insert into cart(email,mobile_hash,quantity) values(?,?,?)");
        $q->bind_param('sss',$_SESSION['id'],$id,$y);
        $y=1;
        $q->execute();
    //    echo "here5";
        header('Location:index.php');
        die();
        
    
    }
}else{
       // echo $id;
    if($id!=""){
    $q="update mobiles set hits=hits+1 where mobile_hash='".$id."'";
    $ret=mysqli_query($mysqli,$q);
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
	
	<section>
		<div class="container">
			<div class="row">				
				<div class="col-sm-12 padding-right">
					<div class="product-details"><!--product-details-->
						<?php

if(filter_var($id, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false){
header('Location:index.php');
die();
}
$q="select * from mobiles where mobile_hash='".$id."'";
$ret=mysqli_query($mysqli,$q);
if(mysqli_num_rows($ret)!=1){
//header('Location:index.php');
die();
}
$row=mysqli_fetch_assoc($ret);
echo "<div class=\"col-sm-4\">
							<div class=\"view-product\">";
								echo "<img src=\"".$row['image']."\" alt=\"Image Not Available\" />
								<h3>ZOOM</h3>
							</div>
							

						</div>						
<div class=\"col-sm-8\">
							<div class=\"product-information\"><h2>".$row['mobile']."</h2>
								<p>Web ID: ".$row['mobile_hash']."</p>
								<span>
									<span>Rs ".$row['price']."</span>";
									?>

<form enctype="multipart/form-data" class="form-horizontal" name="comp" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> ">
                                    
									<input type="hidden" name="mobile" value="<?php echo $row['mobile_hash'] ?>" />
	<g:plus action="share"></g:plus>								<button type="submit" name="add" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
						<p><b><?php echo $addid; ?></b></p		
                        <p><b>Availability:</b><?php if($row['count']) echo "In Stock";else echo "Out of Stock"; ?></p>
								<p><b>Condition:</b> New</p>
								<p><b>Company:</b> <?php echo $row['company']; ?> </p>
		<a href="#">Share<i class="fa fa-share"></i></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
			
					
				</div>
			</div>
		</div>
	</section>
<?php
    include 'footer.php';
    ?>
	

  
    <script src="js/jquery.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
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