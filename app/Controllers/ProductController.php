<?php
namespace App\Controllers;

use App\Models\Product;
use App\Controllers\CoreController;

class ProductController extends CoreController
{
    public function list()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);
        $products = Product::findAll();
        $this->show("product/list",
        [
            "products" => $products,
        ]);
    }

    public function add()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);
        $this->show("product/add");
    }

    public function create()
    {
        $this->checkAuthorization(["admin", "catalog-manager"]);
        // $name = isset($_POST["name"]) ? $_POST["name"] : null;
        // $description = isset($_POST["description"]) ? $_POST["description"] : null;
        // $picture = isset($_POST["picture"]) ? $_POST["picture"] : null;
        // $price = isset($_POST["price"]) ? $_POST["price"] : null;

        $name           = filter_input(INPUT_POST, "name",          FILTER_SANITIZE_SPECIAL_CHARS);
        $description    = filter_input(INPUT_POST, "description",   FILTER_SANITIZE_SPECIAL_CHARS);
        $picture        = filter_input(INPUT_POST, "picture",       FILTER_SANITIZE_URL);
        $price          = filter_input(INPUT_POST, "price",         FILTER_VALIDATE_FLOAT);
        $rate           = filter_input(INPUT_POST, "rate",          FILTER_SANITIZE_NUMBER_INT);
        $status         = filter_input(INPUT_POST, "status",        FILTER_SANITIZE_NUMBER_INT);
        $brand_id       = filter_input(INPUT_POST, "brand_id",      FILTER_SANITIZE_NUMBER_INT);
        $category_id    = filter_input(INPUT_POST, "category_id",   FILTER_SANITIZE_NUMBER_INT);
        $type_id        = filter_input(INPUT_POST, "type_id",       FILTER_SANITIZE_NUMBER_INT);

        $errorList = [];

        if(empty($name)){
            $errorList[]= "Le nom est vide";
        }
        if(empty($description)){
            $errorList[]= "Le description est vide";
        }
        if ($picture === false){
            $errorList[]= "L'URL d'image est invalide";
        }
        if ($price === false){
            $errorList[]= "Le prix est invalide";
        }
        if ($rate === false){
            $errorList[]= "La note est invalide";
        }
        if ($status === false){
            $errorList[]= "Le statust est invalide";
        }
        if ($brand_id === false){
            $errorList[]= "Le Brand id est invalide";
        }
        if ($category_id === false){
            $errorList[]= "Le category id est invalide";
        }
        if ($type_id === false){
            $errorList[]= "Le type id est invalide";
        }

        if(empty($errorList)){
            $product = new Product();

            $product->setName($name);
            $product->setDescription($description);
            $product->setPicture($picture);
            $product->setPrice($price);
            $product->setRate($rate);
            $product->setStatus($status);
            $product->setBrandId($brand_id);
            $product->setCategoryId($category_id);
            $product->setTypeId($type_id);

            if($product->insert()){
                header("Location: /product/list");
                exit;
            } else {
                echo "Echec de la sauvegarde en BDD";
            }
        }
        else {
            foreach($errorList as $error){
                echo $error . "<br>";
            }
        }
    }

    public function update($id)
    {
        $productObject = Product::find($id);
        $this->show("product/edit",
        [
            "productObject" => $productObject,
        ]);
    }

    public function edit($id)
    {
        $name           = filter_input(INPUT_POST, "name",          FILTER_SANITIZE_SPECIAL_CHARS);
        $description    = filter_input(INPUT_POST, "description",   FILTER_SANITIZE_SPECIAL_CHARS);
        $picture        = filter_input(INPUT_POST, "picture",       FILTER_SANITIZE_URL);
        $price          = filter_input(INPUT_POST, "price",         FILTER_VALIDATE_FLOAT);
        $rate           = filter_input(INPUT_POST, "rate",          FILTER_SANITIZE_NUMBER_INT);
        $status         = filter_input(INPUT_POST, "status",        FILTER_SANITIZE_NUMBER_INT);
        $brand_id       = filter_input(INPUT_POST, "brand_id",      FILTER_SANITIZE_NUMBER_INT);
        $category_id    = filter_input(INPUT_POST, "category_id",   FILTER_SANITIZE_NUMBER_INT);
        $type_id        = filter_input(INPUT_POST, "type_id",       FILTER_SANITIZE_NUMBER_INT);

        $errorList = [];

        if(empty($name)){
            $errorList[]= "Le nom est vide";
        }
        if(empty($description)){
            $errorList[]= "Le description est vide";
        }
        if ($picture === false){
            $errorList[]= "L'URL d'image est invalide";
        }
        if ($price === false){
            $errorList[]= "Le prix est invalide";
        }
        if ($rate === false){
            $errorList[]= "La note est invalide";
        }
        if ($status === false){
            $errorList[]= "Le statust est invalide";
        }
        if ($brand_id === false){
            $errorList[]= "Le Brand id est invalide";
        }
        if ($category_id === false){
            $errorList[]= "Le category id est invalide";
        }
        if ($type_id === false){
            $errorList[]= "Le type id est invalide";
        }

        if(empty($errorList)){
            $product = Product::find($id);

            $product->setName($name);
            $product->setDescription($description);
            $product->setPicture($picture);
            $product->setPrice($price);
            $product->setRate($rate);
            $product->setStatus($status);
            $product->setBrandId($brand_id);
            $product->setCategoryId($category_id);
            $product->setTypeId($type_id);

            if($product->save()){
                header("Location: /product/list");
                exit;
            } else {
                echo "Echec de la sauvegarde en BDD";
            }
        }
        else {
            foreach($errorList as $error){
                echo $error . "<br>";
            }
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if($product->delete()){
            header("Location: /product/list");
            exit;
        } else {
            echo "Echec de la suppression du produit";
        }
    }
}