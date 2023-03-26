<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php require 'menu.php' ?>
<div> Création d'une Annonce</div>
<div>

            <span>
                <?php
                if (isset($_SESSION['errorValidateCreationAnnonce'])) {
                    echo $_SESSION['errorValidateCreationAnnonce'];
                }
                $_SESSION['errorValidateCreationAnnonce'] = null;
                ?>
            </span>
    <form method="post" action="" id="createAnnonceForm" enctype="multipart/form-data">
        <div>
            <label for="ann_nom"></label>
            <input type="text"
                   name="ann_nom"
                   id="ann_nom"
                   placeholder="Titre de l'annonce"
            >
            <span id="errorTitleAnnonce"></span>
        </div>

        <div>
            <label for="ann_photo[]"></label>
            <input type="file"
                   name="ann_photo"
                   id="ann_photo"
                   placeholder="Insérer la photo"
            >
            <span id="errorPhotoAnnonce"></span>
        </div>

        <div>
            <label for="ann_prix[]"></label>
            <label for="ann_prix"></label>
            <input type="text"
                   name="ann_prix"
                   id="ann_prix"
                   placeholder="Insérer le prix"
            >
            <span id="errorPrixAnnonce"></span>
        </div>

        <div>
            <label for="ann_description"></label>
            <input type="text"
                   name="ann_description"
                   id="ann_description"
                   placeholder=" Description de l'annonce"
            >
            <span id="errorDescriptionAnnonce"></span>
        </div>

        <div>
            <label for="cat_id[]"></label>
            <select name="cat_id[]" id="cat_id[]" class="cat_id" multiple>
                <?php
                foreach ($categories as $category) {
                    $categoryLibelle = $category->getCatLibelle();
                    $categoryId = $category->getCatId();
                    ?>
                    <option value="<?= $categoryId ?>"><?= $categoryLibelle ?></option>
                    <?php
                    echo "<div> $categoryLibelle</div>";
                }
                ?>
            </select>
        </div>
    </form>

    <div>
        <button onclick="submitCreateFormAnnonce()">Créer l'annonce</button>
    </div>

</div>

<?php require 'footer.php' ?>
<script type="text/javascript">
    validCreateAnnonceForm();
</script>


</body>

</html>
