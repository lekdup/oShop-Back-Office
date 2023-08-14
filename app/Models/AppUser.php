<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel
{
    private $email;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    private $status;

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    static public function find($userId)
    {
        $pdo = Database::getPDO();
        $sql = "SELECT * FROM `app_user` WHERE `id` = :id";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":id", $userId, PDO::PARAM_INT);
        $pdoStatement->execute();
        $user = $pdoStatement->fetchObject(self::class);

        return $user;

    }

    static public function findAll()
    {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM `app_user`");

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO `app_user` (email, password, firstname, lastname, role, status)
                VALUES (:email, :password, :firstname, :lastname, :role, :status)
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":email",      $this->email,       PDO::PARAM_STR);
        $pdoStatement->bindValue(":password",   $this->password,    PDO::PARAM_STR);
        $pdoStatement->bindValue(":firstname",  $this->firstname,   PDO::PARAM_STR);
        $pdoStatement->bindValue(":lastname",   $this->lastname,    PDO::PARAM_STR);
        $pdoStatement->bindValue(":role",       $this->role,        PDO::PARAM_STR);
        $pdoStatement->bindValue(":status",     $this->status,      PDO::PARAM_INT);

        $pdoStatement->execute();

        if($pdoStatement->rowCount() === 1){
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $pdo = Database::getPDO();

        $sql = "UPDATE `app_user` SET
                `email` = :email,
                `password` = :password,
                `firstname` = :firstname,
                `lastname` = :lastname,
                `role` = :role,
                `status` = :status,
                `updated_at` = NOW()
                WHERE `id` = :id
        ";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":email",      $this->email,       PDO::PARAM_STR);
        $pdoStatement->bindValue(":password",   $this->password,    PDO::PARAM_STR);
        $pdoStatement->bindValue(":firstname",  $this->firstname,   PDO::PARAM_STR);
        $pdoStatement->bindValue(":lastname",   $this->lastname,    PDO::PARAM_STR);
        $pdoStatement->bindValue(":role",       $this->role,        PDO::PARAM_STR);
        $pdoStatement->bindValue(":status",     $this->status,      PDO::PARAM_INT);
        $pdoStatement->bindValue(":id",         $this->id,          PDO::PARAM_INT);

        $pdoStatement->execute();

        return $pdoStatement->rowCount() === 1;
    }

    public function save()
    {
        if($this->id){
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "DELETE FROM `app_user`
                WHERE `id` = :id";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            "id" => $this->id
        ]);

        return $pdoStatement->rowCount() === 1;
    }

    static public function findByEmail($email)
    {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->prepare("SELECT * FROM `app_user` WHERE `email` = :email");

        $pdoStatement->execute([
            ":email" => $email
        ]);

        return $pdoStatement->fetchObject(self::class);
    }

    public function isAdmin()
    {
        return $this->role === "admin";
    }
}