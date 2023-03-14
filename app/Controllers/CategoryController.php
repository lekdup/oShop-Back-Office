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
}