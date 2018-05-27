<?php
require 'connect.php';
?>
<?php
if(!isset($_SESSION['id'])||!isset($_SESSION['type'])){
header('Location:login.php');
}else if($_SESSION['type']=='admin'){
header('Location:portal.php');
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
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->



			
			<div class="shopper-informations">
				<div class="row">
                    <?php 
				$q="select * from address where email='".$_SESSION['id']."'";
                $ret=mysqli_query($mysqli,$q);
                if(mysqli_num_rows($ret)==0){
                    header('Location:account.php');
                }
                echo '<form name="login" action="new.php" method="post">';
                while($row=mysqli_fetch_assoc($ret)){
                echo '<div class="col-sm-4 check"> <div class="'.$row['addressid'].'" >';
                echo '<p><strong>Street Address: '.$row['street'].'<p>';
                echo '<p><strong>City:</strong> '.$row['city'].'<p>';
                echo '<p><strong>State:</strong> '.$row['state'].'<p>';
                echo '<p><strong>Pin:</strong> '.$row['pin'].'<p>';
                echo '<input class="tick" type="radio" name="add" value="'.$row['addressid'].'">';

                    echo '</div></div>';
                }
?>
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table ">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
$q="select * from cart where email='".$_SESSION['id']."'";
$ret=mysqli_query($mysqli,$q);    
while($row=mysqli_fetch_assoc($ret)){
   $q1="select * from mobiles where mobile_hash='".$row['mobile_hash']."'";
    $ret1=mysqli_query($mysqli,$q1);
    $row1=mysqli_fetch_assoc($ret1);
    echo "    <tr id=\"".$row['cartid']."\">";
                            echo "<td class=\"cart_product\"><div class=\"view-product\"><img src=\"".$row1['image']."\" alt=\"Image Not Available\"></div></td>";
                            echo "<td class=\"cart_description\"><h4>".$row1['mobile']."</h4><p>Web ID: ".$row1['mobile_hash']."</p><input type=\"hidden\" class=\"cid\" value=\"".$row['cartid']."\" ></td>";
							echo "<td class=\"cart_price\"><p>Rs".$row1['price']."</p></td>"; ?>
                        <td class="cart_quantity">			
                            <p class="cart_quantity_input"><?php echo $row['quantity']; ?></p>
								</div>
							</td>
                <?php
                echo "<td class=\"cart_total\">".$row1['price']*$row['quantity']."</td>";
					?>		
                
                </tr></br>
<?php } ?>
					</tbody>
				</table>
			</div>
		<input type="submit" class="btn btn-default pull-right" value="Generate Invoice">	
		
</div>
	</section> <!--/#cart_items-->

	

<?php
    include 'footer.php';
    ?>
	


    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
<script>

/*
    $(document).ready(function(){
  $(".check input:radio").click(function() {
    var ad=$(this).val();   
    $.post('address.php',{ad:ad},function(data){
    
            });
    //  console.log($(this).val());
      
   });
});
*/
</script>
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