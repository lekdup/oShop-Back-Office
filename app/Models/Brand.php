<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Brand extends CoreModel
{
    private $name;

    public static function find($brandId)
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM brand
            WHERE id = ' . $brandId;
        $pdoStatement = $pdo->query($sql);
        $brand = $pdoStatement->fetchObject('App\Models\Brand');

        // retourner le résultat
        return $brand;
    }

    public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `brand`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Brand');

        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();
        $sql = "
            INSERT INTO `brand` (name)
            VALUES ('{$this->name}')
        ";
        $insertedRows = $pdo->exec($sql);

        // Si au moins une ligne ajoutée
        if ($insertedRows > 0) {
            // Alors je récupère l'id auto-incrémenté généré par MySQL
            $this->id = $pdo->lastInsertId();

            // je retourne VRAI car l'ajout a parfaitement fonctionné
            return true;
        }
        return false;
    }

    public function update()
    {
        $pdo = Database::getPDO();
        $sql = "
            UPDATE `brand`
            SET
                name = '{$this->name}',
                updated_at = NOW()
            WHERE id = {$this->id}
        ";
        $updatedRows = $pdo->exec($sql);
        return ($updatedRows > 0);
    }

    public function save() {
        if ($this->id){
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    public function delete() {
        $pdo = Database::getpdo();
        $pdoStatement = $pdo->prepare("DELETE FROM `brand` WHERE `id` = :id");
        $pdoStatement->execute([
            "id" => $this->id
        ]);

        return $pdoStatement->rowCount() === 1;
    }

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
}
