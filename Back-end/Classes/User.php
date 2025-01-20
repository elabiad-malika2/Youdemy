<?php
require_once("connection.php");
require_once "Enseignant.php";
require_once("Etudiant.php");
session_start();
class User {
    protected $id ;
    protected $nom ;
    protected $email ;
    protected $password ;
    protected $role ;

    public function __construct($id,$nom,$email,$password,$role){
        $this->id=$id ;
        $this->nom=$nom ;
        $this->email=$email ;
        $this->password=$password ;
        $this->role=$role ;
    }

    public  function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getRole(){
        return $this->role;
    }



    public function setNom($nom){
        $this->nom=$nom;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function setPassword($password){
        $this->password=$password;
    }
    public function setRole($role){
        $this->role=$role;
    }

    public static function findByEmail($email){
        $db = Database::getInstance()->getConnection();
        $stm = $db->prepare("SELECT * from user where email=:email");
        $stm->bindParam(':email',$email,PDO::PARAM_STR);
        $stm->execute();
        $result=$stm->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        }
        return null ;
    } 
    public static function login($email, $password) {
        $user = self::findByEmail($email);
    
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        } else {
            if ($user['role'] == 'enseignant') {

                $enseignant = new Enseignant($user['id'], $user['fullName'], $user['email'],null,$user['role'], $user['active'], $user['banned']);
                $_SESSION['id_logged'] = $enseignant->getId();
                $_SESSION['role'] = $enseignant->getRole();
                return $enseignant;
            } elseif ($user['role'] == 'etudiant') {
                $etudiant = new Etudiant($user['id'], $user['fullName'], $user['email'], null, $user['role'], $user['banned']);
                $_SESSION['id_logged'] = $etudiant->getId();                
                $_SESSION['role'] = $etudiant->getRole();
                return $etudiant;
            } elseif ($user['role'] == 'admin') {
                $admin = new Admin($user['id'], $user['fullName'], $user['role']);
                $_SESSION['id_logged'] = $admin->getId();
                $_SESSION['role'] = $admin->getRole();
                return $admin;
            }
        }
    }
    
    
    public function __tostring()
    {
        return  'id : '. $this->id.' '.'nom :'. $this->nom.' ' .'role : '.$this->role; 
    }
    public static function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        session_destroy();
        return true ;
    }
    public static function afficherUsers(){
        $pdo=Database::getInstance()->getConnection();
        $stm=$pdo->prepare("SELECT * from user where role != 'admin'");
        $stm->execute();
        $resultat = $stm->fetchAll(PDO::FETCH_ASSOC);
        $userL = [];
    
        foreach($resultat as $res) {
            if($res['role'] == 'etudiant') {
                $userL[] = new Etudiant(
                    $res['id'], 
                    $res['fullName'], 
                    $res['email'], 
                    $res['password'], 
                    $res['role'], 
                    $res['banned']
                );
            } else if($res['role'] == 'enseignant') {

                $userL[] = new Enseignant(
                    $res['id'], 
                    $res['fullName'], 
                    $res['email'], 
                    $res['password'], 
                    $res['role'], 
                    $res['active'],
                    $res['banned'] 
                );
            } 
        }
        return $userL ;
    }


    }

?>