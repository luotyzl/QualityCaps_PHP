<?php
// core configuration
include_once "../config/core.php";

// check if logged in as admin
include_once "login_checker.php";

// include classes
include_once '../config/database.php';
include_once "../objects/supplier.php";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$supplier = new Supplier($db);

// set page title
$page_title = "Suppliers";

// include page header HTML
include_once "layout_head.php";

// read all suppliers
$stmt = $supplier->readAll($from_record_num, $records_per_page);

// count number of retrieved orders
$num = $stmt->rowCount();

$page_url="read_suppliers.php?";

// include Categories table HTML template
include_once "read_suppliers_template.php";

// include page footer HTML
include_once "layout_foot.php";
?>