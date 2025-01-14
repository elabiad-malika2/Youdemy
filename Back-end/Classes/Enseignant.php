<?php
require_once('User.php');
require_once('connection.php');


class Enseignant extends User {
    private $banned;
    private $active;

    public function __construct($id=null,$nom,$email,$password,$role="enseignant",$active=false){
        parent::__construct($id=null,$nom,$email,$password,$role);
        $this->active=$active;
    }
    private function save(){
        $db = Database::getInstance()->getConnection();
        $stm=$db->prepare("INSERT INTO user (fullName,email,password,role,active) values (:fullName,:email,:paswword,:role,:active)");
        $stm->bindParam(":fullName",$this->nom,PDO::PARAM_STR);
        $stm->bindParam(":email",$this->email,PDO::PARAM_STR);
        $stm->bindParam(":paswword",$this->password,PDO::PARAM_STR);
        $stm->bindParam(":role",$this->role,PDO::PARAM_STR);
        $stm->bindParam(":active",$this->active,PDO::PARAM_BOOL);
        $stm->execute();

    }
    private function setPasswordHash($password){
        $this->password=password_hash($password,PASSWORD_DEFAULT);
    }
    public static function signup($nom,$email,$password){
        // if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        //     throw new Exception("Invalid email format");
        // }
        if (strlen($password)<6) {
            throw new Exception("Password must be at least 6 characters long");
        }
        $nom=htmlspecialchars($nom);

        if (self::findByEmail($email)) {
            throw new Exception("Email is already exist");
            
        }
        $user = new Enseignant(null,$nom,$email,$password);
        $user->setPasswordHash($password);
        return $user->save();
    }
}


?>