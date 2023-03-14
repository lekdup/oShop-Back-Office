<?php
namespace App\Controllers;

use App\Models\Product;
use App\Controllers\CoreController;

class ProductController extends CoreController
{
    public function list()
    {
        $productModel = new Product();
        $allProducts = $productModel->findAll();
        $this->show("product/list",
    [
        "allProducts" => $allProducts,
    ]);
    }
    public function add()
    {
        $this->show("product/add");
    }
}