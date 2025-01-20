<?php
require_once("../../Classes/Admin.php");

if ($_SERVER['REQUEST_METHOD']=="GET") {
    if (isset($_GET['idU'])) {
        $id=(int)$_GET['idU'];
        $unbun=Admin::bun($id);
        if ($unbun) {
            header('Location: ../../../Front-end/admin/users.php');
        }
    }elseif (isset($_GET['idB'])) {
        $idB=(int)$_GET['idB'];
        $unbun=Admin::Unbun($idB);
        if ($unbun) {
            header('Location: ../../../Front-end/admin/users.php');
        }
    }
}

?>