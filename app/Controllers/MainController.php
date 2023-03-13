<?php

namespace App\Controllers;

// Si j'ai besoin du Model Category
use App\Models\Category;

class MainController extends CoreController
{
    /**
     * Méthode s'occupant de la page d'accueil
     *
     * @return void
     */
    public function home()
    {

        // On appelle la méthode show() de l'objet courant
        // En argument, on fournit le fichier de Vue
        // Par convention, chaque fichier de vue sera dans un sous-dossier du nom du Controller
        $this->show('main/home');
    }

    public function category()
    {
        $this->show("main/category");
    }

    public function addCategory()
    {
        $this->show("main/category_add");
    }

    public function product()
    {
        $this->show("main/product");
    }

    public function addProduct()
    {
        $this->show("main/product_add");
    }

}
