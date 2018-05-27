<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 94 44 44 44</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@bombings.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="404.php"><i class="fa fa-facebook"></i></a></li>
								<li><a href="404.php"><i class="fa fa-twitter"></i></a></li>
								<li><a href="404.php"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="404.php"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="404.php"><i class="fa fa-google-plus"></i></a></li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top--> 
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-10">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="stats.php"><i class="fa fa-user"></i>Statistics</a></li>
								<?php 
if(!isset($_SESSION['id']))
                          echo  '  <li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>';
else								
echo '<li><a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>'; ?>
								
                                <li><a class="hello" ><i class="fa fa-refresh fa-spin"></i>Refresh</a></li>
                                <li><a href="portal.php"><i class="fa fa-refresh fa-spin"></i>Portal</a></li>
								<li><a href="pass_change1.php"><i class="fa fa-key fa-fw"></i>Change Password</a></li>
                                
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
	<!--	

    <div class="header-bottom">
			<div class="container">
				<div class="row">
					
					<div class="col-sm-3">
						<div class="search_box pull-right ">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header>