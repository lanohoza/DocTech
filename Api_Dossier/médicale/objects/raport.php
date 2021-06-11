<?php
class Raport{
	private $conn;
	private $table_name="raport";
	public $Medicament_idM;
	public $Consultation_idC;
	

	public function __construct($db){
		$this->conn=$db;
	}

	function readInfoP(){
		$sql = "SELECT * FROM `raport` INNER \n"

    . "JOIN medicament ON raport.Medicament_idM=medicament.idM\n"

    . "JOIN consultation ON raport.Consultation_idC=consultation.idC\n"

    . "JOIN patient ON consultation.Patient_idP=patient.idP JOIN user AS u ON patient.User_idUser=u.idUser ";
		
		$stmt=$this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}

function readInfoD(){
		$sql = "SELECT * FROM `raport` INNER \n"

. "JOIN consultation ON raport.Consultation_idC=consultation.idC\n"
	."JOIN doctor ON consultation.Doctor_id= doctor.idDoctor JOIN user AS us ON doctor.User_idUser=us.idUser JOIN departement ON doctor.Departement_idDepartement=departement.idDepartement JOIN hopital ON departement.Hopital_Name=hopital.Name";
		
		$stmt=$this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}


	function readOneP(){

		$sql = "SELECT * FROM `raport` INNER \n"

    . "JOIN medicament ON raport.Medicament_idM=medicament.idM\n"

    . "JOIN consultation ON raport.Consultation_idC=consultation.idC\n"

    . "JOIN patient ON consultation.Patient_idP=patient.idP JOIN user AS u ON patient.User_idUser=u.idUser WHERE Consultation_idC=?";
		
		$stmt=$this->conn->prepare($sql);
		$stmt->bindParam(1, $this->Consultation_idC);
		$stmt->execute();
		return $stmt;
	}

function readOneD(){
	$Consultation_idC=isset($_GET['Consultation_idC']) ? $_GET['Consultation_idC'] : die();
		$sql = "SELECT * FROM `raport` INNER \n"

. "JOIN consultation ON raport.Consultation_idC=consultation.idC\n"
	."JOIN doctor ON consultation.Doctor_id= doctor.idDoctor JOIN user AS us ON doctor.User_idUser=us.idUser JOIN departement ON doctor.Departement_idDepartement=departement.idDepartement JOIN hopital ON departement.Hopital_Name=hopital.Name WHERE Consultation_idC=? ";
		
		$stmt=$this->conn->prepare($sql);
		$stmt->bindParam(1, $this->Consultation_idC);
		$stmt->execute();
		return $stmt;
	}



	function createR(){

		$query='INSERT INTO `raport` 
            (`Consultation_idC`,`Medicament_idM`) VALUES 
            (:Consultation_idC,:Medicament_idM)';

$stmt= $this->conn->prepare($query);

if ($stmt->execute(array(
':Consultation_idC'=>$this->Consultation_idC,
':Medicament_idM'=>$this->Medicament_idM,
))) {
	# code...
	return true;
}
else{
	return false;
}

}



function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE Consultation_idC= ?";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->Consultation_idC=htmlspecialchars(strip_tags($this->Consultation_idC));
  
    // bind id of record to delete
    $stmt->bindParam(1, $this->Consultation_idC);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

}
?>