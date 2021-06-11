<?php
class User{
	private $conn;
	private $table_name="user";
	public $idUser;
	public $FullName;
	public $Sexe;
	public $Mobile_N;
	public $Adresse;
	public $Age;
	public $Groupage;
	public $User_Role;
	public $insert_id;

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

		$query='INSERT INTO `' . $this->table_name . '` '
            . '(`FullName`,`User_Role`,`Mobile_N`, `Adresse`, `Sexe`, `Age`, `Groupage`) VALUES '
            . '(:FullName,:User_Role,:Mobile_N,:Adresse,:Sexe,:Age,:Groupage)';

$stmt= $this->conn->prepare($query);

if ($stmt->execute(array(
':FullName'=>$this->FullName,
':User_Role'=>$this->User_Role,
':Mobile_N'=>$this->Mobile_N,
':Sexe'=>$this->Sexe,
':Adresse'=>$this->Adresse,
':Age'=>$this->Age,
':Groupage'=>$this->Groupage,
))) {
	# code...
	return true;
}
else{
	return false;
}

}
function getId(){

	$query='SELECT idUser FROM `user` WHERE idUser=(SELECT MAX(idUser)FROM `user`)';
	$stmt= $this->conn->prepare($query);
	$stmt->execute();
		
	return $stmt;
	
}
function readOne(){
	$query="SELECT * FROM ".$this->table_name."
WHERE idUser=?";
$stmt=$this->conn->prepare($query);
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$stmt->$bindParam(1,$this->idUser);
		$stmt->execute();
		
		$this->FullName=$row['FullName'];
		$this->Mobile_N=$row['Mobile_N'];
		$this->Sexe=$row['Sexe'];
		$this->Adresse=$row['Adresse'];
		$this->Age=$row['Age'];
		$this->Groupage=$row['Groupage'];
		$this->User_Role=$row['User_Role'];
}

function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE idUser = ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->idUser=htmlspecialchars(strip_tags($this->idUser));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->idUser);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

}
?>