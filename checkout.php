<?php
// core configuration
include_once "config/core.php";

// include classes
include_once "config/database.php";
include_once "objects/product.php";
include_once "objects/category.php";
include_once "objects/user.php";
include_once 'objects/cart_item.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);
$category = new Category($db);
$user = new User($db);
$cart_item = new CartItem($db);

// set page title
$page_title="Checkout";

// include page header HTML
include_once 'layout_head.php';

echo "<div class='col-md-12'>";

	$stmt = $cart_item->readAll_WithoutPaging();

	// count number of rows returned
	$num=$stmt->rowCount();

	if($num>0){

		echo "<h4>Order Summary</h4>";

		//start table
		echo "<table class='table table-hover table-responsive table-bordered' style='margin:0 0 3em 0;'>";

			// our table heading
			echo "<tr>";
				echo "<th class='textAlignLeft'>Product Name</th>";
				echo "<th>Price</th>";
				echo "<th style='width:15em;'>Quantity</th>";
				echo "<th>Sub Total</th>";
			echo "</tr>";

			// initialize total price
			$total_price=0;

			// loop throught the products in the cart
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				extract($row);

				// display products ordered
				echo "<tr>";
					echo "<td>";
						echo "<div class='product-id' style='display:none;'>{$id}</div>";
						echo "<div class='product-name'>{$name}</div>";
					echo "</td>";
					echo "<td>&#36;" . number_format($price, 2, '.', ',') . "</td>";
					echo "<td>";
						echo $quantity;
					echo "</td>";
					echo "<td>&#36;" . number_format($subtotal, 2, '.', ',') . "</td>";
				echo "</tr>";

				$total_price+=$subtotal;
			}
			$subcost = $total_price;
			$total_price *= 1.15;

			// display total cost
			echo "<tr>";
				echo "<td><b>Subtotal</b></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td><b>&#36;" . number_format($subcost, 2, '.', ',') . "</b></td>";
			echo "</tr>";

			echo "<tr>";
				echo "<td><b>Total Cost(GST 15%)</b></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td><b>&#36;" . number_format($total_price, 2, '.', ',') . "</b></td>";
			echo "</tr>";
		echo "</table>";

		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){

			// read user information / details
			$user->id=$_SESSION['user_id'];
			$user->readOne();

			// use the information as billing information
			echo "<h4>Billing Information</h4>";

			// table for billing information
			echo "<table class='table table-hover table-responsive table-bordered' style='margin:0 0 3em 0;'>";
				echo "<tr>";
					echo "<td style='width:50%;'>Name:</td>";
					echo "<td>{$user->username}</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>Address:</td>";
					echo "<td>{$user->address}</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td>Contact Number:</td>";
					echo "<td>{$user->contact_number}</td>";
				echo "</tr>";

			echo "</table>";


			echo "<div class='text-align-center' style='margin:1em 0;'>";

				// button to place order
				echo "<a href='place_order.php' class='btn btn-success'>";
					echo "<span class='glyphicon glyphicon-shopping-cart'></span> Confirm";
				echo "</a>";
			echo "</div>";
		}

		// if the user was not logged in yet, tell him he cannot checkout without logging in
		else{

			echo "<div class='alert alert-danger'>";
				echo "<strong>Please log in to place order.</strong><br />";
				echo "Already have an account? <a href='login.php'>Log In</a><br />";
				echo "Don't have an account yet? <a href='register.php'>Sign Up Now!</a>";
			echo "</div>";
		}
	}

	// tell the user there are no products in the cart
	else{
		echo "<div class='alert alert-danger'>";
			echo "<strong>No products found</strong> in your cart!";
		echo "</div>";
	}

echo "</div>";

// include page footer HTML
include_once 'layout_foot.php';
?>
