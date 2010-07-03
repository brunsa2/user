<?php

class Database {
	private $databaseConnection;
	private $queryResult;
	private $numberOfresultsTotal, $numberOfResultsLeft;
	
	public function __construct($host, $username, $password, $database) {
		@ $this->databaseConnection = new mysqli($host, $username, $password, $database);
		
		if(mysqli_connect_errno()) {
			throw new Exception('Cannot connect to database: ' . mysqli_connect_error());
		}
	}
	
	public function select($table, $fields = '*', $where = '') {
		if($where != '') {
			@ $this->queryResult = $this->databaseConnection->query('select ' . $fields . ' from ' . $table . ' where ' . $where . ';');
		} else {
			@ $this->queryResult = $this->databaseConnection->query('select ' . $fields . ' from ' . $table . ';');
		}
		
		if($this->databaseConnection->error) {
			throw new Exception('Cannot select: ' . $this->databaseConnection->error);
		}
		
		$this->numberOfResultsLeft = $this->numberOfresultsTotal = $this->queryResult->num_rows;
	}
	
	public function getNumberOfRowsLeft() {
		return $this->numberOfResultsLeft;
	}
	
	public function getNumberOfRowsTotal() {
		return $this->numberOfresultsTotal;
	}
	
	public function hasRow() {
		return $this->getNumberOfRowsLeft == 0;
	}
	
	public function getRow() {
		$this->numberOfResultsLeft--;
		return $this->queryResult->fetch_assoc();
	}
	
	public function __destruct() {
		$this->databaseConnection->close();
	}
}

?>