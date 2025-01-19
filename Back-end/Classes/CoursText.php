
<?php
require_once 'Cours.php';
require_once 'Connection.php';
class coursTexte extends Cours{
    private $contenue;


    public function __construct($id = null, $titre, $description = null, $id_categorie = null, $image = null,$enseignant_id=null, $contenue = null,$type=null) {
        parent::__construct($id,$titre,$description,$id_categorie,$image,$enseignant_id,$type);
        $this->contenue = $contenue;
    }
    public  function ajouter(){
        $type = 'texte';
        $this->setType($type);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Cours (titre, description, categorie_id, image, contenu,contenu_type,enseignant_id) VALUES (:titre, :description, :id_categorie, :image, :contenue,:type,:enseignant_id)");
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id_categorie', $this->categorie_id,PDO::PARAM_INT);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':enseignant_id', $this->enseignant_id,PDO::PARAM_INT);
        $stmt->bindParam(':contenue', $this->contenue);
        $stmt->bindParam(':type', $this->type);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
        
    }
    
    public function mettreAJour() {
        $stmt = self::$pdo->prepare("UPDATE cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                enseignant_id = :enseignant_id, contenu = :contenu WHERE id = :id");
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'contenu' => $this->contenu,
            'id' => $this->id
        ]);
    }
    public function afficherCours() {
        echo "<div class=''>
                            <div class='space-y-6'>
                                <div class='border-b pb-4'>
                                    <h3 class='text-xl font-bold mb-3 text-gray-800 p-4'>Chapitre 1 : Pour commencer</h3>
                                    <p class='text-gray-600 p-4 mb-4'>Introduction au cours et concepts de base.</p>
                                    <div class='pl-4 text-gray-600 border-l-4 border-blue-100'>
                                        ".$this->contenue."
                                    </div>
                                </div>
                            </div>
                        </div>";
    }

    
    public function getContenue() {
        return $this->contenue;
    }
    
    public function setContenue($contenue) {
        return $this->contenue;
    }
}
?>
