<?php
require 'connect.php';
?>
<?php
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
}
?>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "180";
header("Refresh: $sec; url=$page");
?>
<?php
$addid="";
$id="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    if(isset($_POST['add'])){
       
            $id=$_POST['mobile'];
            if(filter_var($id, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]*$/"))) === false){
                //echo "here2";
                header('Location:index.php');
                die();
            }
            $q1="select * from mobiles where mobile_hash='".$id."'";
            $ret1=mysqli_query($mysqli,$q1);
            if(mysqli_num_rows($ret1)==0){
                header('Location:index.php');
                die();
            }
     //       echo $_SESSION['id'];
       //     echo $id;
        //    echo $quantity;
            $q2= $mysqli->prepare('select * from cart where email=? and mobile_hash=?');
            $q2->bind_param('ss',$_SESSION['id'],$id);
            $q2->execute();
            $q2->bind_result($x1,$x2,$x3,$x4);
            $a=0;
            while($q2->fetch()){
                $a++;
            }
        
            if($a==0)
		{			
        $q=$mysqli->prepare("insert into cart(email,mobile_hash,quantity) values(?,?,?)");
        $q->bind_param('sss',$_SESSION['id'],$id,$x);
        $x=1;
        $q->execute();
            
            }

        $q2="delete from wishlist where email='".$_SESSION['id']."' and mobile_hash='".$id."'";
        $ret2=mysqli_query($mysqli,$q2);  
        
        
    
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
<div class="header-bottom">
			<div class="container">
				<div class="row">
					
                    
				</div>
			</div>
		</div>
	<br>
	<section>
		<div class="container">
			<div class="row">
				
				<div class="col-sm-8 col-sm-offset-2 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">WISHLIST/REMINDER</h2>
                        <div class="output_data">
						<?php
                        $q5="select * from wishlist where email='".$_SESSION['id']."'";
                        $ret5=mysqli_query($mysqli,$q5);
                        while($row5=mysqli_fetch_assoc($ret5)){
                        $q="select * from mobiles where mobile_hash='".$row5['mobile_hash']."'";
                        $ret=mysqli_query($mysqli,$q);
                        while($row=mysqli_fetch_assoc($ret)){
                        echo '<div class="col-sm-4">
							     <div class="product-image-wrapper">
								    <div class="single-products">
										<div class="productinfo text-center">';
                            $data=$row['image'];
                            echo "<a href=\"product-details.php?id=".$row['mobile_hash']."\" ><img src=\"".$data."\" alt=\"Image Not Available\"/></a>";
                            
                            echo '<h2>'.$row['price'].'</h2>';
                            echo '<p><strong>Company: </strong>'.$row['company'].'</p>';
                            echo '<p><strong>Name: </strong>'.$row['mobile'].'</p>';
                            ?>
                            <form enctype="multipart/form-data" class="form-horizontal" name="comp" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> ">
                                <input type="hidden" class='childo' name="mobile" value="<?php echo $row['mobile_hash'] ?>" />
<button type="submit" name="add" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
                                </button></form>
                              <?php
                                echo '</div></div></div></div>';
                        }
                        }
                        ?>
                        
                        
                        
						
					</div>
					</div><!--features_items-->

					
				</div>
			</div>
		</div>
	</section>
	
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
	
$('.comp').click(function(){
//	console.log("click");
	var companies=[];
	$(".brands-name input:checked").each(function(){
		var cname=$(this).attr('value');
		//console.log(cname);
        companies.push(cname);	
		
	
		});
		
	console.log("companies="+companies);	
	
	$.post('ref_checkbox.php',{comp:companies},function(data){
		//console.log(data);
        $(".output_data").html(data);
		});
	
});
        $("#admin_room_query").keyup(function(){
            var room_no=$("#admin_room_query").val();
            $.post('searchbox.php',{item:room_no},function(data){
                console.log(data);
                //$("#test_output").html(data);
                $(".output_data").html(data);
            });
        });

    $(".wisher").click(function(){
var x=$(this).parent().parent().parent().parent().children('.single-products').children('.text-center').children('.form-horizontal').children('.childo').val();
        console.log(x);
        $.post('wishlist1.php',{wish:x},function(data){
        console.log(data);
            $(".wish"+x).html(data);
        });
        
    });
    
    $( ".hello" ).click(function() {
        console.log("hello");
         window.location.reload(true);
});
    
});
            
</script>
    
</body>
</html>