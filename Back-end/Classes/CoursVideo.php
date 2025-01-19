<?php
require_once 'Connection.php';
require_once 'Cours.php';
class coursVideo extends Cours{
    private $video_url;

    public function __construct($id = null, $titre = null, $description = null, $id_categorie = null, $image = null,$enseignant_id = null, $video_url = null,$type=null) {
        parent::__construct($id,$titre,$description,$id_categorie,$image,$enseignant_id,$type);
        $this->video_url = $video_url;
    }
    public  function ajouter(){
        $type = 'video';
        $this->setType($type);
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO Cours (titre, description, categorie_id, image, video_url,contenu_type,enseignant_id) VALUES (:titre, :description, :id_categorie, :image, :video_url,:type,:enseignant_id)");

        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id_categorie', $this->categorie_id);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':enseignant_id', $this->enseignant_id);
        $stmt->bindParam(':video_url', $this->video_url);
        $stmt->bindParam(':type', $this->type);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
        
    }
    
    public function mettreAJour() {
        $sql = "UPDATE cours SET titre = :titre, description = :description, categorie_id = :categorie_id, 
                enseignant_id = :enseignant_id, video_url = :video_url WHERE id = :id";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([
            'titre' => $this->titre,
            'description' => $this->description,
            'categorie_id' => $this->categorie_id,
            'enseignant_id' => $this->enseignant_id,
            'video_url' => $this->video_url,
            'id' => $this->id
        ]);
    }

    public function afficherCours() {
        echo "<div class='space-y-6'>
                                <div class='aspect-video bg-gray-100 rounded-lg overflow-hidden'>
                                    <video controls class='w-full h-full object-cover'>
                                        <source src='./../".$this->video_url."' type='video/mp4'>
                                        Votre navigateur ne supporte pas la lecture vidéo.
                                    </video>
                                </div>
                                
                                <div class='space-y-4'>
                                    <h3 class='text-xl font-bold text-gray-800'>Chapitres vidéo</h3>
                                    <div class='bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer'>
                                        <div class='flex items-center justify-between'>
                                            <div class='flex items-center gap-3'>
                                                <i class='ri-play-circle-line text-blue-500 text-xl'></i>
                                                <span class='font-medium'>1. Introduction</span>
                                            </div>
                                            <span class='text-gray-500'>15:30</span>
                                        </div>
                                    </div>
                                    <div class='bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors cursor-pointer'>
                                        <div class='flex items-center justify-between'>
                                            <div class='flex items-center gap-3'>
                                                <i class='ri-play-circle-line text-blue-500 text-xl'></i>
                                                <span class='font-medium'>2. Pour commencer</span>
                                            </div>
                                            <span class='text-gray-500'>20:45</span>
                                        </div>
                                    </div>
                                </div>
                            </div>";
    }
    
    public function getVideo_url() {
        return $this->video_url;
    }
    public function setVideo_url($video_url) {
        return $this->video_url;
    }
}
?>