<?php
require_once("./Back-end/Classes/User.php");
require_once("./Back-end/Classes/Admin.php");
require_once("./Back-end/Classes/Enseignant.php");
require_once("./Back-end/Classes/Etudiant.php");
$etudiant=User::login("sara123@gmail.com","sara123");
if ($etudiant) {
    print_r( $_SESSION["user"]);
}
else {
    echo "introuvable";
}

?>