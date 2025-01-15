<?php
require_once("./Back-end/Classes/User.php");
require_once("./Back-end/Classes/Admin.php");
require_once("./Back-end/Classes/Enseignant.php");
require_once("./Back-end/Classes/Etudiant.php");
require_once("./Back-end/Classes/CoursText.php");
$resultat=CoursText::afficherCoursId(2);
var_dump($resultat);


?>