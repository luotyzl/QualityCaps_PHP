<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		 
		<div class="navbar-header">
			<!-- to enable navigation dropdown when viewed in mobile device -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			
			<div id="logo">
				
                    <img alt="" src="../images/NewLogo.png" onclick="location.href='../index.php'"/>
					<!--<a class="navbar-brand" href="<?php echo $home_url; ?>products">Home</a>-->
			</div>
			
		</div>
		 
		<div class="navbar-collapse collapse">
		
			<ul class="nav navbar-nav">
			
				<!-- highlight if $page_title has 'Products' word. -->
				<li <?php echo strpos($page_title, "Product")!==false ? "class='active dropdown'" : "class='dropdown'"; ?>>
					<a href="<?php echo $home_url; ?>admin/read_products.php">Products</a>
					
				</li>
				<!-- highlight for order related pages -->
				<li <?php echo $page_title=="Orders" 
							|| $page_title=="Order History"
							|| $page_title=="Order Details" ? "class='active'" : ""; ?> >
					<a href="<?php echo $home_url; ?>admin/read_orders.php">Orders</a>
				</li>
				
				<!-- highlight for user related pages -->
				<li <?php 
						echo $page_title=="Users" 
							|| $page_title=="Create User" 
							|| $page_title=="Update User" 
							|| strip_tags($page_title)=="Users / Edit User" 
							|| strip_tags($page_title)=="Users / Create User" 
							? "class='active'" : ""; ?> >
					<a href="<?php echo $home_url; ?>admin/read_users.php">Users</a>
				</li>
				<!-- highlight for Supplier related pages -->
				<li <?php 
						echo $page_title=="Suppliers" 
							|| $page_title=="Create Supplier" 
							|| $page_title=="Update Supplier" 
							|| strip_tags($page_title)=="Suppliers / Edit Supplier" 
							|| strip_tags($page_title)=="Suppliers / Create Supplier" 
							? "class='active'" : ""; ?> >
					<a href="<?php echo $home_url; ?>admin/read_Suppliers.php">Suppliers</a>
				</li>			
				<!-- highlight for Catagories related pages -->
				<li <?php 
						echo $page_title=="Catagories" 
							|| $page_title=="Create Catagory" 
							|| $page_title=="Update Catagory" 
							|| strip_tags($page_title)=="Catagories / Edit Catagory" 
							|| strip_tags($page_title)=="Catagories / Create Catagory" 
							? "class='active'" : ""; ?> >
					<a href="<?php echo $home_url; ?>admin/read_Categories.php">Catagories</a>
				</li>
			</ul>

			<!-- options in the upper right corner of the page -->
			<ul class="nav navbar-nav pull-right">
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						&nbsp;&nbsp;<?php echo $_SESSION['username']; ?> 
						
					</a>
				</li>
				<!-- log out user -->
						<li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
			</ul>
			
		</div><!--/.nav-collapse -->
		 
	</div>
</div>
<!-- /navbar -->