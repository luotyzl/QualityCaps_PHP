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
	echo "<a href='read_products.php' class='btn btn-primary pull-right'>";
		echo "<span class='glyphicon glyphicon-list'></span> Read Products";
	echo "</a>";
echo "</div>";

// if the form was submitted
if($_POST){
	
	// instantiate category object
	include_once '../objects/category.php';

	
	$catagory = new Catagory($db);
	
	// set category property values
	$catagory->name = $_POST['name'];
	$catagory->description = $_POST['description'];
	
	// create the catagory
	if($catagory->create()){

		// get last inserted id
		$catagory=$db->lastInsertId();
		
		
		echo "<div class=\"alert alert-success alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Product was created.";
		echo "</div>";
	}
	
	// if unable to create the product, tell the user
	else{
		echo "<div class=\"alert alert-danger alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Unable to create product.";
		echo "</div>";
	}
}
?>
	 
<!-- HTML form for creating a product -->
<form action='create_product.php' method='post' enctype="multipart/form-data">
 
	<table class='table table-hover table-responsive table-bordered'>
	 
		<tr>
			<td>Name</td>
			<td><input type='text' name='name' class='form-control' required></td>
		</tr>
		 
	 
		<tr>
			<td>Description</td>
			<td><textarea name='description' class='form-control'></textarea></td>
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