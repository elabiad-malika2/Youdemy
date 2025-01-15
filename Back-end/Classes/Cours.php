<?php
require_once("Connection.php");
abstract class Cours {
    protected $id;
    protected $titre;
    protected $description;
    protected $id_categorie;
    protected $id_enseignant;
    protected $image;
    protected $contenue;
    protected $type;

    public function __construct($id=null,$titre=null,$description=null,$id_categorie=null,$id_enseignant=null,$image=null,$contenue=null,$type=null){
        $this->id=$id;
        $this->titre=$titre;
        $this->description=$description;
        $this->id_categorie=$id_categorie;
        $this->id_enseignant=$id_enseignant;
        $this->image=$image;
        $this->contenue=$contenue;
        $this->type=$type;
    }


    public function getId() {
        return $this->id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getIdCategorie() {
        return $this->id_categorie;
    }

    public function setIdCategorie($id_categorie) {
        $this->id_categorie = $id_categorie;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image_path = $image;
    }

    public function getContenue() {
        return $this->contenue;
    }

    public function setContenue($contenue) {
        $this->contenue = $contenue;
    }
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }



    abstract public function ajouterCours();
    abstract public static function afficherCoursId($id);

    public function modifierCours($id){
        $pdo=Databse::getInstance()->getConnection();
        $stm = $pdo->prepare("UPDATE cours set titre = :titre, description = :description, id_categorie = :id_categorie, image_path = :image_path, contenue = :contenue, type = :type WHERE id = :id ") ;
        $stm->bindParam(':titre', $this->titre);
        $stm->bindParam(':description', $this->description);
        $stm->bindParam(':id_categorie', $this->id_categorie);
        $stm->bindParam(':image_path', $this->image_path);
        $stm->bindParam(':contenue', $this->contenue);
        $stm->bindParam(':type', $this->type);
        $stm->bindParam(':id', $this->id);

        $stm->execute();
        return 'OK';
    }
    public function supprimerCours($id){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("DELETE from cours where id = :id");
        $stm->bindParam(":id",$id,PARAM_STR);
        $resultat = $stm->execute();
        if ($resultat) {
            return 'OK';
        }else {
            return 'NOK';
        }
    }
}
?>