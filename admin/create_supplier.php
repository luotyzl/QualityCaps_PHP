<?php
// core configuration
include_once "../config/core.php";

// initialize classes
include_once '../config/database.php';
include_once '../objects/supplier.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize supplier object
$supplier = new Supplier($db);

// set page title
$page_title = "Create Supplier";

// import page header HTML
include_once "layout_head.php";

// read suppliers button
echo "<div class='right-button-margin'>";
	echo "<a href='read_suppliers.php' class='btn btn-primary pull-right'>";
		echo "<span class='glyphicon glyphicon-list'></span> Read suppliers";
	echo "</a>";
echo "</div>";

// if the form was submitted
if($_POST){
	
	// instantiate supplier object
	include_once '../objects/supplier.php';

	
	$supplier = new Supplier($db);
	
	// set supplier property values
	$supplier->name = $_POST['name'];
	$supplier->phone = $_POST['phone'];
	$supplier->email = $_POST['email'];
	
	// create the catagory
	if($supplier->create()){

		// get last inserted id
		$supplier=$db->lastInsertId();
		
		
		echo "<div class=\"alert alert-success alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Supplier was created.";
		echo "</div>";
	}
	
	// if unable to create the supplier, tell the user
	else{
		echo "<div class=\"alert alert-danger alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Unable to create supplier.";
		echo "</div>";
	}
}
?>
	 
<!-- HTML form for creating a catagory -->
<form action='create_supplier.php' method='post' enctype="multipart/form-data">
 
	<table class='table table-hover table-responsive table-bordered'>
	 
		<tr>
			<td>Name</td>
			<td><input type='text' name='name' class='form-control' required></td>
		</tr>
		<tr>
			<td>Phone</td>
			<td><input type='text' name='phone' class='form-control' required></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input type='text' name='email' class='form-control' required></td>
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