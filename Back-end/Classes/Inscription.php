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
    public static function checkCourseJoined($idC,$idE){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT * from cours_tag where enseignant_id = :idC and categorie_id = :idE ");
        $stm->binParam(":idC",$idC,PDO::FETCH_ASSOC);
        $stm->binParam(":idE",$idE,PDO::FETCH_ASSOC);
        $resultat=$stm->execute();
        if ($resultat) {
            return true ;
        }
    }
}

?>