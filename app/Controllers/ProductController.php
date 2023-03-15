<?php
namespace App\Controllers;

use App\Models\Product;
use App\Controllers\CoreController;

class ProductController extends CoreController
{
    public function list()
    {
        $products = Product::findAll();
        $this->show("product/list",
    [
        "products" => $products,
    ]);
    }
    public function add()
    {
        $this->show("product/add");
    }

    public function create()
    {
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $description = isset($_POST["description"]) ? $_POST["description"] : null;
        $picture = isset($_POST["picture"]) ? $_POST["picture"] : null;
        $price = isset($_POST["price"]) ? $_POST["price"] : null;

        $product = new Product();

        $product->setName($name);
        $product->setDescription($description);
        $product->setPicture($picture);
        $product->setPrice($price);

        $product->insert();

        dump($_POST);
        $this->show("product/add");
    }
}