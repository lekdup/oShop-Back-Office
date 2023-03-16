<?php
namespace App\Controllers;
use App\Controllers\CoreController;
use App\Models\AppUser;

class LoginController extends CoreController
{
    public function login()
    {
        $this->show("connection/login");
    }

    public function connection()
    {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password");
        dump($_POST);

        $errorList = [];
        if(empty($email)){
            $errorList[] = "You have to put an email address!";
        }
        if(empty($password)){
            $errorList[]= "You have to put a password";
        }

        if(empty($errorList)){
            $appUser = AppUser::findByEmail($email);
        }
    }
}