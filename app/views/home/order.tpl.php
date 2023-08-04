<div class="container my-4">
    <?php if( !empty( $errors ) ) : ?>
        <div class="alert alert-danger">
            <strong>
                Erreur : 
            </strong>
            <ul class="mb-0">
                <?php foreach( $errors as $error ) : ?>
                <li>
                    <?= $error ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="POST" class="mt-5">
        <div class="row">

            <?php for($i = 1; $i <= 5; $i++) : ?>
            <div class="col">
                <div class="form-group">
                    <label for="emplacement<?= $i ?>">Emplacement #<?= $i?></label>
                    <select class="form-control" id="emplacement<?= $i ?>" name="emplacement[]">
                        <option value="">choisissez :</option>

                        <?php foreach($categories as $categoryObject) : ?>
                        <option value="<?= $categoryObject->getId() ;?>" 
                        <?= ($categoryObject->getHomeOrder() == $i) ? "selected" : "" ?>><?= $categoryObject->getName(); ?></option>
                        <?php endforeach ; ?>

                    </select>
                </div>
            </div>
            <?php endfor ; ?>

        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>