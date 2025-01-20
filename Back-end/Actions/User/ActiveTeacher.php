<?php
require_once("../../Classes/Admin.php");
if ($_SERVER['REQUEST_METHOD']=="GET") {
    if (isset($_GET['idT'])) {
        $id=(int)$_GET['idT'];
        $active=Admin::Active($id);
        if ($active) {
            header('Location: ../../../Front-end/admin/teacher.php');
        }
    }
}

?>