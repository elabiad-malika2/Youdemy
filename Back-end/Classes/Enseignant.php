<?php
require_once('User.php');
require_once('connection.php');


class Enseignant extends User {
    private $active;
    private $banned;

    public function __construct($id=null,$nom,$email,$password,$role="enseignant",$active=false,$banned=false){
        parent::__construct($id,$nom,$email,$password,$role,$banned);
        $this->active=$active;
        $this->banned=$banned;
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
    public  function isActive(){
        return $this->active;

    }
    public  function getBanned(){
        return $this->banned;

    }
    public static function afficherTeacher(){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT * from user where role = 'enseignant' and active = 0");
        $stm->execute();
        $resultat=$stm->fetchAll(PDO::FETCH_ASSOC);
        $data=[];
        foreach ($resultat as $value) {
            $data[]=new Enseignant($value['id'],$value['fullName'],$value['email'],$value['password'],$value['role'],$value['active'],$value['banned']);
        }
        return $data ;
    }
}


?>