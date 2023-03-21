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
        <h1>Liste Annonces</h1>
        <table id="annonce-tab">
            <tr>
                <th>Photo</th>
                <th>Titre</th>
                <th>Prix</th>
                <th>Description</th>
            </tr>

            <?php
            foreach ($annonces as $annonce) {
                ?>
                <tr>
                    <td>
                        <img src="../assets/img/annonces/<?= $annonce->getAnnPhoto() ?>" alt="image de l'annonce">
                    </td>
                    <td><?= $annonce->getAnnNom() ?></td>
                    <td><?= $annonce->getAnnPrix() ?></td>
                    <td><?= $annonce->getAnnDescription() ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<?php require 'footer.php' ?>
<script>

    $(document).ready(function () {
        // On récupère l'id du user connecté
        userConnectId = '<?=  $userIsConnected ?>';

        // Affichage du bouton vers la page de connexion de l'utilisateur
        showOrHideElementByUserConnected('user-signup-link', userConnectId, false);
        showOrHideElementByUserConnected('user-signing-link', userConnectId, false);
        showOrHideElementByUserConnected('user-logout-link', userConnectId, true);
        showOrHideElementByUserConnected('user-label', userConnectId, true);
    });


</script>
</body>
</html>