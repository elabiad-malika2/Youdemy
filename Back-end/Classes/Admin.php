<?php
require_once('User.php');
require_once('connection.php');
class Admin extends User{
    public function __construct($id=null,$nom,$email,$password,$role="admin"){
        parent::__construct($id,$nom,$email,$password,$role);
    }
    public static function bun($id){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("UPDATE user set banned = 0 where id = :id");
        $stm->bindParam(':id',$id,PDO::PARAM_INT);
        $resultat=$stm->execute();
        if ($resultat) {
            return true;
        }else {
            false;
        }
    }
    public static function Unbun($id){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("UPDATE user set banned = 1 where id = :id");
        $stm->bindParam(':id',$id,PDO::PARAM_INT);
        $resultat=$stm->execute();
        if ($resultat) {
            return true;
        }else {
            false;
        }
    }
    
}

?>