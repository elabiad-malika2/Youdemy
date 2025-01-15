<?php
require_once("Connection.php");
class Categorie {
    private $id ;
    private $titre ;
    private $description ;

    public function __construct($id=null,$titre,$description){
        $this->id=$id;
        $this->titre=$titre;
        $this->description=$description;
    }
    
}

?>