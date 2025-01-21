<?php
require_once '../../Classes/Cours.php';
require_once '../../Classes/Inscription.php';


if (isset($_GET['id'])) {
    $id = (int)($_GET['id']);
    $tag=Cours::deleteTagCours($id);
    $inscis=Inscription::deleteInscriptionCours($id);
    $cours=Cours::supprimer($id);



    if ($cours) {
        header("Location: ../../../Front-end/Enseignant/Cours.php");
    }
    
    




}