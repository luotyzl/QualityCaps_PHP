<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
include_once "login_checker.php";

// include classes
include_once '../config/database.php';
include_once '../objects/order.php';
include_once '../objects/order_item.php';
include_once "../objects/category.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$order = new Order($db);
$order_item = new OrderItem($db);
$category = new Category($db);

// set page title
$page_title = "Order Details";

// include page header HTML
include_once "layout_head.php";

// read order details based on given id
$transaction_id=isset($_GET['transaction_id']) ? $_GET['transaction_id'] : "";
$order->transaction_id=$transaction_id;
$order->readOneByTransactionId();

// check if record exists
if($order->created){

	// read order details
	?>

	<div class='right-button-margin' style='overflow:hidden;'>
		<a href='read_orders.php' class='btn btn-primary pull-right'>
			<span class='glyphicon glyphicon-list'></span>  Back to Orders
		</a>
	</div>

	<h4>Order Summary</h4>

	<table class='table table-hover table-responsive table-bordered'>

		<tr>
			<td>Transaction ID</td>
			<td><?php echo $transaction_id; ?></td>
		</tr>
		<tr>
			<td>Transaction Date</td>
			<td><?php echo $order->created; ?></td>
		</tr>
		<tr>
			<td>Customer Name</td>
			<td><?php echo $order->firstname . " " . $order->lastname; ?></td>
		</tr>
		<tr>
			<td>Total Cost</td>
			<td>&#36;<?php echo number_format($order->total_cost, 2, '.', ','); ?></td>
		</tr>
		<tr>
			<td>Status <?php echo $order->status; ?></td>
			<td>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-default <?php echo $order->status==0 ? 'active' : ''; ?>">
						<input type="radio" name="status" value="0" 
							transaction-id="<?php echo $transaction_id; ?>" <?php echo $order->status==0 ? 'checked' : ''; ?>> Pending
					</label>
					
					<label class="btn btn-default <?php echo $order->status==1 ? 'active' : ''; ?>">
						<input type="radio" name="status" value="1" 
							transaction-id="<?php echo $transaction_id; ?>" <?php echo $order->status==1 ? 'checked' : ''; ?>> Completed
					</label>
					
				</div>
			</td>
		</tr>
	</table>
		
	<h4>Order Items</h4>
	<?php

	// retrieve order items
	$order_item->transaction_id=$transaction_id;
	$stmt=$order_item->readAll();

	echo "<table class='table table-hover table-responsive table-bordered'>";

		// our table heading
		echo "<tr>";
			echo "<td class='textAlignLeft'>Product Name</td>";
			echo "<td>Price (USD)</td>";
			echo "<td>Quantity</td>";
			echo "<td>Subtotal</td>";
		echo "</tr>";
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			//creating new table row per record
			echo "<tr>";
				echo "<td>{$product_name}</td>";
				echo "<td>&#36;" . number_format($price, 2, '.', ',') . "</td>";
				echo "<td>{$quantity}</td>";
				echo "<td>";
					echo "&#36;" . number_format($price*$quantity, 2, '.', ',');
				echo "</td>";
			echo "</tr>";
			
		}
		
		// order total cost
		echo "<tr>";
			echo "<td><b>Total Cost</b></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td>&#36;" . number_format($order->total_cost, 2, '.', ',') . "</td>";
		echo "</tr>";
		
	echo "</table>";

}

// tell the user that the order does not exist
else{
	echo "<div class='alert alert-danger'>";
		echo "<strong>Order does not exist.</strong>";
	echo "</div>";
}

// include page footer HTML
include_once "layout_foot.php";
?>