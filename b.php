<?php

class Vehicule {
    private $marque;
    private $modele;

    public function __construct($marque, $modele) {
        $this->marque = $marque;
        $this->modele = $modele;
    }

    public function getMarque() {
        return $this->marque;
    }

    public function setMarque($marque) {
        $this->marque = $marque;
    }

    public function getModele() {
        return $this->modele;
    }

    public function setModele($modele) {
        $this->modele = $modele;
    }

    public static function afficherInfoStatique() {
        echo "Méthode statique de la classe Vehicule.";
    }
}
?>
<?php
class Moto extends Vehicule {
    private $type;

    public function __construct($marque, $modele, $type) {
        parent::__construct($marque, $modele);
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    

    public static function afficherInfoStatique() {
        echo "Méthode statiquede la classe Moto.";
    }
}
?>
<?php

$vehicule = new Vehicule("Toyota", "Corolla");
$vehicule->setMarque("Honda");
$vehicule->setModele("Civic");

echo "Véhicule Marque: " . $vehicule->getMarque() ;
echo "Véhicule Modèle: " . $vehicule->getModele() ;

$moto = new Moto("Yamaha", "YZF-R1", "Sport");
$moto->afficherDetails();

Vehicule::afficherInfoStatique();
Moto::afficherInfoStatique();

?>
