<?php

namespace App\Models;

use App\Utils\Database;
use PDO;


class Type extends CoreModel
{
    private $name;

    public static function find($typeId)
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `type` WHERE `id` =' . $typeId;
        $pdoStatement = $pdo->query($sql);
        $type = $pdoStatement->fetchObject('App\Models\Type');

        // retourner le résultat
        return $type;
    }
    public function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `type`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Type');

        return $results;
    }

    public function insert() {
        $pdo = Database::getPDO();
        $sql = "INSERT INTO `type` (name) VALUES ('{$this->name}')";
        $insertedRows = $pdo->exec($sql);

        if ($insertedRows > 0) {
            $this->id = $pdo->lastInsertId();
            return true;
        }

        return false;
    }

    public function update() {
        $pdo = Database::getPDO();
        $sql = "UPDATE `type` SET name = '{$this->name}', updated_at = NOW() WHERE id = {$this->id}";

        $updatedRows = $pdo->exec($sql);

        return ($updatedRows > 0);
    }

    public function delete() {
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare("DELETE FROM `type` WHERE `id` = :id");
        $pdoStatement->execute([
            "id" => $this->id
        ]);

        return $pdoStatement->rowCount() === 1;
    }

    public function save() {
        if ($this->id) {
            return $this->update();
        } else {
            return $this->insert(); 
        }
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
