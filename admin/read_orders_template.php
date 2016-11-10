<?php 
	echo "<ul class='nav nav-tabs margin-bottom-1em'>";
		echo $status==0 ? "<li role='presentation' class='active'>" : "<li role='presentation'>";
			echo "<a href='{$home_url}admin/read_orders.php'>Waiting</a>";
		echo "</li>";
		echo $status==1 ? "<li role='presentation' class='active'>" : "<li role='presentation'>";
			echo "<a href='{$home_url}admin/read_orders.php?status=1'>Shipped</a>";
		echo "</li>";
	echo "</ul>";
?>
<?php 
// if number of retrieved records were greater than zero
if($num>0){

	echo "<table class='table table-hover table-responsive table-bordered'>";

		// our table heading
		echo "<tr>";
			echo "<th class='textAlignLeft'>Transaction ID</th>";
			echo "<th>Transaction Date</th>";
			echo "<th>Customer Name</th>";
			echo "<th>Total Cost</th>";
			echo "<th>Status</th>";
			echo "<th>Action</th>";
		echo "</tr>";
		
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
						echo "Waiting";
					}else{
						echo "Shipped";
					}
				echo "</td>";
				echo "<td>";
				
					// view details button
					echo "<a href='read_one_order.php?transaction_id={$transaction_id}' class='btn btn-primary'>";
						echo "<span class='glyphicon glyphicon-list'></span> View Details";
					echo "</a>";
				echo "</td>";
			echo "</tr>";
		}
		
	echo "</table>";
	
	// pagination, identify $page_dom and $total_rows
	// the page where pagination was used
	$page_dom="";
	
	// the number of rows retrieved on that page
	$total_rows=0;
	
	if($page_title=='Order Search Results'){
		$page_dom = "search_orders.php?s={$search_term}&";
		$total_rows = $order->countAll_BySearch($search_term);
	}

	else if($page_title=='Orders'){
		$page_dom = "read_orders.php?status={$status}&";
		$total_rows = $order->countAll();
	}
	
	// actual paging buttons
	include_once 'paging.php';
}

// tell the user no orders found
else{
	echo "<div class='alert alert-danger'>";
		echo "<strong>No orders found</strong>";
	echo "</div>";
}
?>