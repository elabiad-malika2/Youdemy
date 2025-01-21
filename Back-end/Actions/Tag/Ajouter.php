<?php
require_once("../../Classes/Tag.php");
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $tags=$_POST['tags'];
    foreach ($tags as $tag) {
        $tagTitle=trim(htmlspecialchars($tag));
        $tagT=new Tag(null,$tagTitle);
        $resultat=$tagT->add();
        if ($resultat) {
            header('Location: ../../../Front-end/admin/index.php');
        }else {
            echo "Failed to add tags";
        }

    }
}else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']))
{
    $id = trim(htmlspecialchars($_GET['id']));
    Tag::supprimer($id);
    header('Location: ../../../Front-end/admin/index.php');
}
?>