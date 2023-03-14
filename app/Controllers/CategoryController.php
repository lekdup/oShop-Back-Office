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
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $subtitle = isset($_POST["subtitle"]) ? $_POST["subtitle"] : null;
        $image = isset($_POST["image"]) ? $_POST["image"] : null;
        // $name = filter_input(INPUT_POST, "name");
        
        $categoryModel = new Category();
        $categoryModel->setName($name);
        $categoryModel->setSubtitle($subtitle);
        $categoryModel->setPicture($image);
        $categoryModel->insert();

        $this->show("category/add");
    }
}