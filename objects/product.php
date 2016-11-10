<?php
// 'product' object
class Product{

	// database connection and table name
	private $conn;
	private $table_name = "products";

	// object properties
	public $id;
	public $name;
	public $price;
	public $category_id;
	public $category_name;
	public $supplier_id;
	public $supplier_name;
	// constructor
	public function __construct($db){
		$this->conn = $db;
	}

	// read products with field sorting
	public function readAll_WithSorting($from_record_num, $records_per_page, $field, $order){

		$query = "SELECT p.id, p.name, p.price, p.category_id, c.name as category_name, p.supplier_id, s.name as supplier_name,
					FROM products p
						LEFT JOIN categories c
							ON p.category_id=c.id
							LEFT JOIN suppliers s 
							ON p.supplier_id = s.id
					ORDER BY {$field} {$order}
					LIMIT :from_record_num, :records_per_page";

		// prepare query
		$stmt = $this->conn->prepare($query);

		// bind
		$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
		$stmt->execute();

		// return values from database
		return $stmt;
	}

	// create product record
	function create(){

		// insert product query
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					name = ?, price = ?, category_id = ?,supplier_id = ?";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));		
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));

		// bind values
		$stmt->bindParam(1, $this->name);
		$stmt->bindParam(2, $this->price);
		$stmt->bindParam(3, $this->category_id);
		$stmt->bindParam(4, $this->supplier_id);

		// execute query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	// read all products
	function readAll($from_record_num, $records_per_page){

		// select all products query
		$query = "SELECT
					c.name as category_name, p.id, p.name,  p.price, p.category_id,p.supplier_id,s.name as supplier_name
				FROM
					" . $this->table_name . " p
					LEFT JOIN
						categories c
					ON
						p.category_id = c.id
					LEFT JOIN
						suppliers s
					ON
						p.supplier_id = s.id
				ORDER BY
					p.name DESC
				LIMIT
					?, ?";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// bind limit clause variables
		$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

		// execute query
		$stmt->execute();

		// return values
		return $stmt;
	}

	// read all inactive products
	function readAll_Inactive($from_record_num, $records_per_page){

		// sql query to read all inactive products
		$query = "SELECT
					c.name as category_name,s.name as supplier_name, p.id, p.name, p.price, p.category_id,p.supplier_id
				FROM
					" . $this->table_name . " p
					LEFT JOIN
						categories c
					ON
						p.category_id = c.id
					LEFT JOIN
						suppliers s
					ON
						p.supplier_id = s.id
				ORDER BY
					p.name ASC
				LIMIT
					?, ?";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// bind limit clause variables
		$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

		// execute query
		$stmt->execute();

		// return values
		return $stmt;
	}

	// read products by category id
	function readAllByCategory($from_record_num, $records_per_page){

		// query to read all products by category
		$query = "SELECT
					c.name as category_name,s.name as supplier_name, p.id, p.name, p.price, p.category_id,p.supplier_id
				FROM
					" . $this->table_name . " p
					LEFT JOIN
						categories c
					ON
						p.category_id = c.id
					LEFT JOIN
						suppliers s
					ON
						p.supplier_id = s.id
				WHERE
					 category_id = ?
				ORDER BY
					p.name ASC
				LIMIT
					?, ?";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));

		// bind variable values
		$stmt->bindParam(1, $this->category_id);
		$stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);

		// execute query
		$stmt->execute();

		// return values
		return $stmt;
	}

	// read products by search term
	function search($search_term, $from_record_num, $records_per_page){

		// select query
		$query = "SELECT
					c.name as category_name, p.id, p.name, p.price, p.category_id
				FROM
					" . $this->table_name . " p
					LEFT JOIN
						categories c
							ON p.category_id = c.id
				WHERE
					p.name LIKE ?
				ORDER BY
					p.name ASC
				LIMIT
					?, ?";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$search_term = "%{$search_term}%";
		$search_term=htmlspecialchars(strip_tags($search_term));

		// bind variable values
		$stmt->bindParam(1, $search_term);
		$stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
		$stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);

		// execute query
		$stmt->execute();

		// return values from database
		return $stmt;
	}

	// read all product based on product ids included in the $ids variable
	// reference http://stackoverflow.com/a/10722827/827418
	public function readByIds($ids){

		$ids_arr = str_repeat('?,', count($ids) - 1) . '?';

		// query to select products
		$query = "SELECT id, name, price FROM products WHERE id IN ({$ids_arr}) ORDER BY name";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// execute query
		$stmt->execute($ids);

		// return values from database
		return $stmt;
	}

	// used for paging products
	public function countAll(){

		// query to count all product records
		$query = "SELECT count(*) FROM " . $this->table_name ;

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// execute query
		$stmt->execute();

		// get row value
		$rows = $stmt->fetch(PDO::FETCH_NUM);

		// return count
		return $rows[0];
	}

	// used for paging products by category
	public function countAll_ByCategory(){

		// 'select count' query to count products under a category
		$query = "SELECT count(*) FROM " . $this->table_name . " WHERE category_id=? ";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));

		// bind category id variable
		$stmt->bindParam(1, $this->category_id);

		// execute query
		$stmt->execute();

		// get row value
		$rows = $stmt->fetch(PDO::FETCH_NUM);

		// return count
		return $rows[0];
	}


	// used for paging inactive product list
	public function countAll_Inactive(){

		// count all inactive products
		$query = "SELECT count(*) FROM " . $this->table_name;

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// execute query
		$stmt->execute();

		// get row value
		$rows = $stmt->fetch(PDO::FETCH_NUM);

		// return count
		return $rows[0];
	}

	// used for paging products based on search term
	public function countAll_BySearch($search_term){

		// select query to count all records by search term
		$query = "SELECT id FROM " . $this->table_name . " WHERE name LIKE ?";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$search_term = "%{$search_term}%";
		$search_term=htmlspecialchars(strip_tags($search_term));

		// bind search term
		$stmt->bindParam(1, $search_term);

		// execute query
		$stmt->execute();

		// get number of records retrieved
		$num = $stmt->rowCount();

		// return count
		return $num;
	}

	// check if product is active or not
	function isActive(){

		// query to select single record
		$query = "SELECT
					 id
				FROM
					" . $this->table_name . "
				WHERE
					id=?
				LIMIT
					0,1";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));

		// bind product id value
		$stmt->bindParam(1, $this->id);

		// execute query
		$stmt->execute();

		// get number of records retrieved
		$num = $stmt->rowCount();

		if($num>0){
			return true;
		}

		return false;
	}

	// used when filling up the update product form
	function readOne(){

		// query to select single record
		$query = "SELECT
					c.name as category_name,s.name as supplier_name, p.name, p.price, p.category_id,p.supplier_id
				FROM
					" . $this->table_name . " p
					LEFT JOIN
						categories c
							ON p.category_id = c.id
					LEFT JOIN
						suppliers s
							ON p.supplier_id = s.id
				WHERE
					p.id = ?
				LIMIT
					0,1";

		// prepare query statement
		$stmt = $this->conn->prepare( $query );

		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));

		// bind product id value
		$stmt->bindParam(1, $this->id);

		// execute query
		$stmt->execute();

		// get row values
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// assign retrieved row value to object properties
		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->category_id = $row['category_id'];
		$this->category_name = $row['category_name'];
		$this->supplier_id = $row['supplier_id'];
		$this->supplier_name = $row['supplier_name'];

	}

	// update the product
	function update(){

		// product update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name = :name,
					price = :price,					
					category_id  = :category_id,
					supplier_id  = :supplier_id,
				WHERE
					id = :id";

		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->price=htmlspecialchars(strip_tags($this->price));
		$this->category_id=htmlspecialchars(strip_tags($this->category_id));
		$this->supplier_id=htmlspecialchars(strip_tags($this->supplier_id));
		$this->id=htmlspecialchars(strip_tags($this->id));

		// bind variable values
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':category_id', $this->category_id);
		$stmt->bindParam(':supplier_id', $this->supplier_id);
		$stmt->bindParam(':id', $this->id);

		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	// delete the product
	function delete(){

		// delete product query
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

		// prepare query
		$stmt = $this->conn->prepare($query);

		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));

		// bind product id variable
		$stmt->bindParam(1, $this->id);

		// execute query
		if($result=$stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	// used for the 'created' field when creating a product
	function getTimestamp(){
		date_default_timezone_set('Asia/Manila');
		$this->timestamp = date('Y-m-d H:i:s');
	}
}
?>
