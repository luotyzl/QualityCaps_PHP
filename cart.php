<?php
// connect to database
include_once 'config/database.php';
include_once 'config/core.php';

// classes
include_once "libs/php/utils.php";
include_once 'objects/product.php';
include_once 'objects/category.php';
include_once 'objects/cart_item.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize utility class
$utils = new Utils();

// initialize objects
$product = new Product($db);
$category = new Category($db);

$cart_item = new CartItem($db);

// page headers
$page_title="Cart";

include_once 'layout_head.php';

echo "<div class='col-md-12'>";

// parameters
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";

// display a message
if($action=='removed'){
	echo "<div class='alert alert-info'>";
		echo "<strong>{$name}</strong> was removed from your cart!";
	echo "</div>";
}

else if($action=='quantity_updated'){
	echo "<div class='alert alert-info'>";
		echo "<strong>{$name}</strong> quantity was updated!";
	echo "</div>";
}

else if($action=='failed'){
    echo "<div class='alert alert-info'>";
		echo "<strong>{$name}</strong> quantity failed to updated!";
	echo "</div>";
}

else if($action=='invalid_value'){
    echo "<div class='alert alert-info'>";
		echo "<strong>{$name}</strong> quantity is invalid!";
	echo "</div>";
}

else if($action=='empty_success'){
    echo "<div class='alert alert-info'>";
		echo "<strong>Cart was emptied!</strong>";
	echo "</div>";
}

else if($action=='empty_failed'){
    echo "<div class='alert alert-info'>";
		echo "<strong>Unable to empty cart.</strong>";
	echo "</div>";
}

$stmt = $cart_item->readAll_WithoutPaging();

// count number of rows returned
$num=$stmt->rowCount();

if($num>0){

	// remove all cart contents
	echo "<div class='right-button-margin' style='overflow:hidden;'>";
		echo "<a href='{$home_url}empty_cart.php' class='btn btn-default pull-right'>Empty Cart</a>";
	echo "</div>";

    //start table
    echo "<table class='table table-hover table-responsive table-bordered' style='margin:1em 0 0 0;'>";

    // our table heading
    echo "<tr>";
        echo "<th class='textAlignLeft'>Product Name</th>";
        echo "<th>Price (USD)</th>";
            echo "<th style='width:15em;'>Quantity</th>";
            echo "<th>Sub Total</th>";
            echo "<th>Action</th>";
    echo "</tr>";

    $total=0;

    while( $row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

		echo "<tr>";
			echo "<td>";
				echo "<div class='product-id' style='display:none;'>{$id}</div>";
				echo "<div class='product-name'>{$name}</div>";
			echo "</td>";
			echo "<td>&#36;" . number_format($price, 2, '.', ',') . "</td>";
			echo "<td>";
				echo "<form class='update-quantity-form'>";
				echo "<div class='input-group'>";
					echo "<input type='number' name='quantity' value='{$quantity}' class='form-control' min='1'>";
						echo "<span class='input-group-btn'>";
							echo "<button class='btn btn-default update-quantity' type='submit'>Update</button>";
						echo "</span>";
				echo "</div>";
				echo "</form>";
			echo "</td>";
			echo "<td>&#36;" . number_format($subtotal, 2, '.', ',') . "</td>";
			echo "<td>";
			echo "<a href='remove_from_cart.php?id={$id}&name={$name}' class='btn btn-danger'>";
				echo "<span class='glyphicon glyphicon-remove'></span> Remove from cart";
			echo "</a>";
			echo "</td>";
		echo "</tr>";

		$total += $subtotal;
    }

    echo "<tr>";
	echo "<td><b>Total</b></td>";
	echo "<td></td>";
	echo "<td></td>";
	echo "<td>&#36;" . number_format($total, 2, '.', ',') . "</td>";
	echo "<td>";
            echo "<a href='{$home_url}checkout' class='btn btn-success'>";
            echo "<span class='glyphicon glyphicon-shopping-cart'></span> Checkout";
            echo "</a>";
	echo "</td>";
    echo "</tr>";

    echo "</table>";
}else{
    echo "<div class='alert alert-danger'>";
    	echo "<strong>No products found</strong> in your cart!";
    echo "</div>";
}

// end <div class='col-md-12'>
echo "</div>";

include 'layout_foot.php';
?>
