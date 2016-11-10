<?php
// core configuration
include_once "../config/core.php";

// initialize classes
include_once '../config/database.php';
include_once '../objects/category.php';
include_once '../objects/supplier.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize category and supplier object
$category = new Category($db);
$supplier = new Supplier($db);
// set page title
$page_title = "Create Product";

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
	
	// instantiate product object
	include_once '../objects/product.php';
	include_once '../objects/product_image.php';
	include_once '../objects/product_pdf.php';
	
	$product = new Product($db);
	$productImage = new ProductImage($db);
	$productPdf = new ProductPdf($db);

	// set product property values
	$product->name = $_POST['name'];
	$product->price = $_POST['price'];
	$product->category_id = $_POST['category_id'];
	$product->supplier_id = $_POST['supplier_id'];
	
	// create the product
	if($product->create()){

		// get last inserted id
		$product_id=$db->lastInsertId();
		
		// save the images
		$productImage->product_id = $product_id;
		$productImage->upload();
		
		
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
			<td>Price</td>
			<td><input type='text' name='price' class='form-control' required></td>
		</tr>
		 		 
		<tr>
			<td>Category</td>
			<td>
			<?php
			// read the categories from the database
			$stmt = $category->readAll_WithoutPaging();
			
			// put them in a select drop-down
			echo "<select class='form-control' name='category_id'>";
				echo "<option>Select category...</option>";
				
				// loop through the caregories
				while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row_category);
					echo "<option value='{$id}'>{$name}</option>";
				}
				
			echo "</select>";
			?>
			</td>
		</tr>
		 <tr>
			<td>Supplier</td>
			<td>
			<?php
			// read the categories from the database
			$stmt = $supplier->readAll_WithoutPaging();
			
			// put them in a select drop-down
			echo "<select class='form-control' name='supplier_id'>";
				echo "<option>Select supplier...</option>";
				
				// loop through the caregories
				while ($row_supplier = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row_supplier);
					echo "<option value='{$id}'>{$name}</option>";
				}
				
			echo "</select>";
			?>
			</td>
		</tr>
		
		<tr>
			<td>Image(s):</td>
			<td>
				<!-- browse multiple image files -->
				<input type="file" name="files[]" class='form-control' multiple>
			</td>
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