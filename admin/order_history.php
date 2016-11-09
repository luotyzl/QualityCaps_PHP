<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
include_once "login_checker.php";

// include classes
include_once '../config/database.php';
include_once '../objects/user.php';
include_once "../objects/category.php";
include_once "../objects/order.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$user = new User($db);
$category = new Category($db);
$order = new Order($db);

// set page title
$page_title = "Order History";

// include page header HTML
include_once "layout_head.php";
?>

<?php

// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 5; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

// set user id to view order history
$order->user_id=isset($_GET['id']) ? $_GET['id'] : "";

// read orders by user
$stmt=$order->readAll_ByUser($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// if user has orders
if($num>0){

	echo "<table class='table table-hover table-responsive table-bordered'>";

		// table heading
		echo "<tr>";
			echo "<th class='textAlignLeft'>Transaction ID</th>";
			echo "<th>Transaction Date</th>";
			echo "<th>Customer Name</th>";
			echo "<th>Total Cost</th>";
			echo "<th>Status</th>";
			echo "<th>Action</th>";
		echo "</tr>";
		
		// loop through the orders
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			//creating new table row per record
			echo "<tr>";
				echo "<td>{$transaction_id}</td>";
				echo "<td>{$created}</td>";
				echo "<td>{$firstname} {$lastname}</td>";
				echo "<td>&#36;" . number_format($total_cost, 2, '.', ',') . "</td>";
				echo "<td>";
					if($status==0){
						echo "Pending";
					}else{
						echo "Completed";
					}
				echo "</td>";
				echo "<td>";
				
					// view order details button
					echo "<a href='read_one_order.php?transaction_id={$transaction_id}' class='btn btn-primary'>";
						echo "<span class='glyphicon glyphicon-list'></span> View Details";
					echo "</a>";
					
				echo "</td>";
			echo "</tr>";
		}
		
	echo "</table>";
	
}

// tell the user if no orders found
else{
	echo "<div class='alert alert-danger'>";
		echo "<strong>No orders found</strong>";
	echo "</div>";
}

// include page footer HTML
include_once "layout_foot.php";
?>