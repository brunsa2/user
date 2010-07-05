<?php

class Database {
	private $databaseConnection;
	private $queryResult;
	private $numberOfRowsTotal, $numberOfRowsLeft;
	
	public function __construct($host, $username, $password, $database) {
		@ $this->databaseConnection = new mysqli($host, $username, $password, $database);
		
		if(mysqli_connect_errno()) {
			throw new Exception('Cannot connect to database: ' . mysqli_connect_error());
		}
	}
	
	public function select($table, $fields = '*', $where = '') {
		$query = '';
		if($where != '') {
			@ $this->queryResult = $this->databaseConnection->query('select ' . $fields . ' from ' . $table . ' where ' . $where . ';');
			$query = 'select ' . $fields . ' from ' . $table . ' where ' . $where . ';';
		} else {
			@ $this->queryResult = $this->databaseConnection->query('select ' . $fields . ' from ' . $table . ';');
			$query = 'select ' . $fields . ' from ' . $table . ';';
		}
		
		if($this->databaseConnection->error) {
			throw new Exception('Cannot select (QUERY: ' . $query . ') : ' . $this->databaseConnection->error);
		}
		
		$this->numberOfRowsLeft = $this->numberOfRowsTotal = $this->queryResult->num_rows;
	}
	
	public function getNumberOfRowsLeft() {
		return $this->numberOfRowsLeft;
	}
	
	public function getNumberOfRowsTotal() {
		return $this->numberOfRowsTotal;
	}
	
	public function hasRow() {
		return $this->numberOfRowsLeft != 0;
	}
	
	public function getRow() {
		$this->numberOfRowsLeft--;
		return $this->queryResult->fetch_assoc();
	}
	
	public function __destruct() {
		$this->databaseConnection->close();
	}
}

?>