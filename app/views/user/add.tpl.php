<div class="container my-4">
  <a href="<?= $router->generate('user-list') ?>" class="btn btn-success float-end">
    Retour
  </a>

  <h2>Ajouter un utilisateur</h2>
  
  <form action="<?= $router->generate('user-create'); ?>" method="POST" class="mt-5">
  
    <div class="mb-3">
      <label for="email" class="form-label">
        E-mail
      </label>
      <input 
        type="text" 
        class="form-control" 
        id="email" 
        name="email" 
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
        placeholder="Prénom"
      >
    </div>
    
    <div class="mb-3">
      <label for="role" class="form-label">
        Rôle
      </label>
      <select id="role" name="role" class="form-control">
        <option value="">
          Sélectionner un rôle
        </option>
        <option value="catalog-manager">
          Catalog Manager
        </option>
        <option value="admin">
          Admin
        </option>
      </select>
    </div>
    
    <div class="mb-3">
      <label for="status" class="form-label">
        Status
      </label>
      <select id="status" name="status" class="form-control">
        <option value="">
          Sélectionner un status
        </option>
        <option value="1">
          Actif
        </option>
        <option value="2">
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