<?php
require_once("../../Classes/Inscription.php");
if ($_SERVER['REQUEST_METHOD']=='GET') {
    session_start();
    $idC=(int)$_GET['idC']; 
    $idEt=$_SESSION['id_logged'];
    var_dump($idC);
    $cours = new Inscription($idEt,$idC);
    $cours->rejoindreCours();
    if ($cours) {
        header("Location: ../../../Front-end/Etudiant/detailsCours.php?idCours=" . $idC);
    }else {
        echo "Vous ne pouvez rejoindre le cours";
    }
    

}

?>