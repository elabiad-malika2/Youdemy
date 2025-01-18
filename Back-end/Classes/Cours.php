<?php
require_once 'Connection.php';
require_once 'CoursText.php';
require_once 'CoursVideo.php';


abstract class Cours  {
    protected $id;
    protected $titre;
    protected $description;
    protected $categorie_id;
    protected $type;
    protected $enseignant_id;

    public function __construct($id = null, $titre = null, $description = null, $categorie_id = null, $image = null,$enseignant_id=null,$type=null) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->categorie_id = $categorie_id;
        $this->image = $image;
        $this->enseignant_id = $enseignant_id;
        $this->type = $type;
    }

    abstract public function ajouter() ;
    abstract public function afficherCours();
    abstract public function mettreAJour();



    public static function afficherTous(){

            $pdo = Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT * FROM Cours ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $cours = [];
            foreach ($result as $row) {
                if($row['contenu_type'] == 'video')
                {
                    $cours[] = new coursVideo($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image'], $row['video_url'],$row['contenu_type']);
                } else 
                {
                    $cours[] = new coursTexte($row['id'], $row['titre'], $row['description'], $row['categorie_id'], $row['image'], $row['contenu'],$row['contenu_type']);

                }
            }
            return $cours;
        
   }

    public function modifier() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE Cours SET titre = :titre, description = :description, categorie_id = :categorie_id, image = :image, contenue = :contenue, type = :type WHERE id = :id");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':categorie_id', $this->id_categorie);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':contenue', $this->contenue);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function supprimer($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("DELETE FROM Cours WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $res = $stmt->execute();
            if ($res) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return "Error Deleting Course: " . $e->getMessage();
        }
    }

    public function addEtudiant($etudiant_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO etudiant_cours (cours_id, etudiant_id) VALUES (:cours_id, :etudiant_id)");
        $stmt->bindParam(':cours_id', $this->id);
        $stmt->bindParam(':etudiant_id', $etudiant_id);

        return $stmt->execute();
    }

    public function addTagCours($tag_id) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO cours_tag (cours_id, tag_id) VALUES (:cours_id, :tag_id)");
        $stmt->bindParam(':cours_id', $this->id);
        $stmt->bindParam(':tag_id', $tag_id);

        return $stmt->execute();
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

    public function getImagePath() {
        return $this->image;
    }

    public function setImagePath($image) {
        $this->image = $image;
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
}
?>