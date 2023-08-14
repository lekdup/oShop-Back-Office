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
        // récupérer la list des users
        $allUsers = AppUser::findAll();
        $this->show("user/list", [
            "users" => $allUsers
        ]);
    }
    public function add()
    {
        $this->show("user/add");
    }
    public function create()
    {
        $errorList = [];

        $email      = filter_input(INPUT_POST, "email",     FILTER_VALIDATE_EMAIL);
        $password   = filter_input(INPUT_POST, "password",  FILTER_SANITIZE_STRING);
        $firstname  = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
        $lastname   = filter_input(INPUT_POST, "lastname",  FILTER_SANITIZE_STRING);
        $role       = filter_input(INPUT_POST, "role",      FILTER_SANITIZE_STRING);
        $status     = filter_input(INPUT_POST, "status",    FILTER_VALIDATE_INT);

        if (!$email || !$password || !$firstname || !$lastname || !$role || !$status)
        {
            $errorList[]= "Tous les champs sont obligatoire";
        }

        if(strlen($password) < 5)
        {
            $errorList[] = "le mot de passe doit faire au moins 5 caractères.";
        }

        if(empty($errorList))
        {
            $newUser = new AppUser();

            $newUser->setRole($role);
            $newUser->setEmail($email);
            $newUser->setStatus($status);
            $newUser->setLastname($lastname);
            $newUser->setFirstname($firstname);

            $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
        }  
        if($newUser->save())
        {
            header("Location: ".$this->router->generate("user-list"));
            exit;
        }
        else
        {
            $errorList[] = "Impossible d'ajouter l'utilisateur";
        }

        foreach($errorList as $error)
        {
            echo $error . "<br>";
        }
    }

    public function update($id)
    {
        $userObject = AppUser::find($id);
        $this->show("user/edit",
        [
            "userObject" => $userObject
        ]);
    }

    public function edit($id)
    {
        $email      = filter_input(INPUT_POST, "email",     FILTER_VALIDATE_EMAIL);
        $password   = filter_input(INPUT_POST, "password",  FILTER_SANITIZE_STRING);
        $firstname  = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
        $lastname   = filter_input(INPUT_POST, "lastname",  FILTER_SANITIZE_STRING);
        $role       = filter_input(INPUT_POST, "role",      FILTER_SANITIZE_STRING);
        $status     = filter_input(INPUT_POST, "status",    FILTER_VALIDATE_INT);

        $errorList = [];

        if(!$email || !$password || !$firstname || !$lastname || !$role || !$status)
        {
            $errorList[]= "Tous les champs sont obligatoire !";
        }

        if (strlen($password) < 5)
        {
            $errorList[]= "Le mot de passe doit faire au moins 5 caractères";
        }

        if(empty($errorList))
        {
            $newUser = AppUser::find($id);

            $newUser->setEmail($email);
            $newUser->setFirstname($firstname);
            $newUser->setLastname($lastname);
            $newUser->setRole($role);
            $newUser->setStatus($status);

            $newUser->setPassword(password_hash($password, PASSWORD_DEFAULT));
        }

        if($newUser->save())
        {
            header("Location: /user/list");
            exit;
        }
        else{
            $errorList[]= "Impossible de modifier l'utilisateur !";
        }

        foreach($errorList as $error)
        {
            echo $error. "<br>";
        }
    }
}