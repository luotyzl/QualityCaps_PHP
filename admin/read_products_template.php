<div class='container row'>
	<!-- create product button -->
	<a href='create_product.php' class="btn btn-primary pull-right margin-bottom-1em">
		<span class="glyphicon glyphicon-plus"></span> Create Product
	</a>
	
</div>
<?php
// if number of products returned is more than 0
if($num>0){
	
	// order opposite of the current order
	$reverse_order=isset($order) && $order=="asc" ? "desc" : "asc";
	
	// field name
	$field=isset($field) ? $field : "";
	
	// field sorting arrow
	$field_sort_html="";
	
	if(isset($field_sort) && $field_sort==true){
		$field_sort_html.="<span class='badge'>";
			$field_sort_html.=$order=="asc" 
					? "<span class='glyphicon glyphicon-arrow-up'></span>"
					: "<span class='glyphicon glyphicon-arrow-down'></span>";
		$field_sort_html.="</span>";
	}
	
	// show list of products to user
	echo "<table class='table table-hover table-responsive table-bordered'>";
	
		// product table header
		echo "<tr>";
			echo "<th style='width:20%;'>";
				echo "<a href='read_products_sorted_by_fields.php?field=name&order={$reverse_order}'>";
					echo "Name ";
					echo $field=="name" ? $field_sort_html : "";
				echo "</a>";
			echo "</th>";
            echo "<th style='width:8%;'>";
				echo "<a href='read_products_sorted_by_fields.php?field=price&order={$reverse_order}'>";
					echo "Price ";
					echo $field=="price" ? $field_sort_html : "";
				echo "</a>";
			echo "</th>";
            echo "<th style='width:25%;'>";
				echo "<a href='read_products_sorted_by_fields.php?field=description&order={$reverse_order}'>";
					echo "Description ";
					echo $field=="description" ? $field_sort_html : "";
				echo "</a>";
			echo "</th>";
			echo "<th>";
				echo "<a href='read_products_sorted_by_fields.php?field=category_name&order={$reverse_order}'>";
					echo "Category ";
					echo $field=="category_name" ? $field_sort_html : "";
				echo "</a>";
			echo "</th>";
			echo "<th style='width:8%;'>";
				echo "<a href='read_products_sorted_by_fields.php?field=active_until&order={$reverse_order}'>";
					echo "Days Left ";
					echo $field=="active_until" ? $field_sort_html : "";
				echo "</a>";
			echo "</th>";
			echo "<th>Image(s)</th>";
			echo "<th>PDF(s)</th>";
			echo "<th class='width-13-em'>Actions</th>";
		echo "</tr>";
		
		// list products from the database
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		
			extract($row);
			
			echo "<tr>";
			
				// product details
				echo "<td>{$name}</td>";
				echo "<td>&#36;" . number_format($price, 2) . "</td>";
				echo "<td>{$description}</td>";
				echo "<td>{$category_name}</td>";
				
				// until when a product is active
				echo "<td>";
					if($active_until!="0000-00-00 00:00:00"){
						$date1 = new DateTime($active_until);
						$date2 = new DateTime(date('Y-m-d'));
						$interval = $date1->diff($date2);
						
						if($date1<$date2){
							echo "Inactive " . $interval->days . " days ago";
						}
						
						else{
							echo $interval->days . " days ";
						}
						
					}else{
						echo "Not set.";
					}
					
				echo "</td>";
					
				echo "<td>";
					// related image files to a product
					$product_image->product_id=$id;
					$stmt_product_image = $product_image->readAll();
					$num_product_image = $stmt_product_image->rowCount();
					
					if($num_product_image>0){
						$x=1;
						while ($row = $stmt_product_image->fetch(PDO::FETCH_ASSOC)){
							$product_image_name = $row['name'];
							echo "<a href='../uploads/images/{$product_image_name}' target='_blank'>Image {$x}</a><br />";
							$x++;
						}
					}else{
						echo "No images.";
					}
				echo "</td>";
				
				echo "<td>";
					// related PDF files to a product
					$product_pdf->product_id=$id;
					$stmt_product_pdf = $product_pdf->readAll();
					$num_product_pdf = $stmt_product_pdf->rowCount();
					
					if($num_product_pdf>0){
						$x=1;
						while ($row = $stmt_product_pdf->fetch(PDO::FETCH_ASSOC)){
							$product_pdf_name = $row['name'];
							echo "<a href='../uploads/pdfs/{$product_pdf_name}' target='_blank'>PDF {$x}</a><br />";
							$x++;
						}
					}else{
						echo "No PDFs.";
					}
				echo "</td>";
				
				echo "<td>";
				
					// edit product button
					echo "<a href='update_product.php?id={$id}' class='btn btn-info btn-margin-right'>";
						echo "<span class='glyphicon glyphicon-edit'></span> Edit";
					echo "</a>";
					
					// delete product button
					echo "<a delete-id='{$id}' delete-file='delete_product.php' class='btn btn-danger delete-object'>";
						echo "<span class='glyphicon glyphicon-remove'></span> Delete";
					echo "</a>";
				echo "</td>";
				
			echo "</tr>";
			
		}
		
	echo "</table>";
	
	// the number of rows retrieved on that page
	$total_rows=0;

	// product search results
	if(isset($search_term) && $page_url="search_products.php?s={$search_term}&"){
		$total_rows = $product->countAll_BySearch($search_term);
	}

	// all inactive products
	else if($page_url=="read_inactive_products.php?"){
		$total_rows = $product->countAll_Inactive();
	}

	// all active products
	else if($page_url=="read_products.php?"){
		$total_rows = $product->countAll();
	}

	else if(isset($field) && isset($order) && $page_url=="read_products_sorted_by_fields.php?field={$field}&order={$order}&"){
		$total_rows=$product->countAll();
	}
	
	// it's a product category
	else if(isset($category_id) && $page_url=="category.php?id={$category_id}&"){
		$product->category_id=$category_id;
		$total_rows = $product->countAll_ByCategory();
	}
	
	// actual paging buttons
	include_once 'paging.php';

}

// tell the user if there's no products in the database
else{
	echo "<div class='alert alert-danger'>";
		echo "<strong>No products found.</strong>";
	echo "</div>";
}
?>