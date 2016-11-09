<?php 

// if number of retrieved records were greater than zero
if($num>0){

	echo "<table class='table table-hover table-responsive table-bordered'>";

		// our table heading
		echo "<tr>";
			echo "<th class='textAlignLeft'>Category ID</th>";
			echo "<th>Category Name</th>";
		echo "</tr>";
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			//creating new table row per record
			echo "<tr>";
				echo "<td>{$id}</td>";
				echo "<td>{$name}</td>";
			echo "</tr>";
		}
		
	echo "</table>";
	
	// pagination, identify $page_dom and $total_rows
	// the page where pagination was used
	$page_dom="";
	
	// the number of rows retrieved on that page
	$total_rows=0;

	
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