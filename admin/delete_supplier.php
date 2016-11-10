<?php
// check if value was posted
if($_POST){
 
    // include classes
    include_once '../config/database.php';
    include_once '../objects/supplier.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare supplier object
    $supplier = new Supplier($db);
 
    // set supplier id to be deleted
    $supplier->id = $_POST['object_id'];
 
    // delete the supplier
    if($supplier->delete()){
        echo "Object was deleted.";
    }

    // if unable to delete the supplier
    else{
        echo "Unable to delete object.";
    }
}
?>