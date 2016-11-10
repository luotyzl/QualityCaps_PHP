<div class='container row'>

	<!-- create user form -->
	<a href='create_user.php' class="btn btn-primary pull-right margin-bottom-1em">
		<span class="glyphicon glyphicon-plus"></span> Create User
	</a>
</div>
<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";

		// table headers
        echo "<tr>";
			echo "<th>Firstname</th>";
            echo "<th>Email</th>";
            echo "<th>Contact Number</th>";
            echo "<th>Access Level</th>";
			echo "<th>IsAvailable</th>";
			echo "<th>Actions</th>";
        echo "</tr>";
 
		// loop through the user records
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			extract($row);
 
			// display user details
            echo "<tr>";
				echo "<td>{$firstname}</td>";
                echo "<td>{$email}</td>";
				echo "<td>{$contact_number}</td>";
				echo "<td>{$access_level}</td>";
				echo "<td>";
					if($status==0){
						echo "No";
					}else{
						echo "Yes";
					}
				echo "</td>";
                echo "<td>";
                    
					// edit button
					echo "<a href='update_user.php?id={$id}' class='btn btn-info' style='margin:0 1em 0 0;'>";
						echo "<span class='glyphicon glyphicon-edit'></span> Edit";
					echo "</a>";
					
					// delete button, user with id # 1 cannot be deleted because it is the first admin

                echo "</td>";
            echo "</tr>";
        }
 
    echo "</table>";

	// the number of rows retrieved on that page
	$total_rows=0;
	
	// user search results
	if(isset($search_term) && $page_url=="search_users.php?s={$search_term}&"){
		$total_rows = $user->countAll_BySearch($search_term);
	}

	// all users
	else if($page_url=="read_users.php?"){
		$total_rows = $user->countAll();
	}
	
	// actual paging buttons
	include_once 'paging.php';
}
 
// tell the user there are no selfies
else{
    echo "<div class=\"alert alert-danger\" role=\"alert\">";
		echo "<strong>No users found.</strong>";
	echo "</div>";
}
?>