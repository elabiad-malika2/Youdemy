<?php
require_once 'Connection.php';
require_once 'CoursText.php';
require_once 'CoursVideo.php';
require_once 'Tag.php';


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


    public static function afficherCoursProf($idEnseignant){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT * from cours where enseignant_id = :enseignant_id");
        $stm->bindParam(':enseignant_id',$idEnseignant,PDO::PARAM_INT);
        $stm->execute();
        $resultat=$stm->fetchAll(PDO::FETCH_ASSOC);
        $coursProf=[];
        foreach ($resultat as $c) {
            if($c['contenu_type'] == 'video'){
                $coursProf[] = new coursVideo($c['id'], $c['titre'], $c['description'], $c['categorie_id'], $c['image'], $c['video_url'],$c['contenu_type']);
            }else {
                $coursProf[] = new coursTexte($c['id'], $c['titre'], $c['description'], $c['categorie_id'], $c['image'], $c['contenu'],$c['contenu_type']);

            }        
        }
        return $coursProf;
    }
    public static function afficherCoursId($idCours){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT * from cours where id = :idCours");
        $stm->bindParam(':idCours',$idCours,PDO::PARAM_INT);
        $stm->execute();
        $resultat=$stm->fetch(PDO::FETCH_ASSOC);
        
            if($resultat['contenu_type'] == 'video'){
                return new coursVideo($resultat['id'], $resultat['titre'], $resultat['description'], $resultat['categorie_id'], $resultat['image'], $resultat['enseignant_id'],$resultat['video_url'],$resultat['contenu_type']);
            }else {
                return new coursTexte($resultat['id'], $resultat['titre'], $resultat['description'], $resultat['categorie_id'], $resultat['image'], $resultat['enseignant_id'],$resultat['contenu'],$resultat['contenu_type']);

            }        

        
    }
    public static function afficherTous($search='',$page=1,$limit=6){

            $pdo = Database::getInstance()->getConnection();
            $offset=($page - 1)*$limit;

            $stm = $pdo->prepare("SELECT * FROM Cours where titre LIKE :search or description LIKE :search LIMIT :limit OFFSET :offset");
            $serachT="%$search%";
            $stm->bindParam(':search',$serachT,PDO::PARAM_STR);
            $stm->bindParam(':limit',$limit,PDO::PARAM_INT);
            $stm->bindParam(':offset',$offset,PDO::PARAM_INT);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    
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

    // function pour obtenir le nombre total de cours correspondant à la recherche (pour la pagination)
    public static function afficherTotalsomme($search = '') {
        $pdo = Database::getInstance()->getConnection();
    
        if (empty($search)) {
            $stm = $pdo->query("SELECT count(*) FROM cours");
        } else {
            $stm = $pdo->prepare("SELECT count(*) FROM cours WHERE titre LIKE :search OR description LIKE :search");
            $searchT = "%$search%";
            $stm->bindParam(":search", $searchT, PDO::PARAM_STR);
            $stm->execute();
        }
    
        $resultat = $stm->fetchColumn();
        return $resultat;
    }
    
    // Rejoindre Cours :
    public static function rejoindreCours($idEt,$idC){
        $pdo = Database::getInstance()->getConnection();
        $stm=$pdo->prepare("INSERT into etudiant_cours (cours_id,etudiant_cours) values (:idE,:idC)");
        $stm->bindParam(':idE',$idEt,PDO::PARAM_INT);
        $stm->bindParam(':idC',$idC,PDO::PARAM_INT);
        $resultat=$stm->execute();
        if ($resultat) {
            return true ;
        }else {
            return false ;
        }

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

    public static function coursTags($idC){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT t.*  from cours_tag tc
                            join Tag t on t.id = tc.tag_id
                            join cours c on c.id = tc.cours_id 
                            where c.id= :idC");
        $stm->bindParam(':idC',$idC);
        $stm->execute();
        $resultat = $stm->fetchAll(PDO::FETCH_ASSOC);
        $data=[];
        if ($resultat) {
            foreach ($resultat as $value) {
                $data[]= new Tag($value['id'],$value['titre']);
            }
        }
        return $data ;
        
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