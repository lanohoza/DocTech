<?php
class Departement{
	private $conn;
	private $table_name="departement";
	public $idDepartement;
	public $NameD;
	public $N;
	public $Hopital_Name;


	public function __construct($db){
		$this->conn=$db;
	}

	function read($N){
		$query="SELECT * FROM ".$this->table_name." WHERE Hopital_Name='$N'";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function getIdD(){
		 
$Name=isset($_GET['NameD']) ? $_GET['NameD'] : die();
$query="SELECT idDepartement FROM `departement` WHERE NameD='$this->NameD' ";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(1, $this->NameD);
		$stmt->execute();
		return $stmt;
	}

}
?>