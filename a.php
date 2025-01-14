<?php
require_once '../config/database.php';
require_once '../Model/Continent.php';


class ContinentController{
    private $pdo;

    public function __construct(){
        $this->pdo = new GestionBaseDeDonnees();
    }

    public function create(Continent $continent ){
        $query = "INSERT INTO Continent(nom,image,nombrePays) VALUES (?,?,?)";
        $params = [$continent->getNom() , $continent->getImage(),$continent->getNombrePays()];
        return  $this->pdo->execute($query, $params);
    }

    public function readAll(){
        $query = "SELECT * FROM Continent";
        return  $this->pdo->select($query);
    }

    public function update(Continent $continent){
        $query = "UPDATE Continent set nom = ? ,image = ? ,nombrePays = ? WHERE id_continent = ?";
        $params = [$continent->getNom() , $continent->getImage(),$continent->getNombrePays() ,$continent->getId()];
        return  $this->pdo->execute($query, $params);
    }

    public function deleteById($id){
        $query = "DELETE FROM  Continent  WHERE id_continent = ?";
        $params = [$id];
        return  $this->pdo->execute($query, $params);
    }
    public function getElementById($id){
        $query = "SELECT * FROM continent WHERE id_continent = ? ";
        $params = [$id];
        return  $this->pdo->select($query , $params);
    }


}