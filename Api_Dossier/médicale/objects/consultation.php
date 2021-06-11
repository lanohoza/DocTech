<?php
class Consultation{
	private $conn;
	private $table_name="consultation";
	public $idC;
	public $Diagnostic;
	public $Mount;
	public $Patient_idP;
	public $Appoint;
	public $Doctor_id;

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

		$query='INSERT INTO `consultation` 
            (`Diagnostic`,`Mount`,`Patient_idP`, `Appoint`,`Doctor_id`) VALUES 
            (:Diagnostic,:Mount,:Patient_idP,:Appoint,:Doctor_id)';

$stmt= $this->conn->prepare($query);

if ($stmt->execute(array(
':Diagnostic'=>$this->Diagnostic,
':Mount'=>$this->Mount,
':Patient_idP'=>$this->Patient_idP,
':Appoint'=>$this->Appoint,
':Doctor_id'=>$this->Doctor_id
))) {
	# code...
	return true;
}
else{
	return false;
}

}

function getId(){

	$query='SELECT idC FROM `consultation` WHERE idC=(SELECT MAX(idC)FROM `consultation`)';
	$stmt= $this->conn->prepare($query);
	$stmt->execute();
		
	return $stmt;
	
}


}
?>