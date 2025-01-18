<?php
require_once("../../Classes/CoursText.php");
require_once("../../Classes/CoursVideo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    session_start();
    $title=$_POST['title'];
    $description=$_POST['description'];
    $idCategorie=$_POST['categorie'];
    $idEnseignant=$_SESSION['id_logged'];
    $type=$_POST['type'];
    $tags=$_POST['tags'];

    $imageUrl=null;
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageUrl = '/uploads/images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../../Front-end' . $imageUrl);
    }
    if($type === 'text') {
        $contenu=$_POST['content'];
        $cours = new coursTexte(null,$title,$description,$idCategorie,$imageUrl,$idEnseignant,$contenu,$type);
    }elseif($type === 'video') {
        $videoUrl=null;
        if(isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
            $videoUrl='/uploads/videos/' . basename($_FILES['video']['name']);
            move_uploaded_file($_FILES['video']['tmp_name'], __DIR__ . '/../../../Front-end') . $videoUrl;
        }

        $cours = new CoursVideo(null,$title,$description,$idCategorie,$image,$idEnseignant,$videoUrl,$type) ;
    }
    $resultat=$cours->ajouter();
    foreach ($tags as $t) {
        $cours->addTagCours($t);
    }
    if($resultat) {
        header('Location: ../../../Front-end/Enseignant/Cours.php');
    }


}
?>