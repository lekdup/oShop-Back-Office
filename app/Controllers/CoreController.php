<?php

namespace App\Controllers;

class CoreController
{
    protected $router;
    protected $match;

    public function __construct($router, $match)
    {
        $this->router = $router;
        $this->match = $match;

        $acl = [
            "main-home"         => ["admin", "catalog-manager"],
            
            "category-list"     => ["admin", "catalog-manager"],
            "category-add"      => ["admin", "catalog-manager"],
            "category-create"   => ["admin", "catalog-manager"],
            "category-edit"     => ["admin", "catalog-manager"],
            "category-update"   => ["admin", "catalog-manager"],
            "category-delete"   => ["admin", "catalog-manager"],

            "brand-list"     => ["admin", "catalog-manager"],
            "brand-add"      => ["admin", "catalog-manager"],
            "brand-create"   => ["admin", "catalog-manager"],
            "brand-edit"     => ["admin", "catalog-manager"],
            "brand-update"   => ["admin", "catalog-manager"],
            "brand-delete"   => ["admin", "catalog-manager"],

            "type-list"     => ["admin", "catalog-manager"],
            "type-add"      => ["admin", "catalog-manager"],
            "type-create"   => ["admin", "catalog-manager"],
            "type-edit"     => ["admin", "catalog-manager"],
            "type-update"   => ["admin", "catalog-manager"],
            "type-delete"   => ["admin", "catalog-manager"],

            "tag-list"     => ["admin", "catalog-manager"],
            "tag-add"      => ["admin", "catalog-manager"],
            "tag-create"   => ["admin", "catalog-manager"],
            "tag-edit"     => ["admin", "catalog-manager"],
            "tag-update"   => ["admin", "catalog-manager"],
            "tag-delete"   => ["admin", "catalog-manager"],

            "product-list"      => ["admin", "catalog-manager"],
            "product-add"       => ["admin", "catalog-manager"],
            "product-create"    => ["admin", "catalog-manager"],
            "product-edit"      => ["admin", "catalog-manager"],
            "product-update"    => ["admin", "catalog-manager"],
            "product-delete"    => ["admin", "catalog-manager"],

            "user-list"         => ["admin"],
            // "user-add"          => ["admin"],
            // "user-create"       => ["admin"],
            "user-update"       => ["admin", "catalog-manager"],
            "user-edit"         => ["admin", "catalog-manager"],
            "user-delete"       => ["admin"],

            "home-order"        => ["admin", "catalog-manager"],
            "home-order-update" => ["admin", "catalog-manager"],
        ];

        if($this->match && array_key_exists($this->match["name"], $acl))
        {
            $authorizedRoles = $acl[$this->match["name"]];
            $this->checkAuthorization($authorizedRoles);
        }
    }

    private function checkAuthorization($authorizedRoles = [])
    {
        if(isset($_SESSION["user"]))
        {
            $role = $_SESSION["user"]->getRole();
            // dump($_SESSION);

            if(in_array($role, $authorizedRoles))
            {
                return true; 
            }
            else
            {
                $this->show("error/err404");
                echo "403 Forbidden";
                //todo : bonus afficher errorController
                exit;
            }
        }
        else
        {
            header("Location: /login");
            exit;
        }
    }

    /**
     * Méthode permettant d'afficher du code HTML en se basant sur les views
     *
     * @param string $viewName Nom du fichier de vue
     * @param array $viewData Tableau des données à transmettre aux vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {
        // On globalise $router car on ne sait pas faire mieux pour l'instant
        global $router;
        $viewData["router"] = $this->router;

        // Comme $viewData est déclarée comme paramètre de la méthode show()
        // les vues y ont accès
        // ici une valeur dont on a besoin sur TOUTES les vues
        // donc on la définit dans show()
        $viewData['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];

        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => la variable $assetsBaseUri existe désormais, et sa valeur est $_SERVER['BASE_URI'] . '/assets/'
        // => la variable $baseUri existe désormais, et sa valeur est $_SERVER['BASE_URI']
        // => il en va de même pour chaque élément du tableau
        
        // dump(get_defined_vars());


        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}
