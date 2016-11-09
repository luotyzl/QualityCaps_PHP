<?php
// 'order item' object
class OrderItem{
 
    // database connection and table name
    private $conn;
    private $table_name = "order_items";
 
    // object properties
	public $id;
	public $transaction_id;
	public $product_id;
	public $price;
	public $quantity;
	public $created;
	public $modified;

	// constructor
    public function __construct($db){
        $this->conn = $db;
    }
	
    // create order item record
    function create(){
 
        // to get times-tamp for 'created' field
        $this->created=date('Y-m-d H:i:s');
 
        // query to insert order item record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
					transaction_id = ?, 
					product_id = ?, 
					price = ?, 
					quantity = ?, 
					created = ?";
		
		// prepare query statement
        $stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->transaction_id=htmlspecialchars(strip_tags($this->transaction_id));
		$this->product_id=htmlspecialchars(strip_tags($this->product_id));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->quantity=htmlspecialchars(strip_tags($this->quantity));
		
		// bind values
        $stmt->bindParam(1, $this->transaction_id);
        $stmt->bindParam(2, $this->product_id);
        $stmt->bindParam(3, $this->price);
        $stmt->bindParam(4, $this->quantity);
		$stmt->bindParam(5, $this->created);
		
		// execute query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
		
    }
	
	// read all order item records under a transaction id
	function readAll(){
	 
		// query to select all order items
		$query = "SELECT 
					oi.id, oi.product_id, oi.price, oi.quantity, p.name as product_name 
				FROM 
					" . $this->table_name . " oi 
					LEFT JOIN products p 
					ON oi.product_id = p.id 			
				WHERE 
					oi.transaction_id = ?
				ORDER BY 
					oi.id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// sanitize
		$this->transaction_id=htmlspecialchars(strip_tags($this->transaction_id));
		
		// bind transaction id
		$stmt->bindParam(1, $this->transaction_id);
		
		// execute query
		$stmt->execute();
		
		// return values
		return $stmt;
	}

}
?>