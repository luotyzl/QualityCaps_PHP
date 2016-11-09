<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
include_once "login_checker.php";

// include classes
include_once '../config/database.php';
include_once "../objects/category.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$category = new Category($db);

// set page title
$page_title = "Categories";

// include page header HTML
include_once "layout_head.php";

// read all Categories
$stmt = $category->readAll($from_record_num, $records_per_page);

// count number of retrieved orders
$num = $stmt->rowCount();

$page_url="read_Categories.php?";

// include Categories table HTML template
include_once "read_Categories_template.php";

// include page footer HTML
include_once "layout_foot.php";
?>