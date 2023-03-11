<?php
require '../Controller/AppController.php';
controller();

?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>
    <div>Modification</div>
    <div>
        <form method="post" action="">
            <div>
                <div>
                    <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce">
                </div>
                <div>
                    <input type="file"
                           name="ann_photo"
                           id="ann_photo"
                    >
                </div>
            </div>
            <div>
                <label for="ann_nom"></label>
                <input type="text"
                       name="ann_nom"
                       id="ann_nom"
                       value="<?= $annonce->getAnnNom() ?>"
                >
            </div>
            <div>
                <label for="ann_prix"></label>
                <input type="text"
                       name="ann_prix"
                       id="ann_prix"
                       value="<?= $annonce->getAnnPrix() ?>"
                >
            </div>
            <div>
                <label for="cat_id"></label>
                <select name="cat_id" id="cat_id" multiple>
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
            <div>
                <label for="ann_description"></label>
                <input type="text"
                       name="ann_description"
                       id="ann_description"
                       value="<?= $annonce->getAnnDescription() ?>"
                >
            </div>
        </form>
        <div>
            <button onclick="submitFormAnnonce()">modifier</button>
        </div>
    </div>
</div>

<?php require 'footer.php' ?>
<script type="text/javascript">
    setCategoriesSelected();
    validAnnonceForm()
</script>
</body>
</html>
