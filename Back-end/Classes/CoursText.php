<?php
require_once("connection.php");
require_once("Cours.php");
class CoursText extends Cours{
    public function __construct($id=null,$titre=null,$description=null,$id_categorie=null,$id_enseignant=null,$image=null,$contenue=null,$type=null)
    {
        parent::__construct($id,$titre,$description,$id_categorie,$id_enseignant,$image,$contenue,$type);
    }
    public function ajouterCours(){
        
        $type='texte';
        $this->setType($type);
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("INSERT into cours (titre,description,categorie_id,image,enseignant_id,contenu_type,contenu) values (:titre,:description,:categorie_id,:image,:enseignant_id,:type,:contenu)");
        $stm->bindParam(":titre",$this->titre);
        $stm->bindParam(':description', $this->description);
        $stm->bindParam(':categorie_id', $this->id_categorie);
        $stm->bindParam(':image', $this->image);
        $stm->bindParam(':enseignant_id', $this->id_enseignant);
        $stm->bindParam(':contenu', $this->contenue);
        $stm->bindParam(':type', $this->type);
        $resultat=$stm->execute();
    if ($resultat) {
        $this->id=$pdo->lastInsertId();
        return true ;
    }else {
        return false;
    }
    }
    public static function afficherCoursId($id){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT * from cours where id = :id");
        $stm->bindParam(":id",$id);
        $stm->execute();
        $resultat=$stm->fetch(PDO::FETCH_ASSOC);
        $coursTexte = new CoursText($resultat['id'], $resultat['titre'], $resultat['description'], $resultat['categorie_id'], $resultat['enseignant_id'], $resultat['image'], $resultat['contenu'],$resultat['contenu_type']);
        return $coursTexte ;

    }

}
?>