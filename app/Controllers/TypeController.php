<?php 

namespace App\Controllers;

use App\Models\Type;

class TypeController extends CoreController {

    public function list() {
        $typeModel = new Type();
        $allTypes = $typeModel->findAll();

        $this->show("type/list", [
            "allTypes" => $allTypes,
        ]);
    }

    public function add() {
        $this->show("type/add");
    }

    public function create() {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

        $errorList = [];

        if (empty($name)) {
            $errorList[] = "Le nom du type est vide";
        }

        if (empty($errorList)) {
            $type = new Type();
            $type->setName($name);

            if ($type->insert()) {
                header("Location: /type/list");
                exit;
            } else {
                echo "Echec de la sauvegarde en BDD";
            }
        } else {
            foreach ($errorList as $error) {
                echo $error . "<br>";
            }
        }

        $this->show("type/add");
    }

    public function update($id) {
        $typeObject = Type::find($id);
        $this->show("type/edit", [
            "typeObject" => $typeObject,
        ]);
    }

    public function edit($id) {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

        $errorList = [];

        if (empty($name)) {
            $errorList[] = "Le nom du type est vide";
        }

        if (empty($errorList)) {
            $type = Type::find($id);

            $type->setName($name);

            if ($type->save()) {
                header("Location: /type/list");
                exit;
            } else {
                echo "Une erreur est survenue lors de l'édition";
            }
        } else {
            foreach ($errorList as $error) {
                echo $error . "<br>";
            }
        }
    }

    public function delete($id) {
        $typeObject = Type::find($id);
        if ($typeObject->delete()) {
            header("Location: /type/list");
        } else {
            echo "Echec de la suppression du type";
        }
    }
}