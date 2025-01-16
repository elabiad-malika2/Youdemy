<?php
require_once('../../Classes/Categorie.php');
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $titre=trim(htmlspecialchars($_POST['category_name']));
    $description=trim(htmlspecialchars($_POST['category_description']));
    $categorie= new Categorie(null,$titre,$description);
    $resultat = $categorie->ajouterCategorie();
    if ($resultat) {
        header('Location: ../../../Front-end/admin/cours.php');
    }
}

?>