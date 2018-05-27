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
<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>
<body>
<?php
include 'header1.php';
?>
<div class="header-bottom"></div>
<section>
<div class="container-fluid">
    <div class="row"> <div class="col-lg-12 text-center"><h2>STATISTICS</h2></div></div>
<div class="row">
    <div class="col-sm-2 col-sm-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    $q="select * from register";
                                    $ret=mysqli_query($mysqli,$q);
                                    echo mysqli_num_rows($ret);                                        
                                    ?>
                                    </div>
                                    <div>Users Registered</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    <div class="col-sm-3 col-sm-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    $q1="select sum(sold) from mobiles";
                                    $ret1=mysqli_query($mysqli,$q1);
                                    $row1=mysqli_fetch_assoc($ret1);                                        
                                    echo $row1['sum(sold)'];
                                        ?>
                                    </div>
                                    <div>Mobile Units Sold</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    <div class="col-sm-2 col-sm-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    $q="select * from mobiles";
                                    $ret=mysqli_query($mysqli,$q);
                                    echo mysqli_num_rows($ret);                                        
                                    ?>
                                    </div>
                                    <div>Variety Of Mobiles </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    
    
    </div>    
    <div class="row">
    <div class="col-sm-2 col-sm-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    $q="select * from company";
                                    $ret=mysqli_query($mysqli,$q);
                                    echo mysqli_num_rows($ret);                                        
                                    ?>
                                    </div>
                                    <div>Total Companies</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    <div class="col-sm-3 col-sm-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    $q="select * from mobiles order by hits desc";
                                    $ret=mysqli_query($mysqli,$q);
                                    $row=mysqli_fetch_assoc($ret);
                                    echo strtoupper($row['mobile']);
                                    ?>
                                    </div>
                                    <div>Most Popular Mobile</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    <div class="col-sm-2 col-sm-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                    <?php
                                    $q="select company,sum(hits) from mobiles group by company order by sum(hits) desc";
                                    $ret=mysqli_query($mysqli,$q);
                                    $row=mysqli_fetch_assoc($ret);
                                    echo strtoupper($row['company']);
                                    
                                    ?>
                                    </div>
                                    <div>Most Popular Company</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
    
    
    </div>    
    <div class="row">
    <div class="col-sm-4 col-sm-offset-1">
    <div class="table-responsive">
    <h3>MOBILES SOLD</h3>
    <table class="table table-striped">
        <thead>
        <tr>
        <th>Company</th>
        <th>Total Units Sold</th>
        <th>Total Hits</th>
        </tr>
        </thead><tbody>
        <?php
        $q="select company,sum(sold),sum(hits) from mobiles group by company order by sum(sold) desc";
                    $ret=mysqli_query($mysqli,$q);
                    while($row=mysqli_fetch_assoc($ret)){
                    echo "<tr>";
                        echo "<td>".$row['company']."</td>";
                        echo "<td>".$row['sum(sold)']."</td>";
                        echo "<td>".$row['sum(hits)']."</td>";
                    echo "</tr>";
                    }
                        
        
        ?>
        
        </tbody>
    </table>    
        
    </div>    
        
    </div>
    <div class="col-sm-4 col-sm-offset-1">
    <div class="table-responsive">
    <h3>MOST POPLUAR MOBILES</h3>
    <table class="table table-striped">
        <thead>
        <tr>
        <th>Company</th>
        <th>Mobile</th>
        <th>Hits</th>
        </tr>
        </thead><tbody>
        <?php
        $q="select company,mobile,sum(hits) from mobiles order by sum(hits) desc";
                    $ret=mysqli_query($mysqli,$q);
                    while($row=mysqli_fetch_assoc($ret)){
                    echo "<tr>";
                        echo "<td>".$row['company']."</td>";
                        echo "<td>".$row['mobile']."</td>";
                        echo "<td>".$row['sum(hits)']."</td>";
                    echo "</tr>";
                    }
                        
        
        ?>
        
        </tbody>
    </table>    
        
    </div>    
        
    </div>
    
    </div>
    
</div>    
    
</section>	


    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>