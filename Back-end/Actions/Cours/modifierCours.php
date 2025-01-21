<?php
require_once("../../Classes/CoursText.php");
require_once("../../Classes/CoursVideo.php");
require_once("../../Classes/Cours.php");
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $id=$_POST['idCours'];
    $titre=$_POST['titre'];
    $description=$_POST['description'];
    $categorie=$_POST['categorie'];
    $tags=$_POST['tags'];

    $cours=Cours::afficherCoursId($id);
    $cours->setTitre($titre);
    $cours->setDescription($description);
    $cours->setIdCategorie($categorie);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageUrl = '/uploads/images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../../../Front-end' . $imageUrl);
        $cours->setImage($imageUrl);
    }
    
    if ($cours->getType()=='texte') {
        $contenu=$_POST['contenu'];
        $cours->setContenue($contenu);
    }else {
        if(isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
            $videoUrl='/uploads/videos/' . basename($_FILES['video']['name']);
            move_uploaded_file($_FILES['video']['tmp_name'], __DIR__ . '/../../../Front-end' . $videoUrl);
            $cours->setVideo_url($videoUrl);
        }
    }
    $resultat=$cours->mettreAJour();
    $cours->deleteTagCours();
    foreach ($tags as $t) {
        $cours->addTagCours($t);
    }var_dump($resultat);
    if ($resultat) {
        header("Location: ../../../Front-end/Enseignant/detailsCours.php?idCours= ".$cours->getId()." ");
    }
    
}

?>