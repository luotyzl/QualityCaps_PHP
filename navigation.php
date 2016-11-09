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

			<!-- logo -->
			<div id="logo">
				
                    <img alt="" src="./images/NewLogo.png" onclick="location.href='index.php'"/>
					<!--<a class="navbar-brand" href="<?php echo $home_url; ?>products">Home</a>-->
			</div>
			
		</div>

              <!--catagories-->
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				
				<!-- highlight if $page_title has 'Products' word. -->
				<li <?php echo strpos($page_title, "Product")!==false ? "class='active dropdown'" : "class='dropdown'"; ?>>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Products <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">

						<!--
							highlight if $page_title has 'Products' word AND
							category name wasn't set, because it is 'all products' page.
						-->
						<li <?php echo strpos($page_title, 'Product')!==false && !isset($category_name) ? "class='active'" : ""; ?>>
							<a href="<?php echo $home_url; ?>products">All Products</a>
						</li>

						<?php
						// read all product categories
						$stmt=$category->readAll_WithoutPaging();
						$num = $stmt->rowCount();

						if($num>0){
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

								// highlight if the currenct $category_name is the same as the current category name in the loop
								if(isset($category_name) && $category_name==$row['name']){
									echo "<li class='active'><a href='{$home_url}category.php?id={$row['id']}'>{$row['name']}</a></li>";
								}

								// no highlight
								else{
									echo "<li><a href='{$home_url}category.php?id={$row['id']}'>{$row['name']}</a></li>";
								}
							}
						}
						?>
					</ul>
				</li>
				<li <?php echo $page_title=="contactUs" ? "class='active'" : ""; ?> >
					<a href="<?php echo $home_url; ?>contactUs">
						contactUs
					</a>
				</li>
				
			</ul>
			<ul class="nav navbar-nav pull-right">
			<!-- link to the "Cart" page, highlight if current page is cart.php -->
				<li <?php echo $page_title=="Cart" ? "class='active'" : ""; ?> >
					<a href="<?php echo $home_url; ?>cart">
						<?php
						// return count, session user_id was set in core.php
						$cart_item->user_id=$_SESSION['user_id'];
						$cart_count=$cart_item->countAll();
						?>
						Cart <span class="badge" id="comparison-count"><?php echo $cart_count; ?></span>
					</a>
				</li>
			<?php
			// check if users / customer was logged in
			// if user was logged in, show "Edit Profile", "Orders" and "Logout" options
			if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true ){
			?>
				<li <?php echo $page_title=="Edit Profile" || $page_title=="Orders" || $page_title=="Order Details" ? "class='active'" : ""; ?>>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						&nbsp;&nbsp;<?php echo $_SESSION['firstname']; ?>
						&nbsp;&nbsp;<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li <?php echo $page_title=="Orders" || $page_title=="Order Details" ? "class='active'" : ""; ?>>
							<a href="<?php echo $home_url; ?>orders.php">MyOrders</a>
						</li>
						<?php
						if( $_SESSION['access_level']=="Admin"){
							?>
							<li <?php echo $page_title=="Admin" || $page_title=="Admin" ? "class='active'" : ""; ?>>
							<a href="<?php echo $home_url; ?>admin/read_products.php?action=logged_in_as_admin">Admin</a>
						</li>
							<?php
						}
						?>					
					</ul>
				</li>
				<li>
					<a href="<?php echo $home_url; ?>logout.php">
					<span class="glyphicon glyphicon-log-out"></span> Log out</a>
				</li>
			<?php
			}
			// if user was not logged in, show the "login" and "sign up" options
			else{
			?>
			<!--<ul class="nav navbar-nav pull-right">-->
				<li <?php echo $page_title=="Register" ? "class='active'" : ""; ?>>
					<a href="<?php echo $home_url; ?>register">
						<span class="glyphicon glyphicon-check"></span> Register
					</a>
				</li>

				<li <?php echo $page_title=="Login" ? "class='active'" : ""; ?>>
					<a href="<?php echo $home_url; ?>login">
						<span class="glyphicon glyphicon-log-in"></span> Log In
					</a>
				</li>
			<?php
			}
			?>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
<!-- /navbar -->
