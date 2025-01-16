<?php
require_once("Connection.php");
class Categorie {
    private $id ;
    private $titre ;
    private $description ;

    public function __construct($id=null,$titre,$description){
        $this->id=$id;
        $this->titre=$titre;
        $this->description=$description;
    }

    public function getId(){
        return $this->id;
    }
    public function getTitre(){
        return $this->titre;
    }
    
    public function getDescription(){
        return $this->description;
    }
    public function setTitre($titre){
        $this->titre=$titre;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    

    public function ajouterCategorie(){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("INSERT into Categorie (titre,description) values (:titre,:description)");
        $stm->bindParam(":titre",$this->titre,PDO::PARAM_STR);
        $stm->bindParam(":description",$this->description,PDO::PARAM_STR);
        $resultat=$stm->execute();
        if ($resultat) {
            $this->id=$pdo->lastInsertId();
            return true;
        }else {
            return false ;
        }
    }
    public static function afficherCategorie(){
        $pdo= Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT * from categorie");
        $stm->execute();
        $resultat=$stm->fetchAll(PDO::FETCH_ASSOC);
        $data=[];
        if ($resultat) {
            foreach ($resultat as $value) {
                $categories= new Categorie($value["id"],$value['titre'],$value['description']);
                $data[]=$categories;
            }
            return $data;
        }
    }
    public static function afficherCategorieId($id){
        $pdo=Database::getInstance()->getConnection();
        $stm =$pdo->prepare("SELECT * from categorie where id = :id");
        $stm->bindParam(":id",$id,PDO::PARAM_INT);
        $stm->execute();
        $resultat=$stm->fetch(PDO::FETCH_ASSOC);
        if ($resultat) {
            $categorie = new Categorie($resultat["id"], $resultat['titre'], $resultat['description']);
            return $categorie;
        } else {
            return null; 
        }
        
        
    }
    public function modifierCategorie(){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("UPDATE categorie set titre=:titre , description = :description where id = :id");
        $stm->bindParam(":titre",$this->titre,PDO::PARAM_STR);
        $stm->bindParam(":description",$this->description,PDO::PARAM_STR);
        $stm->bindParam(":id",$this->id,PDO::PARAM_INT);
        $resultat=$stm->execute();
        if ($resultat) {
            return true ;
        }else {
            return false ;
        }
    }

}

?>