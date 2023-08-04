<?php 

namespace App\Controllers;

use App\Models\Brand;

class BrandController extends CoreController {
    public function list() {
        $brandModel = new Brand();
        $allBrands = $brandModel->findAll();
        $this->show("brand/list", [
            "allBrands" => $allBrands,
        ]);
    }

    public function add() {
        $this->show("brand/add");
    }

    public function create() {
        $name = htmlspecialchars($_POST["name"]);

        $errorList = [];

        if (empty($name)) {
            $errorList[] = "Le nom de la marque est vide";
        }

        if (empty($errorList)) {
            $brand = new Brand();
            $brand->setName($name);

            if($brand->insert()) {
                header("Location: /brand/list");
                exit;
            } else {
                echo "Echec de la sauvegarde en BDD";
            }
        } else {
            foreach ($errorList as $error) {
                echo $error . "<br>";
            }
        }

        $this->show("brand/add");
    }

    public function update($id) {
        $brandObject = Brand::find($id);

        $this->show("brand/edit", [
            "brandObject" => $brandObject,
        ]);
    }

    public function edit($id) {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);

        $errorList = [];

        if (empty($name)) {
            $errorList[] = "Le nom de la marque est vide";
        }

        if (empty($errorList)) {
            $brand = Brand::find($id);

            $brand->setName($name);

            if ($brand->save()) {
                header("Location: /brand/list");
                exit;
            } else {
                echo "Une erreur est survenue lors de l'édition de la marque";
            }
        }   else {
            foreach ($errorList as $error) {
                echo $error . "<br>";
            }
        }
    }

    public function delete($id) {
        $brandObject = Brand::find($id);

        if ($brandObject->delete()) {
            header("Location: /brand/list");
        } else {
            echo "Echec de la suppression de la marque";
        }
    }
};