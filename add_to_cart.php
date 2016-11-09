<?php
// core configuration
include_once 'config/core.php';

// connect to database
include_once 'config/database.php';

// utils
include_once 'libs/php/utils.php';

// cart item table is where we store cart data
include_once 'objects/cart_item.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$cart_item = new CartItem($db);
$utils = new Utils();

// product details
$id = isset($_GET['id']) ?  $_GET['id'] : die('ID not found.');
$name = isset($_GET['name']) ?  $_GET['name'] : die('Name not found.');
$quantity  = isset($_GET['quantity']) ?  $_GET['quantity'] : die('Quantity not found.');
$created = date('Y-m-d H:i:s');

// bind values
$cart_item->product_id=$id;
$cart_item->quantity=$quantity;
$cart_item->user_id=$_SESSION['user_id'];
$cart_item->created=$created;

// check first if a cart item with the same criteria exists

// if database insert succeeded
if($cart_item->create()){
    header('Location: products.php?action=added&id=' . $id . '&name=' . $name. '&page=' . $page);
}

// if database insert failed
else{
    header('Location: products.php?action=failed&id=' . $id . '&name=' . $name. '&page=' . $page);
}

?>
