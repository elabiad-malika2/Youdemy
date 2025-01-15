<?php
require_once("connection.php");
require_once("Cours.php");
class CoursVideo extends Cours{
    public function __construct($id=null,$titre=null,$description=null,$id_categorie=null,$id_enseignant=null,$image=null,$contenue=null,$type=null)
    {
        parent::__construct($id,$titre,$description,$id_categorie,$id_enseignant,$image,$contenue,$type);
    }
    public function ajouterCours(){
        
        $type='video';
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
        return "OK";
    }else {
        return 'NOK';
    }
    }
    public function afficherCoursId($id){

    }

}
?>