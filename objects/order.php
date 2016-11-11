<?php
// 'order' object
class Order{
 
    // database connection and table name
    private $conn;
    private $table_name = "orders";
 
    // object properties
	public $id;
	public $transaction_id;
	public $user_id;
	public $username;
	public $total_cost;
	public $status;
	public $created;
 
	// constructor
    public function __construct($db){
        $this->conn = $db;
    }
	
	// used by admin to change order status
	function changeStatus(){
		
		// change status query
		$query = "UPDATE " . $this->table_name . "
				SET status = :status
				WHERE transaction_id = :transaction_id";
					
		// prepare the query
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->status=htmlspecialchars(strip_tags($this->status));
		$this->transaction_id=htmlspecialchars(strip_tags($this->transaction_id));
		
		// bind the values from the form
		// new status to be set
		$stmt->bindParam(':status', $this->status);
		
		// unique transaction_id of record to be edited
		$stmt->bindParam(':transaction_id', $this->transaction_id);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
    // create record
    function create(){
 
        // to get time-stamp for 'created' field
        $this->created=date('Y-m-d H:i:s');
 
        // insert query
        $query = "INSERT INTO " . $this->table_name . "
                SET
					transaction_id = ?, 
					user_id = ?, 
					total_cost = ?, 
					status = ?,
					created = ?";
		
		// prepare query statement
        $stmt = $this->conn->prepare($query);
 
		// sanitize
		$this->transaction_id=htmlspecialchars(strip_tags($this->transaction_id));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		$this->total_cost=htmlspecialchars(strip_tags($this->total_cost));
		$this->status="0";
		
		// bind values to be inserted
        $stmt->bindParam(1, $this->transaction_id);
        $stmt->bindParam(2, $this->user_id);
        $stmt->bindParam(3, $this->total_cost);
		$stmt->bindParam(4, $this->status);
        $stmt->bindParam(5, $this->created);
		
		
		// execute the query
        if($stmt->execute()){
            return true;
        }else{
			$stmt->execute();
			$errorInfor = $stmt->errorInfo();
			$file = fopen('log.txt', 'a') or exit("Unable to open file!");
			//Output a line of the file until the end is reached
			fwrite($file, $errorInfor[2] . date('d/m/Y == H:i:s') ."\r\n" );
			fclose($file);
            return false;
        }
    }
	
	// read single order by transaction id
	function readOneByTransactionId(){
	 
		// select single record query
		$query = "SELECT
					o.transaction_id, 
					o.user_id, 
					o.total_cost, 
					o.status, 
					o.created, 
					u.username as username
				FROM
					" . $this->table_name . " o 
					LEFT JOIN users u 
					ON o.user_id = u.id 
				WHERE
					o.transaction_id = ? 
				LIMIT
					0,1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
		
		// sanitize
		$this->transaction_id=htmlspecialchars(strip_tags($this->transaction_id));
		
		// bind transaction id value
		$stmt->bindParam(1, $this->transaction_id);
		
		// execute query
		$stmt->execute();
	 
		// get row values
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// assigned values to object properties
		$this->transaction_id = $row['transaction_id'];
		$this->user_id = $row['user_id'];
		$this->username = $row['username'];
		$this->total_cost = $row['total_cost'];
		$this->status = $row['status'];
		$this->created = $row['created'];
	}
	
	
	// count all records based on search term
	public function countAll_BySearch($search_term){
		
		// search order query
		$query = "SELECT 
					o.id, 
					o.transaction_id, 
					o.user_id, 
					o.total_cost, 
					o.status, 
					o.created, 
					u.username as username
				FROM 
					" . $this->table_name . " o 
					LEFT JOIN users u
					ON o.user_id = u.id 
				WHERE 
					o.transaction_id = ?";
		
		// prepare query
		$stmt = $this->conn->prepare( $query );
		
		// sanitize
		$search_term=htmlspecialchars(strip_tags($search_term));
		
		// bind search term
		$stmt->bindParam(1, $search_term);

		// execute query
		$stmt->execute();
		
		// count number of rows retrieved
		$num = $stmt->rowCount();
		
		// return count
		return $num;
	}
	
	// read orders by search term / transaction_id
	function search($search_term, $from_record_num, $records_per_page){

		// search order query
		$query = "SELECT 
					o.id, 
					o.transaction_id, 
					o.user_id, 
					o.total_cost, 
					o.status, 
					o.created, 
					u.username as username
				FROM 
					" . $this->table_name . " o 
					LEFT JOIN users u
					ON o.user_id = u.id 
				WHERE 
					o.transaction_id = ? 
				ORDER BY 
					o.created ASC 
				LIMIT 
					?, ?";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$search_term=htmlspecialchars(strip_tags($search_term));
		
		// bind  variables
		$stmt->bindParam(1, $search_term);
		$stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
		
		// execute query
		$stmt->execute();
		
		// return values
		return $stmt;
	}
	
	// read all order records
	function readAll($from_record_num, $records_per_page){
	 
		// select all orders query
		$query = "SELECT 
					o.id, 
					o.transaction_id, 
					o.user_id, 
					o.total_cost, 
					o.status, 
					o.created, 
					u.username as username
				FROM
					" . $this->table_name . " o 
					LEFT JOIN users u
					ON o.user_id = u.id 
				WHERE 
					o.status = ? 
				ORDER BY
					o.created DESC 
				LIMIT
					?, ?";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
		
		// sanitize
		$this->status=htmlspecialchars(strip_tags($this->status));
		
		// bind limit clause values
		$stmt->bindParam(1, $this->status);
		$stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);
		
		// execute query
		$stmt->execute();
	 
		// return values
		return $stmt;
	}
	
	// read all orders by user id
	function readAll_ByUser($from_record_num, $records_per_page){
	 
		// query to select all orders related to a user
		$query = "SELECT 
					o.id, 
					o.transaction_id, 
					o.user_id, 
					o.total_cost, 
					o.status, 
					o.created,
					u.username as username
				FROM
					" . $this->table_name . " o 
					LEFT JOIN users u 
					ON o.user_id = u.id 
				WHERE 
					o.user_id=? AND o.status=? 
				ORDER BY
					o.created DESC 
				LIMIT 
					?, ?";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
		
		// sanitize
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		$this->status=htmlspecialchars(strip_tags($this->status));
		
		// bind values
		$stmt->bindParam(1, $this->user_id);
		$stmt->bindParam(2, $this->status);
		$stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
		
		// execute query
		$stmt->execute();
	 
		// return values
		return $stmt;
	}

	// count all orders
	public function countAll(){
	 
		// select all orders query
		$query = "SELECT id FROM " . $this->table_name . " WHERE status = ?";
	 
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
		
		// sanitize
		$this->status=htmlspecialchars(strip_tags($this->status));
		
		// bind
		$stmt->bindParam(1, $this->status);
		
		// execute query
		$stmt->execute();
	 
		// get record count
		$num = $stmt->rowCount();
	 
		// return row count
		return $num;
	}
	
	// delete the order record
	function delete(){
	 
		// delete order query
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		
		// bind order id of record to be deleted
		$stmt->bindParam(1, $this->id);
	 
		// execute the query
		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

}
?>