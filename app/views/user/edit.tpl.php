<div class="container my-4">
  <a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-end">
    Retour
  </a>

  <h2>Ajouter un utilisateur</h2>
  
  <form action="<?= $router->generate('user-edit', ["id" => $userObject->getId()]); ?>" method="POST" class="mt-5">
  
    <div class="mb-3">
      <label for="email" class="form-label">
        E-mail
      </label>
      <input 
        type="text" 
        class="form-control" 
        id="email" 
        name="email" 
        value="<?= $userObject->getEmail(); ?>"
        placeholder="Adresse e-mail"
      >
    </div>
  
    <div class="mb-3">
      <label for="email" class="form-label">
        Mot de passe
      </label>
      <input 
        type="password" 
        class="form-control" 
        id="password" 
        name="password" 
        value="<?= $userObject->getPassword(); ?>"
        placeholder="Mot de passe"
      >
    </div>
    
    <div class="mb-3">
      <label for="lastname" class="form-label">
        Nom
      </label>
      <input 
        type="text" 
        class="form-control" 
        id="lastname" 
        name="lastname" 
        value="<?= $userObject->getLastname() ?>"
        placeholder="Nom"
      >
    </div>
    
    <div class="mb-3">
      <label for="firstname" class="form-label">
        Prénom
      </label>
      <input 
        type="text" 
        class="form-control" 
        id="firstname" 
        name="firstname" 
        value="<?= $userObject->getFirstname() ?>"
        placeholder="Prénom"
      >
    </div>
    
    <div class="mb-3">
      <label for="role" class="form-label">
        Rôle
      </label>
      <select id="role" name="role" class="form-control">
        <option value="0">
          Sélectionner un rôle
        </option>
        <option value="catalog-manager" <?php if($userObject->getRole() === "catalog-manager") {echo "selected"; } ?>>
          Catalog Manager
        </option>
        <option value="admin" <?php if($userObject->getRole() === "admin") {echo "selected"; } ?>>
          Admin
        </option>
      </select>
    </div>
    
    <div class="mb-3">
      <label for="status" class="form-label">
        Status
      </label>
      <select id="status" name="status" class="form-control">
        <option value="0">
          Sélectionner un status
        </option>
        <option value="1" <?php if($userObject->getStatus() == 1) {echo "selected"; } ?>>
          Actif
        </option>
        <option value="2" <?php if($userObject->getStatus() == 2) {echo "selected"; } ?>>
          Désactivé
        </option>
      </select>
    </div>
    
    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-primary mt-5">
        Valider
      </button>
    </div>
  </form>
</div>