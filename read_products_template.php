<?php
	// loop through list of retrieved products from the database
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

		echo "<div class='col-sm-6 col-md-4'>";

			echo "<div class='thumbnail'>";

				echo "<a href='{$home_url}product.php/" . $utils->slugify($row['name']) . "/{$row['id']}/'>";
					// related image files to a product
					$product_image->product_id=$row['id'];
					$stmt_product_image = $product_image->readFirst();
					$num_product_image = $stmt_product_image->rowCount();

					if($num_product_image>0){
						$x=1;
						while ($row_product_image = $stmt_product_image->fetch(PDO::FETCH_ASSOC)){
							$product_image_name = $row_product_image['name'];
							echo "<div class='photo-thumb-home' style='background: url(uploads/images/{$product_image_name}) 50% 20% no-repeat;'></div>";
							$x++;
						}
					}else{
						echo "No images.";
					}
				echo "</a>";

				echo "<div class='caption'>";

					echo "<div class='display-none product-id'>{$row['id']}</div>";
					echo "<div class='display-none product-name'>{$row['name']}</div>";

					$short_name = substr($row['name'], 0, 25) . '...';
					echo "<h3 title='{$row['name']}'>{$short_name}</h3>";

					echo "<p>";
						echo "&#36;" . number_format($row['price'], 2, '.', ',');
						
					echo "</p>";

					echo "<p>";
					// if product was already added in the cart
					$cart_item->user_id=isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
					$cart_item->product_id=$row['id'];

					// if product was already added in the cart
					if($cart_item->checkIfExists()){
						$quantity=$cart_item->quantity;
							
								echo "<form>";
									echo "<div class='input-group'>";

											// make quantity input box disabled
											echo "<input type='text' name='quantity' value='{$quantity}' disabled class='form-control' />";

											// disable button and say product was added
											echo "<span class='input-group-btn'>";
												echo "<button class='btn btn-success' disabled>";
													echo "<span class='glyphicon glyphicon-shopping-cart'></span> Added!";
												echo "</button>";
											echo "</span>";
									echo "</div>";
								echo "</form>";

						}

						// if product was not added yet in the cart
						else{
							echo "<form class='add-to-cart-form'>";
								echo "<div class='input-group'>";

										// enable input box so user can input quantity
										echo "<input type='number' name='quantity' value='1' class='form-control' placeholder='Type quantity here...' min='1'>";

										// enable add to cart button
										echo "<span class='input-group-btn'>";
											echo "<button type='submit' class='btn btn-primary add-to-cart'>";
												echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
											echo "</button>";
										echo "</span>";
								echo "</div>";
							echo "</form>";
						}
					echo "</p>";

				echo "</div>";

			echo "</div>";

		echo "</div>";

	}

// pagination
// the page where this paging is used
$page_dom ="";

// count of all records
$total_rows=0;

// count all products in the database to calculate total pages
if($page_title=='Product Search Results'){
	$page_dom = "search.php?s={$search_term}&";
	$total_rows = $product->countAll_BySearch($search_term);
}

// all products page
else if(strpos($page_title, 'Product')!==false && !isset($category_name)){
	$page_dom = "products.php?";
	$total_rows = $product->countAll();
}

// it's a product category page
else{
	$page_dom = "category.php?id={$category_id}&";
	$product->category_id=$category_id;
	$total_rows = $product->countAll_ByCategory();
}

// actual paging buttons
echo "<div class='col-sm-12 col-md-12'>";
include_once "paging.php";
echo "</div>";
?>
