<?php
require_once("../../Classes/Cours.php");
if ($_SERVER['REQUEST_METHOD']=='GET') {
    $idC=(int)$_GET['idC'];
    $updateCours = Cours::modifierStatus($idC);
    if ($updateCours) {
        header('Location: ../../../Front-end/admin/cours.php');
    }else {
        echo "erreur lors de modification";
    }
    
}
?>