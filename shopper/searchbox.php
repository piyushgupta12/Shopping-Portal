<?php
require 'connect.php';
?>
<?php
                        $item=$_POST['item'];
                        $item=str_val($item,$mysqli);
                        $q='select * from mobiles where mobile like "'.$item.'%"';
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
								</div></div></div>';                        }
                        
                        ?>
