<?php
require_once('User.php');
require_once('connection.php');


class Etudiant extends User {
    private $banned;

    public function __construct($id,$nom,$email,$password,$role="etudiant",$banned=false){
        parent::__construct($id,$nom,$email,$password,$role,$banned);
        $this->banned=$banned;
    }
    private function save(){
        $db = Database::getInstance()->getConnection();
        $stm=$db->prepare("INSERT INTO user (fullname,email,password,role) values (:nom,:email,:paswword,:role)");
        $stm->bindParam(":nom",$this->nom,PDO::PARAM_STR);
        $stm->bindParam(":email",$this->email,PDO::PARAM_STR);
        $stm->bindParam(":paswword",$this->password,PDO::PARAM_STR);
        $stm->bindParam(":role",$this->role,PDO::PARAM_STR);
        $stm->execute();

    }
    private function setPasswordHash($password){
        $this->password=password_hash($password,PASSWORD_BCRYPT);
    }
    public static function signup($nom,$email,$password){
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        if (strlen($password)<6) {
            throw new Exception("Password must be at least 6 characters long");
        }
        $nom=htmlspecialchars($nom);

        if (self::findByEmail($email)) {
            throw new Exception("Email is already exist");
            
        }
        $user = new Etudiant(null,$nom,$email,$password);
        $user->setPasswordHash($password);
        return $user->save();
    }

    public  function isBanned(){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT banned from user where id = :id");
        $stm->bindParam(":id",$this->id,PDO::PARAM_INT);
        $stm->execute();
        $resultat=$stm->fetch(PDO::FETCH_ASSOC);
        return $resultat['banned'];
    }
}


?>