<?php

namespace App\Controllers;

// Si j'ai besoin du Model Category
use App\Models\Category;
use App\Models\Product;
use App\Models\CoreModel;

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {
        $allCategories = Category::findAll();
        $allProducts   = Product::findAll();

        $allCategories = array_slice($allCategories, 0, 3);
        $allProducts = array_slice($allProducts, 0, 3);
        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home',
        [
            "categories" => $allCategories,
            "products" => $allProducts
        ]);
    }
}
