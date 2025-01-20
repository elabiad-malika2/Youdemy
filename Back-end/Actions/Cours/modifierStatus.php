<?php
require_once("../../Classes/Cours.php");
if ($_SERVER['REQUEST_METHOD']=='GET') {
    if (isset($_GET['idC'])) {
        $idC=(int)$_GET['idC'];
        $updateCours = Cours::modifierStatus($idC);
        if ($updateCours) {
            header('Location: ../../../Front-end/admin/cours.php');
        }else {
            echo "erreur lors de modification";
        }
    }elseif (isset($_GET['idR'])) {
        $idR=(int)$_GET['idR'];
        $updateCours = Cours::modifierStatusR($idR);
        if ($updateCours) {
            header('Location: ../../../Front-end/admin/cours.php');
        }else {
            echo "erreur lors de modification";
        }
    }
    
}
?>