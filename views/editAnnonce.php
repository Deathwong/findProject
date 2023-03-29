<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php require 'menu.php' ?>
<div class="container">
    <div>
        <h1>Modification de l'annonce</h1>
        <div>
            <span>
                <?php
                if (isset($_SESSION['errorValidateUpdateAnnonce'])) {
                    echo $_SESSION['errorValidateUpdateAnnonce'];
                }
                $_SESSION['errorValidateUpdateAnnonce'] = null;
                ?>
            </span>
        </div>
        <form method="post" action="" id="updateAnnonceForm" enctype="multipart/form-data">
            <div>
                <input type="hidden" name="ann_id" value="1" class="form-control">
            </div>
            <div>
                <div>
                    <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce"
                         class="img-thumbnail">
                </div>
                <div>
                    <input type="file"
                           name="ann_photo"
                           id="ann_photo"
                    >
                    <span id="errorPhotoAnnonce"></span>
                </div>
            </div>
            <div>
                <label for="ann_nom"></label>
                <input type="text"
                       name="ann_nom"
                       id="ann_nom"
                       value="<?= $annonce->getAnnNom() ?>"
                       class="form-control"
                >
                <span id="errorNomAnnonce"></span>
            </div>
            <div>
                <label for="ann_prix"></label>
                <input type="text"
                       name="ann_prix"
                       id="ann_prix"
                       value="<?= $annonce->getAnnPrix() ?>"
                       class="form-control"
                >
                <span id="errorPrixAnnonce"></span>
            </div>
            <div class="dropdown">
                <label for="cat_id[]"></label>
                <select name="cat_id[]" id="cat_id" class="cat_id form-select" multiple>
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
                <span id="errorCategoryAnnonce"></span>
            </div>
            <div>
                <label for="ann_description"></label>
                <input type="text"
                       name="ann_description"
                       id="ann_description"
                       value="<?= $annonce->getAnnDescription() ?>"
                       class="form-control"
                >
                <span id="errorDescriptionAnnonce"></span>
            </div>
        </form>
        <div class="d-grid gap-2 d-md-block mt-3">
            <button onclick="submitUpdateFormAnnonce()" class="btn btn-primary">modifier</button>
            <a href="detailsAnnonce.php?idAnnonce=<?= $annonce->getAnnId() ?>">
                <button class="btn btn-secondary">retour</button>
            </a>
        </div>
    </div>
</div>

<?php require 'footer.php' ?>
<script type="text/javascript">
    let arrayValuesSelected = [<?php echo '"' . implode('","', $arrayOfSelectedValues) . '"' ?>];
    setCategoriesSelected(arrayValuesSelected);
    validAnnonceUpdateEventListnerForm();
</script>
</body>
</html>
