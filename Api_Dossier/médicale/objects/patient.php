<?php

class Patient{
	private $conn;
	private $table_name="patient";
	public $idP;
	public $User_idUser;
	private $tab_us="user";
	public $FullName;



	public function __construct($db){
		$this->conn=$db;
	}

	function read(){
		$query="SELECT * FROM ".$this->table_name."
			INNER JOIN $this->tab_us ON $this->table_name.User_idUser=$this->tab_us.idUser
		";
		$stmt1=$this->conn->prepare($query);
		$stmt1->execute();
		return $stmt1;
	}

	function readOne(){
		$idP=isset($_GET['idP']) ? $_GET['idP'] : die();
		$query="SELECT * FROM ".$this->table_name."
			INNER JOIN $this->tab_us ON $this->table_name.User_idUser=$this->tab_us.idUser
		WHERE idP=?";
		$stmt1=$this->conn->prepare($query);
		$stmt1->bindParam(1, $this->idP);
		$stmt1->execute();
		return $stmt1;
	}

function getIdP(){
		 
$FullName=isset($_GET['FullName']) ? $_GET['FullName'] : die();
$query="SELECT idP FROM `patient` WHERE User_idUser=(SELECT idUser FROM `user` WHERE FullName='$FullName') ";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(1, $this->FullName);
		$stmt->execute();
		//return $stmt;
		$num=$stmt->rowCount();
if($num>0){
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	extract((array)$row);
    $d =  json_decode(json_encode($row),true);
    
    $idP=json_decode($d['idP'])
    ;
    $idp=$d['idP'];
    echo json_encode($idP);
    return ($d['idP']);
}
}
else
	echo "no patient with this name";
    
	}



	function createP(){
			
		$query='INSERT INTO `' . $this->table_name . '` '
            . '(`User_idUser`) VALUES '
            . '(:User_idUser)';

$stmt= $this->conn->prepare($query);

if ($stmt->execute(array(
':User_idUser'=>$this->User_idUser
))) {
	# code...
	return true;
}
else{
	return false;
}

}

}
?>