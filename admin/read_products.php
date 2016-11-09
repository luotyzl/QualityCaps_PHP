<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
include_once "login_checker.php";

// include classes
include_once "../config/database.php";
include_once "../objects/product.php";
include_once "../objects/category.php";
include_once "../objects/product_image.php";
include_once "../objects/product_pdf.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);
$category = new Category($db);
$product_image = new ProductImage($db);
$product_pdf = new ProductPdf($db);

// set page title
$page_title="Active Products";

// include page header HTML
include 'layout_head.php';

// get parameter values, and to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// tell the user he's already logged in
if($action=='already_logged_in'){
	echo "<div class='alert alert-info'>";
		echo "<strong>You</strong> are already logged in.";
	echo "</div>";
}

// read all active products in the database
$stmt=$product->readAll($from_record_num, $records_per_page);

// count number of products returned
$num = $stmt->rowCount();

// to identify page for paging
$page_url="read_products.php?";

// include products table HTML template
include_once "read_products_template.php";

// include page footer HTML
include_once 'layout_foot.php';
?>