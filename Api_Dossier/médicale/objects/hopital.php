<?php
class Hopital{
	private $conn;
	private $table_name="hopital";
	public $Name;

	public function __construct($db){
		$this->conn=$db;
	}

	function read(){
		$query="SELECT * FROM ".$this->table_name."";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function getNameH(){
		 
$Name=isset($_GET['Name']) ? $_GET['Name'] : die();
$query="SELECT Name FROM `hopital` WHERE Name='$Name' ";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(1, $this->Name);
		$stmt->execute();
		
		return($stmt);
}
	}
?>