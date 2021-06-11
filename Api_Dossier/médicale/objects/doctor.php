<?php
class Doctor{
	private $conn;
	private $table_name="doctor";
	public $idDoctor;
	public $Username;
	public $password;
	public $Departement_idDepartement;
	public $User_idUser;
	public $Hopital_Name;
	public $TimeB;
	public $TimeC;
	private $tab_us="user";

	public function __construct($db){
		$this->conn=$db;
	}

	function readOne(){
		$idDoctor=isset($_GET['idDoctor']) ? $_GET['idDoctor'] : die();
		$query="SELECT * FROM ".$this->table_name."
			INNER JOIN $this->tab_us ON $this->table_name.User_idUser=$this->tab_us.idUser
		WHERE idDoctor=?";
		$stmt1=$this->conn->prepare($query);
		$stmt1->bindParam(1, $this->idDoctor);
		$stmt1->execute();
		return $stmt1;
	}

	function signup(){


$query="INSERT INTO `doctor` (`Hopital_Name`, `Departement_idDepartement`, `User_idUser`, `Username`, `password`, `TimeB`, `TimeC`) VALUES (:Hopital_Name,:Departement_idDepartement,:User_idUser,:Username,:password,:TimeB,:TimeC)";


$stmt= $this->conn->prepare($query);

if ($stmt->execute(array(
':Hopital_Name'=>$this->Hopital_Name,
':Departement_idDepartement'=>$this->Departement_idDepartement,
':User_idUser'=>$this->User_idUser,
':Username'=>$this->Username,
':password'=>$this->password,
':TimeB'=>$this->TimeB,
':TimeC'=>$this->TimeC,



))) {
	# code...
	return true;
}
else{
	return false;
}


}

function login(){

$Username = isset($_GET['Username']) ? $_GET['Username'] : die();
$password = (isset($_GET['password'])) ? $_GET['password'] : die();
	
		$query="SELECT * FROM `doctor` WHERE Username='$Username' AND password='$password'";
$stmt=$this->conn->prepare($query);
	$stmt->bindParam(1, $this->Username);
	$stmt->bindParam(1, $this->password);
		$stmt->execute();		
		return $stmt;

	
	}

function ExsistD(){
	$query=" SELECT * FROM doctor WHERE Username=?";
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

function getIdD(){
		 
$Username=isset($_GET['Username']) ? $_GET['Username'] : die();
$query="SELECT idDoctor FROM `doctor` WHERE Username='$Username' ";
		$stmt=$this->conn->prepare($query);
		$stmt->bindParam(1, $this->Username);
		$stmt->execute();
		//return $stmt;
		$num=$stmt->rowCount();
if($num>0){
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	extract((array)$row);
    $d =  json_decode(json_encode($row),true);
    
   
    ;
    $idDoctor=$d['idDoctor'];
    echo json_encode($idDoctor);
    return ($d['idDoctor']);
}
}
else
	echo "no patient with this name";
    
	}




}
?>