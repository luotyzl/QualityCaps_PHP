<div class='container row'>

	<!-- create user form -->
	<a href='create_Category.php' class="btn btn-primary pull-right margin-bottom-1em">
		<span class="glyphicon glyphicon-plus"></span> Create Category
	</a>
</div>
<?php 

// if number of retrieved records were greater than zero
if($num>0){

	echo "<table class='table table-hover table-responsive table-bordered'>";

		// our table heading
		echo "<tr>";

			echo "<th>Name</th>";
			echo "<th>Actions</th>";
		echo "</tr>";
		
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			
			//creating new table row per record
			echo "<tr>";
				
				echo "<td>{$name}</td>";
				echo "<td>";
				if($id!=1){
						echo "<a delete-id='{$id}' delete-file='delete_category.php' class='btn btn-danger delete-object margin-left-1em'>";
							echo "<span class='glyphicon glyphicon-remove'></span> Delete";
						echo "</a>";
						
					}
					echo "</td>";
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
		echo "<strong>No categories</strong>";
	echo "</div>";
}
?>