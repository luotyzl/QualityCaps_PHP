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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Products <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
					
						<!-- highlight if page title is 'Active Products' -->
						<li <?php echo $page_title=="Active Products" ? "class='active'" : ""; ?>>
							<a href="<?php echo $home_url; ?>admin/read_products.php">Active Products</a>
						</li>
						
						<!-- highlight if page title is 'Inactive Products' -->
						<li <?php echo $page_title=="Inactive Products" ? "class='active'" : ""; ?>>
							<a href="<?php echo $home_url; ?>admin/read_inactive_products.php">Inactive Products</a>
						</li>
						<?php
						// read all categories
						$stmt=$category->readAll_WithoutPaging();
						$num = $stmt->rowCount();

						// loop through retrieved categories
						if($num>0){
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
								
								// higlight if current category name was set and is the same with the category on current loop
								if(isset($category_name) && $category_name==$row['name']){
									echo "<li class='active'><a href='{$home_url}admin/category.php?id={$row['id']}'>{$row['name']}</a></li>";
								}
								
								// show without highlight
								else{
									echo "<li><a href='{$home_url}admin/category.php?id={$row['id']}'>{$row['name']}</a></li>";
								}								
							}
						}
						?>
					</ul>
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
						&nbsp;&nbsp;<?php echo $_SESSION['firstname']; ?> 
						&nbsp;&nbsp;<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<!-- update currently logged in admin user -->
						<li><a href="<?php echo $home_url; ?>admin/update_user.php?id=1">Edit Profile</a></li>
		
					</ul>
				</li>
				<!-- log out user -->
						<li><a href="<?php echo $home_url; ?>logout.php">Logout</a></li>
			</ul>
			
		</div><!--/.nav-collapse -->
		 
	</div>
</div>
<!-- /navbar -->