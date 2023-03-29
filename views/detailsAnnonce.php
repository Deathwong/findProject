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
    <h1>Détails de l'annonce</h1>
    <span>
        <?php
        if (isset($_SESSION["errorDeleteAnnonce"])) {
            echo $_SESSION["errorDeleteAnnonce"];
        }
        $_SESSION["errorDeleteAnnonce"] = null;
        ?>
    </span>
    <div class="row">
        <div class="col-md-4">
            <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce"
                 class="img-thumbnail">
        </div>
        <div class="col">
            <div class="fs-3 fw-bold">
                <?= $annonce->getAnnNom() ?>
            </div>
            <div class="w-75">
                <hr>
            </div>
            <div class="fw-semibold fs-5">
                <?= $annonce->getAnnPrix() ?> €
            </div>

            <div class="row mt-3">
                <div class="col-md-2">
                    <span>Catégorie(s):</span>
                </div>
                <div class="col">
                    <?php
                    foreach ($categoriesAnnonce as $categoryAnnonce) {
                        echo "<span class='badge text-bg-secondary'>$categoryAnnonce</span>";
                    }
                    ?>
                </div>
            </div>

            <div hidden="hidden" id="favori-annonce" class="row mt-3">
                <div class="col-md-1">
                    <label class="form-check-label fw-semibold" for="favori">Favori</label>
                </div>
                <div class="col form-check form-switch">

                    <input class="form-check-input" type="checkbox" role="switch" id="favori"
                           onchange="addOrRemoveFavori(<?= $annonce->getAnnId() ?>)">
                </div>
            </div>

            <!--      Boutons de modifications et de suppression et de message      -->
            <div class="d-flex gap-3 mt-3">
                <div hidden="hidden" id="update-annonce">
                    <button class="btn btn-primary btn-sm" id="updateButton"
                            onclick="redirectOnAnnoncePages(<?= $annonce->getAnnId() ?>,'editAnnonce.php')">
                        Modifier
                    </button>
                </div>
                <!-- Button trigger modal -->
                <div hidden="hidden" id="delete-annonce">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                        Supprimer
                    </button>
                </div>
                <div>
                    <a href="index.php">
                        <button class="btn btn-secondary btn-sm">retour</button>
                    </a>
                </div>
                <div hidden="hidden" id="contact-me">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                        contactez moi
                    </button>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="sendMessage.php" id="messageForm">
                                    <div class="mb-3">
                                        <input type="hidden" name="ann_id" id="ann_id"
                                               value="<?= $annonce->getAnnId() ?>">
                                        <input type="hidden" name="use_receiver_id" id="use_receiver_id"
                                               value="<?= $annonce->getUseId() ?>">
                                        <label for="mes_content" class="col-form-label">Message:</label>
                                        <textarea class="form-control" name="mes_content" id="mes_content">Bonjour, votre annonce m'intéresse ! Est-elle toujours disponible ?</textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
                                <button class="btn btn-primary" onclick="submitForm('messageForm')">envoyer</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1"
                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Suppression</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                êtes vous sûr de supprimer cette annonce ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">non</button>
                                <button class="btn btn-danger" id="deleteButton"
                                        onclick="deleteAnnonce(<?= $annonce->getAnnId() ?>,<?= $user->getUseId() ?>,<?= $annonce->getUseId() ?>,'deleteAnnonce.php')">
                                    oui
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--      Bouttons de modifications et de suppression et de message      -->
        </div>

    </div>
    <div class="w-75 mt-3">
        <div class="fs-4 fw-bold">Description</div>
        <div class="annonce-description mt-1">
            <?= $annonce->getAnnDescription() ?>
        </div>
    </div>
    <span id="errorValidateDeleteAnnonce"></span>
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
</script>
</body>
</html>