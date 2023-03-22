<?php
namespace App\Controllers;
use App\Models\Category;

class HomeOrderController extends CoreController
{
    public function order()
    {
        $categories = Category::findAllHomePage();
        $this->show("home/order",
        [
            "categories" => $categories
        ]);
    }
}