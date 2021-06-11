<?php
class Medicament{
	private $conn;
	private $table_name="medicament";
	public $idM;
	public $NameM;
	
	public function __construct($db){
		$this->conn=$db;
	}

	function read(){
		$query="SELECT * FROM ".$this->table_name."";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function create(){

		$query='INSERT INTO `medicament` 
            (`NameM`) VALUES 
            (:NameM)';

$stmt= $this->conn->prepare($query);

if ($stmt->execute(array(
':NameM'=>$this->NameM
))) {
	# code...
	return true;
}
else{
	return false;
}

}


function ExsistM(){
	$query=" SELECT * FROM medicament WHERE NameM=?";
	$stmt=$this->conn->prepare($query);
	$stmt->bindParam(1, $this->Username);
	$stmt->execute();
	if ($stmt->rowCount()>0) {
		return true;
		# code...
	}
	else
		return false;
}


function SelectidM($ND){
	//$NameM=isset($_GET['NameM']) ? $_GET['NameM'] : die();
	$query="SELECT idM FROM `medicament`
WHERE NameM='$ND'";
$stmt=$this->conn->prepare($query);
		$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode(json_decode($row['idM']),true);
		return $row['idM'];
		}


}
?>