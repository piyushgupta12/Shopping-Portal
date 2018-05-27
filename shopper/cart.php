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
				  <li class="active">Shopping Cart</li>
				</ol>
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
							echo "<td class=\"cart_price\"><p>".$row1['price']."</p></td>"; ?>
                        <td class="cart_quantity">			
                        <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $row['quantity']; ?>" autocomplete="off" size="2">
                            <span class="save"><a>save</a></span>
								</div>
							</td>
                <?php
                echo "<td class=\"cart_total\">".$row1['price']*$row['quantity']."</td>";
					?>		
                <td class="cart_delete">
								<span class="cart_quantity_delete"><i class="fa fa-times"></i></span>
							</td>
						</tr>
<?php } ?>
					</tbody>
				</table>
			</div>
<button type="submit" class="btn btn-default pull-right" onclick="location.href = 'checkout.php'">Checkout</button>		
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
</body>

<script>
$(document).ready(function(){
    
    $(".cart_quantity_delete").click(function(){
        var id=$(this).parent().parent().find('.cid').val();
        console.log("id="+id);
        $.post('item_delete.php',{cartid:id},function(data){
                console.log(data);
                if(data=='1')
                {
                    console.log("if case");
                    $("#"+id).remove();          
                }
                else
                {
                    console.log("else case");
                }
                
            });
        
       
    });
    
    $(".save").click(function(){
        var id=$(this).parent().parent().find('.cid').val();
        console.log("id="+id);
        var value=$(this).parent().find('.cart_quantity_input').val();
        console.log("value="+value);
        var price=$(this).parent().parent().children('.cart_price').text();
                    console.log("price="+price);
                   var x=5;
        //pass value to php page with ajax
        $.post('item_change.php',{item:value,cartid:id},function(data){
                console.log(data);
                if(data=='1'){
                    console.log("price if");
                    $("#"+id).children(".cart_total").html(price*value);
                x=1;    
                }else{
                    $("#"+id).children(".cart_total").html(data);
                x=0;
                }
                
            });
        console.log("x="+x);
    });

  $( ".hello" ).click(function() {
        console.log("hello");
         window.location.reload(true);
});
    
    
});
</script>    
</html>