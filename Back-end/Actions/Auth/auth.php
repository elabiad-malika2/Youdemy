<?php
require_once __DIR__.'/../../Classes/Enseignant.php';
require_once __DIR__.'/../../Classes/User.php';
require_once __DIR__.'/../../Classes/Etudiant.php';
require_once __DIR__.'/../../Classes/Admin.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nameLogin'])) {
        $email = trim(htmlspecialchars($_POST['nameLogin']));
        $password = trim(htmlspecialchars($_POST['passwordLogin']));
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email format";
            $_SESSION['message_type'] = "error";
            exit;
        }
    
        $user = User::login($email, $password);
        if ($user === false) {
            $_SESSION['message'] = "Invalid email or password";
            $_SESSION['message_type'] = "error";
            echo "Invalid";
        } else {
            $role = $user->getRole();
    
            if ($role === 'etudiant') {
                if ($user->getBanned()) {
                    $_SESSION['message'] = "This User is banned";
                    $_SESSION['message_type'] = "error";
                    User::logout();
                    header('Location: ../../../Front-end/login.php');
                } else {
                    $_SESSION['message'] = "Welcome back " . $user->getNom();
                    $_SESSION['message_type'] = "success";
                    header('Location: ../../../Front-end/index.php');
                }
            } else if ($role === 'enseignant') {
                
                if ($user->getBanned()) {
                    $_SESSION['message'] = "This User is banned";
                    $_SESSION['message_type'] = "error";
                    User::logout();
                    header('Location: ../../../Front-end/login.php');

                } else {
                    $res = $user->isActive();
                    if ($res) {
                        $_SESSION['message'] = "Welcome back " . $user->getNom();
                        $_SESSION['message_type'] = "success";
                        header('Location: ../../../Front-end/Enseignant/cours.php');
                    } else {
                        $_SESSION['message'] = "Compte pas encore activé";
                        $_SESSION['message_type'] = "error";
                        User::logout();
                        header('Location: ../../../Front-end/login.php');
                        
                    }
                }
            } else if ($role === 'admin') {
              
                    $_SESSION['message'] = "Welcome back " . $user->getNom();
                    $_SESSION['message_type'] = "success";
                    header('Location: ../../../Front-end/admin/index.php');
                
            }
        }
        exit;
    }else if (isset($_POST['nameSignup'])) {
        $email = trim(htmlspecialchars($_POST['emailSignup']));
        $password = trim(htmlspecialchars($_POST['passwordSignup']));
        $fullName = trim(htmlspecialchars($_POST['nameSignup']));
        $role = trim(htmlspecialchars($_POST['role']));

        if ($role === 'etudiant') {
            $res = Etudiant::signup($fullName, $email, $password, $role);
        } else if ($role === 'enseignant') {
            $res = Enseignant::signup($fullName, $email, $password, $role, 0);
        } else {
            $_SESSION['message'] = "Invalid role selected";
            $_SESSION['message_type'] = "error";
            header('Location: ../../../Front-end/index.php');
            exit;
        }

        if ($res) {
            $_SESSION['message_type'] = "success";
            $_SESSION['message'] = "Signup successful! Please log in.";
            header('Location: ../../../Front-end/login.php');
        } else {
            $_SESSION['message_type'] = "error";
            $_SESSION['message'] = "Email already exists";
            header('Location: ../../../Front-end/login.php');
        }
        exit;

    } else {
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }
} else if ($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['logout']))
{   
    User::logout();
    header('Location: ../../../Front-end/login.php');
}else {
    echo "Invalid request method";
}
?>