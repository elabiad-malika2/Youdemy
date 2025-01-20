<?php
require_once("Connection.php");
class Inscription {
    private $idEtudiant;
    private $idCours;

    public function __construct($idEtudiant,$idCours){
        $this->idEtudiant=$idEtudiant;
        $this->idCours=$idCours;
    }

    // Rejoindre Cours :
    public  function rejoindreCours(){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("INSERT into etudiant_cours (cours_id,etudiant_id) values (:idC,:idE)");
        $stm->bindParam(':idC',$this->idCours,PDO::PARAM_INT);
        $stm->bindParam(':idE',$this->idEtudiant,PDO::PARAM_INT);
        $resultat=$stm->execute();
        if ($resultat) {
            return true ;
        }else {
            return false ;
        }

    }

    // Check user if join :
    public  function checkCourseJoined(){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT count(*) as total from etudiant_cours where cours_id = :idC and etudiant_id = :idE ");
        $stm->bindParam(":idC",$this->idCours,PDO::PARAM_INT);
        $stm->bindParam(":idE",$this->idEtudiant,PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }
}

?>