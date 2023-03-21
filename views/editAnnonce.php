<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php require 'menu.php' ?>
<div>
    <div>Modification</div>
    <div>
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
                <input type="hidden" name="ann_id" value="1">
            </div>
            <div>
                <div>
                    <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce">
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
                >
                <span id="errorNomAnnonce"></span>
            </div>
            <div>
                <label for="ann_prix"></label>
                <input type="text"
                       name="ann_prix"
                       id="ann_prix"
                       value="<?= $annonce->getAnnPrix() ?>"
                >
                <span id="errorPrixAnnonce"></span>
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
                <span id="errorCategoryAnnonce"></span>
            </div>
            <div>
                <label for="ann_description"></label>
                <input type="text"
                       name="ann_description"
                       id="ann_description"
                       value="<?= $annonce->getAnnDescription() ?>"
                >
                <span id="errorDescriptionAnnonce"></span>
            </div>
        </form>
        <div>
            <button onclick="submitUpdateFormAnnonce()">modifier</button>
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
