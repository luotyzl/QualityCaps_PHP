<?php
// core configuration
include_once "config/core.php";

// include classes
include_once "config/database.php";
include_once "libs/php/utils.php";
include_once "objects/product.php";
include_once "objects/category.php";
include_once "objects/product_image.php";
include_once 'objects/cart_item.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize utility class
$utils = new Utils();

// initialize objects
$product = new Product($db);
$category = new Category($db);
$product_image = new ProductImage($db);
$cart_item = new CartItem($db);

// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// set the id as product id property
$product->id = $id;

// check if product is active
if(!$product->isActive()){
	// redirect
	header("Location: {$home_url}products.php?action=product_inactive");
}

// to read single record product
$row = $product->readOne();

// set page title
$page_title = $product->name;

// include page header HTML
include_once 'layout_head.php';

echo "<div class='col-md-12'>";

?>
<!-- HTML form for viewing a product -->
	<table class='table table-hover table-responsive table-bordered margin-1em-zero'>

		<tr>
			<td colspan='2'>
			<?php
			// set product id
			$product_image->product_id=$id;

			// read all related product image
			$stmt_product_image = $product_image->readAll();

			// count all relatd product image
			$num_product_image = $stmt_product_image->rowCount();

			// if count is more than zero
			if($num_product_image>0){
				$x=1;

				// loop through all product images
				while ($row = $stmt_product_image->fetch(PDO::FETCH_ASSOC)){

					// image name and source url
					$product_image_name = $row['name'];
					$source="{$home_url}uploads/images/{$product_image_name}";

					// create thumbnail for image
					echo "<a href='{$source}' data-gallery>";
						echo "<div class='photo-thumb' style='background: url({$source}) 50% 50% no-repeat;'>";
						echo "</div>";
					echo "</a>";

					$x++;
				}
			}else{
				echo "No images.";
			}
			?>
			</td>
		</tr>

		<tr>
			<td class='width-30-percent'>Price</td>
			<td class='width-70-percent'><?php echo "&#36;" . number_format($product->price, 2, '.', ','); ?></td>
		</tr>


		<tr>
			<td>Category</td>
			<td>
				<?php
				echo $product->category_name;
				?>
			</td>
		</tr>

		<?php
		// if product was already added in the cart
		$cart_item->user_id=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
		$cart_item->product_id=$row['id'];

		// if product was already added in the cart
		if($cart_item->checkIfExists()){
			$quantity=$cart_item->quantity;

			// get quantity value
			$quantity=$_SESSION['cart'][$id]['quantity'];

			echo "<tr>";
				echo "<td>Quantity</td>";
				echo "<td>";

					echo "<form class='add-to-cart-form'>";
						echo "<div class='input-group'>";
								// disable the input box
								echo "<input type='number' name='quantity' value='{$quantity}' class='form-control' placeholder='Type quantity here...' min='1' disabled>";

								// disable the add to cart button
								echo "<span class='input-group-btn'>";
									echo "<button type='submit' class='btn btn-primary add-to-cart' disabled>";
										echo "<span class='glyphicon glyphicon-shopping-cart'></span> Already In Cart";
									echo "</button>";
								echo "</span>";
						echo "</div>";
					echo "</form>";

				echo "</td>";
			echo "</tr>";
		}

		// if product was not added to the cart yet
		else{
			echo "<tr>";
				echo "<td>";
					echo "<div class='product-id' style='display:none;'>{$id}</div>";
					echo "<div class='product-name' style='display:none;'>{$product->name}</div>";
					echo "Action";
				echo "</td>";
				echo "<td>";
					echo "<form class='add-to-cart-form'>";
						echo "<div class='input-group'>";
								// enable input box
								echo "<input type='number' name='quantity' value='1' class='form-control' placeholder='Type quantity here...' min='1'>";

								// enable add to cart button
								echo "<span class='input-group-btn'>";
									echo "<button type='submit' class='btn btn-primary add-to-cart'>";
										echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
									echo "</button>";
								echo "</span>";
						echo "</div>";
					echo "</form>";
				echo "</td>";
			echo "</tr>";
		}
		?>

	</table>

	<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
	<div id="blueimp-gallery" class="blueimp-gallery">
		<!-- The container for the modal slides -->
		<div class="slides"></div>
		<!-- Controls for the borderless lightbox -->
		<h3 class="title"></h3>
		<a class="prev"><</a>
		<a class="next">></a>
		<a class="close">X</a>
		<a class="play-pause"></a>
		<ol class="indicator"></ol>
		<!-- The modal dialog, which will be used to wrap the lightbox content -->
		<div class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" aria-hidden="true">&times;</button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body next"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left prev">
							<i class="glyphicon glyphicon-chevron-left"></i>
							Previous
						</button>
						<button type="button" class="btn btn-primary next">
							Next
							<i class="glyphicon glyphicon-chevron-right"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
echo "</div>";

// include page footer HTML
include_once 'layout_foot.php';
?>
