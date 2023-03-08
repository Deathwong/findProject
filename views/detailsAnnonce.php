<?php

use function Controller\controller;

require '../Controller/AppController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php controller();
?>
<div>
    <form>
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
            <label for="ann_description"></label>
            <textarea name="ann_description" id="ann_description"><?= $annonce->getAnnDescription() ?></textarea>
        </div>
        <div>
            <label for="ann_photo"></label>
            <input type="file"
                   name="ann_photo"
                   id="ann_photo"
                   value="C:\wamp64\www\findProject\assets\img\annonces\annonce1.jpeg"
            >
        </div>
    </form>
</div>
<?php require 'footer.php' ?>
</body>
</html>
