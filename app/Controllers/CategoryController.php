<?php 

namespace App\Controllers;

use App\Models\Category;

class CategoryController extends CoreController
{
    public function list()
    {
        $categoryModel = new Category();
        $allCategories = $categoryModel->findAll();
        // $allCategories = Category::findAll();
        $this->show("category/list",
    [
        "allCategories" => $allCategories,
    ]);
    }

    public function add()
    {
        $this->show("category/add");
    }

    public function create()
    {
        // $name = isset($_POST["name"]) ? $_POST["name"] : null;
        // $subtitle = isset($_POST["subtitle"]) ? $_POST["subtitle"] : null;
        // $picture = isset($_POST["picture"]) ? $_POST["picture"] : null;
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, "subtitle", FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, "picture", FILTER_VALIDATE_URL);
        
        $errorList = [];

        if(empty($name)){
            $errorList[] = "Le nom de la catégorie est vide";
        }
        //subtitle peut être null en BDD donc on peut ne pas le vérifier
        if($picture === false){
            $errorList[] = "l'image est invalide";
        }

        if(empty($errorList)){
            $category = new Category;
            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);
            $category->setHomeOrder(0);

            if($category->insert()){
                header("Location: /category/list");
                exit;
            }else {
                echo "Echec de la sauvegarde en BDD";
            }
            
        } else {
            foreach($errorList as $error) {
                echo $error ."<br>";
            }
        }
        $this->show("category/add");
    }

    public function update($id)
    {
        $categoryModel = new Category();
        $categoryUpdate = $categoryModel->find($id);

        $this->show("category/add/$id",
        [
            "categoryUpdate" => $categoryUpdate,
        ]);
    }
}