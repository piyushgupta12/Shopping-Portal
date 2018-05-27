<?php
require 'connect.php';
?>
<?php
$addid="";
$id="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
die();
}else if($_SESSION['type']=='admin'){
header('Location:portal.php');
}
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
					
					<div class="col-sm-3">
						<div class="search_box pull-right ">
							    <div class="input-group">
     
      <form method="post" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <fieldset>
                
                
            <!-- Sign In Form -->
            
<div class="control-group">
    
              <div class="controls">
                <input id="admin_room_query" name="roll" class="form-control" type="text" placeholder="Mobile Name" class="input-medium" >
              </div>
            </div>

                 
                
            </fieldset>
            </form>
    </div>
						</div>
					</div>
                    
                    
                    
				</div>
			</div>
		</div>
	<br>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php 
                                    $q3="select * from company";
                                    $ret3=mysqli_query($mysqli,$q3);
                                    while($row3=mysqli_fetch_assoc($ret3))
                                    {
                                    echo '<li><a href="#">'.$row3['company'].' ('.$row3['mobile_count'].')<input type="checkbox" value="'.$row3['company'].'" class="comp"></a></li>';
                                    
                                    }
                                    ?>
                                    </ul>
							</div>
						</div><!--/brands_products-->
						
					<!--	<div class="price-range"><!--price-range-->
						<!--	<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div>-->
						
					
					
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
                        <div class="output_data">
						<?php
                        $q='select * from mobiles';
                        $ret=mysqli_query($mysqli,$q);
                        while($row=mysqli_fetch_assoc($ret)){
                        echo '<div class="col-sm-4 col-xs-6 col-lg-4">
							     <div class="product-image-wrapper">
								    <div class="single-products">
										<div class="productinfo text-center">';
                            $data=$row['image'];
                            echo "<a class=\"thumbnail\" href=\"product-details.php?id=".$row['mobile_hash']."\" ><div class=\"view-product\"><img src=\"".$data."\" alt=\"Image Not Available\"/></div></a>";
                            
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
                                echo '</div></div>';
                                echo '<div class="choose">
									<ul class="nav nav-pills nav-justified">
                            
										<li><a class="wisher wish'.$row['mobile_hash'].'" href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
								</ul>
								</div></div></div>';
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