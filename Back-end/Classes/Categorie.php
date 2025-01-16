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
        $this->id;
    }
    public function getTitre(){
        $this->titre;
    }
    public function setTitre($titre){
        return $this->titre=$titre;
    }
    public function getDescription(){
        $this->descriptio;
    }
    public function setDescription($description){
        return $this->description=$description;
    }

    public function ajouterCategorie(){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("INSERT into Categorie (titre,description) values (:titre,:description)");
        $stm->bindParam(":titre",$this->titre,PDO::);
    }

}

?>