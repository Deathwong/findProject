<?php

require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php require 'menu.php' ?>
<div class="container text-center">
    <div>
        <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce" class="img-thumbnail">
    </div>
    <div>
        <?= $annonce->getAnnNom() ?>
    </div>
    <div>
        <?= $annonce->getAnnPrix() ?>
    </div>
    <div>
        <?php
        foreach ($categoriesAnnonce as $categoryAnnonce) {
            echo "<div>$categoryAnnonce</div>";
        }
        ?>
    </div>
    <div>
        <?= $annonce->getAnnDescription() ?>
    </div>
    <div hidden="hidden" id="favori-annonce">
        <label for="favori">Favori</label>
        <input type="checkbox" id="favori" name="favori"
               onchange="addOrRemoveFavori(<?= $annonce->getUseId() ?>)">
    </div>
    <div class="d-flex justify-content-center gap-3">
        <div hidden="hidden" id="contact-me">
            <button class="btn btn-primary" id="contactButton" onclick="redirectOnAnnoncePages(<?= $annonce->getAnnId() ?>,'sendMessage.php')">
                contacter
                moi
            </button>
        </div>
        <div hidden="hidden" id="update-annonce">
            <button class="btn btn-primary" id="updateButton" onclick="redirectOnAnnoncePages(<?= $annonce->getAnnId() ?>,'editAnnonce.php')">
                Modifier
            </button>
        </div>
        <div hidden="hidden" id="delete-annonce">
            <button class="btn btn-danger" id="deleteButton" onclick="redirectOnAnnoncePages(<?= $annonce->getAnnId() ?>,'deleteAnnonce.php')">
                Supprimer
            </button>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
<script>
    // On récupère l'id du user connecté
    userConnectId = <?=  $user->getUseId() ?>;
    // Récupération de l'id du créateur de l'annonce
    userAnnonceId = <?= $annonce->getUseId() ?>;

    // Affichage du bouton vers la modification en fonction des deux ids
    showElementByUserConnectedId(userConnectId, userAnnonceId, 'update-annonce', true);
    // Affichage du bouton vers la suppression en fonction des deux ids
    showElementByUserConnectedId(userConnectId, userAnnonceId, 'delete-annonce', true);
    // Affichage du bouton de contact en fonction des deux ids
    showElementByUserConnectedId(userConnectId, userAnnonceId, 'contact-me', false);
    // Affichage du bouton de mise en favoris en fonction des deux ids
    showElementByUserConnectedId(userConnectId, userAnnonceId, 'favori-annonce', false);

    // Check l'input checkbox, si l'utilisateur connecté à mise l'annonce en favori
    checkedFav(<?= $annonceIsInUserFavori ?>);

    // Vérification de l'hibilité de suppression de l'annonce
    authorizedToDelete(userAnnonceId, deleteAnnonce.php, userConnectId);
</script>
</body>
</html>