<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     */
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     *
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
    static public function find($categoryId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `category` WHERE `id` =' . $categoryId;

        // exécuter notre requête
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":id", $categoryId, PDO::PARAM_INT);

        $pdoStatement->execute();

        // un seul résultat => fetchObject
        $category = $pdoStatement->fetchObject( self::class );

        // retourner le résultat
        return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     *
     * @return Category[]
     */
    static public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }

    /**
     * Récupérer les 5 catégories mises en avant sur la home
     *
     * @return Category[]
     */
    public function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            WHERE home_order > 0
            ORDER BY home_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $categories;
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
            INSERT INTO `category` (name, subtitle, picture, home_order)
            VALUES (:name, :subtitle, :picture, :home_order)
        ";
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":name",       $this->name,        PDO::PARAM_STR);
        $pdoStatement->bindValue(":subtitle",   $this->subtitle,    PDO::PARAM_STR);
        $pdoStatement->bindValue(":picture",    $this->picture,     PDO::PARAM_STR);
        $pdoStatement->bindValue(":home_order", $this->home_order,  PDO::PARAM_INT);

        $pdoStatement->execute();
        if($pdoStatement->rowCount() === 1){
            $this->id = $pdo->lastInsertId();
            return true;
        }

        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();
        $sql = "UPDATE `category` SET 
                `name`          = :name, 
                `subtitle`      = :subtitle,
                `picture`       = :picture,
                `home_order`    = :home_order,
                `updated_at`    = NOW()
                WHERE `id` = :id
        ";
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":name",       $this->name,        PDO::PARAM_STR);
        $pdoStatement->bindValue(":subtitle",   $this->subtitle,    PDO::PARAM_STR);
        $pdoStatement->bindValue(":picture",    $this->picture,     PDO::PARAM_STR);
        $pdoStatement->bindValue(":home_order", $this->home_order,  PDO::PARAM_INT);
        $pdoStatement->bindValue(":id",         $this->id,          PDO::PARAM_INT);

        $pdoStatement->execute();

        if($pdoStatement->rowCount() === 1){
            return true;
        }
        return false;
    }

    public function save()
    {
        if($this->id){
            return $this->update();
        }else {
            return $this->insert();
        }
    }

    public function delete()
    {
        $pdo = Database::getPDO();

        $sql = "DELETE FROM `category`
                WHERE `id` = :id";

        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->execute([
            //version alternative à bindValue() + execute()
            "id" => $this->id
        ]);


        if($pdoStatement->rowCount() === 1){
            return true;
        } else {
            return false;
        }

        return $pdoStatement->rowCount() === 1;
    }
}
