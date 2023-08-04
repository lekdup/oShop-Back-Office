<?php
namespace App\Controllers;
use App\Models\Category;

class HomeOrderController extends CoreController
{
    public function order()
    {
        $categories = Category::findAll();
        $this->show("home/order",
        [
            "categories" => $categories
        ]);
    }

    // Page de traitement du formulaire
    public function updateOrder() //homeOrderPost chez Pierre
    {
        // dump($_POST);
        $errorList = [];

        //réinitialiser touts les catégories home-order
        $allCategories = Category::findAll();
        foreach($allCategories as $categoryObject)
        {
            $categoryObject->setHomeOrder(0);
            $categoryObject->save();
        }

        // et la récupérer home-order depuis le formulaire
        foreach($_POST["emplacement"] as $i => $categoryId)
        {
            $homeCategoryObject = Category::find($categoryId);

            if($homeCategoryObject === false)
            {
                if($categoryId == "")
                {
                    $errorList[] = "Aucune catégorie sélectionnée à l'emplacement" . ($i + 1); 
                }
                $errorList[] = "La catégorie #". $categoryId ."sélectionnée pour l'emplacement".($i +1) . "n'existe pas";
            }
            else
            {
                $homeCategoryObject->setHomeOrder( $i +1 );
                $homeCategoryObject->save();
            }
        }
        
        if(empty($errorList))
        {
            header("Location: /home/order");
            exit();
        }
        else 
        {
            $this->show("home/order", [
                "errors" => $errorList,
                "allCategories" => $allCategories
            ]);
        }
    }
}