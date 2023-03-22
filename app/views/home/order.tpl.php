<form action="" method="POST" class="mt-5">
    <div class="row">
        <?php foreach($categories as $key => $categoryObject) : ?>
        <div class="col">
            <div class="form-group">
                <label for="emplacement<?= $key + 1 ?>">Emplacement #<?= $key +1?></label>
                <select class="form-control" id="emplacement1" name="emplacement[]">
                    <option value="">choisissez :</option>
                    <?php foreach($categories as $categoryObject) : ?>
                    <option value="<?= $categoryObject->getId() ;?>"><?= $categoryObject->getName(); ?></option>
                    <?php endforeach ; ?>
                </select>
            </div>
        </div>
        <?php endforeach ; ?>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>