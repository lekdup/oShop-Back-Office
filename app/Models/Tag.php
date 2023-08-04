<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Tag extends CoreModel
{

    /**
     * @var string
     */
    private $name;

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
     * Méthode permettant de récupérer un enregistrement de la table tag en fonction d'un id donné
     *
     * @param int $tagId ID de la catégorie
     * @return tag
     */
    static public function find($tagId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `tag` WHERE `id` =' . $tagId;

        // exécuter notre requête
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":id", $tagId, PDO::PARAM_INT);

        $pdoStatement->execute();

        // un seul résultat => fetchObject
        $tag = $pdoStatement->fetchObject( self::class );

        // retourner le résultat
        return $tag;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table tag
     *
     * @return tag[]
     */
    static public function findAll()
    {
        $pdo            = Database::getPDO();
        $sql            = 'SELECT * FROM `tag`';
        $pdoStatement   = $pdo->query($sql);
        $results        = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }


    /**
     * Méthode permettant de récupérer tous les enregistrements de la table tag
     *
     * @return tag[]
     */
    static public function findAllForProduct($productID)
    {
        $pdo            = Database::getPDO();
        $sql            = 'SELECT * FROM `product_has_tag` WHERE `product_id` = :product_id';
        $pdoStatement   = $pdo->prepare($sql);
        $pdoStatement->execute([":product_id" => $productID]);
        $product_tag_links = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        $results = [];
        
        foreach($product_tag_links as $link)
        {
            $results[] = Tag::find($link["tag_id"]);
        }
        // dd($results);

        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
            INSERT INTO `tag` (name)
            VALUES (:name)
        ";
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":name", $this->name, PDO::PARAM_STR);

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
        $sql = "UPDATE `tag` SET 
                `name`          = :name,
                `updated_at`    = NOW()
                WHERE `id` = :id
        ";
        $pdoStatement = $pdo->prepare($sql);

        $pdoStatement->bindValue(":name", $this->name, PDO::PARAM_STR);
        $pdoStatement->bindValue(":id",   $this->id,   PDO::PARAM_INT);

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

        $sql = "DELETE FROM `tag`
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
