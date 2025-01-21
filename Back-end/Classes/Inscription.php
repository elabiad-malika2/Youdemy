<?php
require_once("Connection.php");
require_once("CoursText.php");
require_once("CoursVideo.php");
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
    public static function getMyCourses($idE){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT c.* , u.fullName , ce.* from etudiant_cours ce 
                            join cours c on c.id=ce.cours_id
                            join user u on u.id=ce.etudiant_id 
                            where u.id = :idE and u.role='etudiant' ");
        $stm->bindParam(":idE",$idE,PDO::FETCH_ASSOC);
        $stm->execute();
        $resultat=$stm->fetchAll(PDO::FETCH_ASSOC);
        $data=[];
        foreach ($resultat as $value) {
            if ($value['contenu_type']=='video') {
                $data[] = new coursVideo($value['id'],$value['titre'],$value['description'],$value['categorie_id'],$value['image'],$value['enseignant_id'],$value['video_url'],$value['contenu_type']);
            
            }elseif ($value['contenu_type']=='texte') {
                $data[]= new coursTexte($value['id'],$value['titre'],$value['description'],$value['categorie_id'],$value['image'],$value['enseignant_id'],$value['contenu'],$value['contenu_type']);
                
            }
        }
        return $data ;

    }
    // Statistiques nbres des etudaints inscrits a un cours
    public static function nbrTotaleEtdInscrid($idE){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT count(ce.id) as totalEtudiant , c.titre  , group_concat(u.fullName) as nomEtd from etudiant_cours ce
                                join user u on u.id=ce.etudiant_id
                                join cours c on c.id=ce.cours_id 
                                where c.enseignant_id = :id
                                GROUP BY c.titre ");
        $stm->bindParam(":id",$idE,PDO::PARAM_INT);
        $stm->execute();
        $resultat=$stm->fetchAll(PDO::FETCH_ASSOC);
        return $resultat ;
    }
    public static function totalStudent($idE){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("select count(ce.etudiant_id) as totalStudent from etudiant_cours ce
                            join cours c on c.id = ce.cours_id
                            where c.enseignant_id = :idE ");
        $stm->bindParam(":idE",$idE,PDO::PARAM_INT);
        $stm->execute();
        $resultat=$stm->fetch(PDO::FETCH_ASSOC);
        return $resultat["totalStudent"];
    }
}

?>