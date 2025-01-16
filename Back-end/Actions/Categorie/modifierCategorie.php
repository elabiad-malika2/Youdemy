<?php
require_once('../../Classes/Categorie.php');

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $id=$_POST['idEdit'];
    $titre=trim(htmlspecialchars($_POST['titreEdit']));
    $description=trim(htmlspecialchars($_POST['descriptionEdit']));
    $categorie = new Categorie($id,$titre,$description);
    $resultat=$categorie->modifierCategorie();
    if ($resultat) {
        header('Location: ../../../Front-end/admin/cours.php');
    }else {
        echo "erreur";
    }
}
?>