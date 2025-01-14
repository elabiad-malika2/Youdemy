<?php
require_once("connection.php");
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

    public function getId(){
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
    public static function login($email,$password){
        $user = self::findByEmail($email);

        if (!$user || !password_verify($password,$user['password'])) {
            throw new Exception("Invalid email or password");
        }else {
            if ($user['role'] == 'enseignant') {
                $_SESSION['user'] =  new Enseignant($user['id'], $user['fullName'], $user['role'], $user['active'],$user['banned'],$user['active']);
            } elseif ($user['role'] == 'etudiant') {
                
                $etd = new Etudiant($user['id'], $user['fullName'],$user['email'],null, $user['role'],$user['banned']);
                echo $etd->getId();
                $_SESSION['user'] = $etd;
            }elseif ($user['role'] == 'admin'){
                $_SESSION['user'] =  new Admin($user['id'], $user['fullName'], $user['role']);
            }
            return true;
        }
        

    }
    public function __tostring()
    {
        return  'id : '. $this->id.' '.'nom :'. $this->nom.' ' .'role : '.$this->role; 
    }
    public function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        session_destroy();
        return true ;
    }


    }

?>