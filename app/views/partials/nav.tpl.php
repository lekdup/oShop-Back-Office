
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $router->generate("main-home") ?>">oShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <?php if(isset($_SESSION["user"])) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= $router->generate("main-home") ?>">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate("category-list") ?>">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate("product-list") ?>">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Types</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Marques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tags</a>
                    </li>
                    <?php if(isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin()) : ?>
                        <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate("user-list") ?>">Utilisateur</a>
                    </li>
                    <?php endif ; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sélection Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate("user-logout") ?>">Déconnexion</a>
                    </li>
                    <?php endif ; ?>
                </ul>
            </div>
        </div>
    </nav>
