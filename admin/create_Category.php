<?php
// core configuration
include_once "../config/core.php";

// initialize classes
include_once '../config/database.php';
include_once '../objects/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize category object
$category = new Category($db);

// set page title
$page_title = "Create Category";

// import page header HTML
include_once "layout_head.php";

// read products button
echo "<div class='right-button-margin'>";
	echo "<a href='read_categories.php' class='btn btn-primary pull-right'>";
		echo "<span class='glyphicon glyphicon-list'></span> Read catagories";
	echo "</a>";
echo "</div>";

// if the form was submitted
if($_POST){
	
	// instantiate category object
	include_once '../objects/category.php';

	
	$category = new Category($db);
	
	// set category property values
	$category->name = $_POST['name'];
	
	// create the catagory
	if($category->create()){

		// get last inserted id
		$catagory=$db->lastInsertId();
		
		
		echo "<div class=\"alert alert-success alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Catagory was created.";
		echo "</div>";
	}
	
	// if unable to create the catagory, tell the user
	else{
		echo "<div class=\"alert alert-danger alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Unable to create category.";
		echo "</div>";
	}
}
?>
	 
<!-- HTML form for creating a catagory -->
<form action='create_category.php' method='post' enctype="multipart/form-data">
 
	<table class='table table-hover table-responsive table-bordered'>
	 
		<tr>
			<td>Name</td>
			<td><input type='text' name='name' class='form-control' required></td>
		</tr>
		
		<tr>
			<td></td>
			<td>
				<button type="submit" class="btn btn-primary">
					<span class='glyphicon glyphicon-plus'></span> Create
				</button>
			</td>
		</tr>
		 
	</table>
</form>
		
<?php
// include page footer HTML
include_once "layout_foot.php";
?>