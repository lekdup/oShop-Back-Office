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
            $category = new Category();
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
        $categoryObject = Category::find($id);

        $this->show("category/edit",
        [
            "categoryObject" => $categoryObject,
        ]);
    }
    public function edit($id)
    {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $subtitle = filter_input(INPUT_POST, "subtitle", FILTER_SANITIZE_STRING);
        $picture = filter_input(INPUT_POST, "picture", FILTER_VALIDATE_URL);
        
        $errorList = [];

        if(empty($name)){
            $errorList[] = "Le nom de la catégorie est vide";
        }
        //subtitle peut être null en BDD donc on peut ne pas le vérifier
        if($picture === false){
            $errorList[] = "L'URL d'image est invalide";
        }

        if(empty($errorList)){
            $category = Category::find($id);

            $category->setName($name);
            $category->setSubtitle($subtitle);
            $category->setPicture($picture);
            $category->setHomeOrder(0);

            if($category->save()){
                header("Location: /category/list");
                exit;
            } else {
                echo "Une erreur est survenue lors de l'édition de la Catégorie";
            }
        } else {
            foreach($errorList as $error) {
                echo $error ."<br>";
            }
        }
    }

    public function delete($id)
    {
        $categoryObject = Category::find($id);
        if ($categoryObject->delete()){
            header("Location: /category/list");
            exit;
        } else {
            echo "Echec de la suppression de la catégorie";
        }
    }
}