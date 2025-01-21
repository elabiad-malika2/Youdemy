<?php
require_once("../../Classes/Admin.php");
if ($_SERVER['REQUEST_METHOD']=="GET") {
    echo"kkkkkkkkkk";

    if (isset($_GET['id'])) {
        $id=(int)$_GET['id'];
        $active=Admin::supprimer($id);
        if ($active) {
            header('Location: ../../../Front-end/admin/teacher.php');
        }
    }
}

?>