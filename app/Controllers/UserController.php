<?php
namespace App\Controllers;
use App\Models\AppUser;

class UserController extends CoreController
{
    public function login()
    {
        // dump("login");
        $this->show("user/login");
    }

    public function login_post()
    {
        $email    = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        // $password = filter_input(INPUT_POST, "password");
        $password = $_POST["password"];
        // dump($_POST);

        $errorList = [];
        if($email === false || $email === null){
            $errorList[] = "Adresse e-mail innvalide !";
        }
        if(strlen($password) < 4){
            $errorList[]= "Le mot de passe doit faire au moins 4 caractères.";
        }

        if(empty($errorList)){
            $userWithThatEmail = AppUser::findByEmail($email);
            if($userWithThatEmail === false ){
                //on ne précise pas que c'est l'email ou le password est incorrect
                $errorList[] = "Identifiants incorrects";
            } else {
                // if($password === $userWithThatEmail->getPassword()){
                if(password_verify($password, $userWithThatEmail->getPassword())){
                    echo "Connecté !";
                    
                    $_SESSION["user"] = $userWithThatEmail;
                    // var_dump($_SESSION);
                    header("Location: /");
                    exit;
                } else {
                    $errorList[]= "Identifiants incorrects";
                }
            }
        }

        foreach ($errorList as $error){
            echo $error . "<br>";
        }
    }

    public function logout()
    {
        unset($_SESSION["user"]);
        header("Location: /login");
        exit;
    }

    public function list()
    {
        $this->checkAuthorization(["admin"]);
        // récupérer la list des users
        $allUsers = AppUser::findAll();
        $this->show("user/list", [
            "users" => $allUsers
        ]);
    }
    public function add()
    {
        $this->checkAuthorization(["admin"]);
        $this->show("user/add");
    }
    public function create()
    {
        $this->checkAuthorization(["admin"]);
        $errorList = [];

        
    }
}