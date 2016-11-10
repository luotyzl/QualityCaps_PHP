<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
include_once "login_checker.php";

// get ID of the product to be edited
$product_id = isset($_GET['id']) ? $_GET['id'] : die('Missing product ID.');

// include classes
include_once '../config/database.php';
include_once '../objects/product.php';
include_once '../objects/product_image.php';
include_once "../objects/category.php";
include_once "../objects/supplier.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);
$category = new Category($db);
$supplier = new Supplier($db);

// set page title
$page_title = "Update Product";

// include page header HTML
include_once "layout_head.php";

// read products button
echo "<div class='right-button-margin'>";
	echo "<a href='read_products.php' class='btn btn-primary pull-right'>";
		echo "<span class='glyphicon glyphicon-list'></span> Read Products";
	echo "</a>";
echo "</div>";

// set ID property of product to be edited
$product->id = $product_id;

// read the details of product to be edited
$product->readOne();

// if the form was submitted
if($_POST){

	// set product property values
	$product->name = $_POST['name'];
	$product->price = $_POST['price'];
	$product->category_id = $_POST['category_id'];
	$product->supplier_id = $_POST['supplier_id'];

	
	// update the product
	if($product->update()){
	
		// save the images
		$product_image->product_id = $product_id;
		$product_image->upload();
		
		
		echo "<div class=\"alert alert-success alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Product was updated.";
		echo "</div>";
	}
	
	// if unable to update the product, tell the user
	else{
		echo "<div class=\"alert alert-danger alert-dismissable\">";
			echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
			echo "Unable to update product.";
		echo "</div>";
	}
}
?>
	
<!-- HTML form for updating a product -->
<form action='update_product.php?id=<?php echo $product_id; ?>' method='post' enctype="multipart/form-data">
 
	<table class='table table-hover table-responsive table-bordered'>
	 
		<tr>
			<td>Name</td>
			<td><input type='text' name='name' value="<?php echo htmlentities($product->name); ?>" class='form-control' required></td>
		</tr>
		 
		<tr>
			<td>Price</td>
			<td><input type='text' name='price' value="<?php echo htmlentities($product->price); ?>" class='form-control' required></td>
		</tr>
		 
		<tr>
			<td>Category</td>
			<td>
				<?php
				// read the product categories from the database
				include_once '../objects/category.php';

				$category = new Category($db);
				$stmt = $category->readAll_WithoutPaging();
				
				// put them in a select drop-down
				echo "<select class='form-control' name='category_id'>";
				
					echo "<option>Please select...</option>";
					while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row_category);
						
						// current category of the product must be selected
						if($product->category_id==$id){
							echo "<option value='$id' selected>";
						}else{
							echo "<option value='$id'>";
						}
						
						echo "$name</option>";
					}
				echo "</select>";
				?>
			</td>
		</tr>
		<tr>
			<td>Supplier</td>
			<td>
				<?php
				// read the product suppliers from the database
				include_once '../objects/supplier.php';

				$supplier = new Supplier($db);
				$stmt = $supplier->readAll_WithoutPaging();
				
				// put them in a select drop-down
				echo "<select class='form-control' name='supplier_id'>";
				
					echo "<option>Please select...</option>";
					while ($row_supplier = $stmt->fetch(PDO::FETCH_ASSOC)){
						extract($row_supplier);
						
						// current supplier of the product must be selected
						if($product->supplier_id==$id){
							echo "<option value='$id' selected>";
						}else{
							echo "<option value='$id'>";
						}
						
						echo "$name</option>";
					}
				echo "</select>";
				?>
			</td>
		</tr>
		
		<tr>
			<td>Image(s):</td>
			<td>
				<?php
				// set product id
				$product_image->product_id=$product_id;
				
				// read all images under the product id
				$stmt_product_image = $product_image->readAll();
				
				// count number of images under a product id
				$num_product_image = $stmt_product_image->rowCount();

				// if retrieved images greater was than 0
				if($num_product_image>0){
					
					// loop through the retrieved product images
					while ($row = $stmt_product_image->fetch(PDO::FETCH_ASSOC)){
						
						// product image id and name
						$product_image_id = $row['id'];
						$product_image_name = $row['name'];
						
						// image source
						$image_source="{$home_url}uploads/images/{$product_image_name}";
						
						// display the image(s)
						echo "<a href='{$image_source}' target='_blank'>";
							echo "<div class='thumb-image' style='background: url({$image_source}) 50% 50% no-repeat; '>";
								echo "<span class='delete-image delete-object' delete-id='{$product_image_id}' delete-file='delete_image.php'>";
									echo "<img src='{$home_url}images/delete.png' title='Delete image?' />";
								echo "</span>";
							echo "</div>";
						echo "</a>";
					}
				}
				
				// fake / customized button to browse image to upload
				echo "<div class='thumb-wrapper new-btn' title='Add Pictures'>";
					echo "<img src='{$home_url}images/add.png' />";
				echo "</div>";

				?>
				<!-- real field to browse image to upload -->
				<input type="file" name="files[]" id="html-btn" class='form-control' multiple>
			</td>
		</tr>
				
		<tr>
			<td></td>
			<td>
				<button type="submit" class="btn btn-primary">
					<span class='glyphicon glyphicon-edit'></span> Update
				</button>
			</td>
		</tr>
		 
	</table>
</form>
             
<?php
// include page footer HTML
include_once "layout_foot.php";
?>