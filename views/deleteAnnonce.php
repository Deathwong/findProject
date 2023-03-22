<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>
    Votre annonce est suppimée.
</div>
<script>
    // On récupère l'id du user connecté
    userConnectId = <?=  $user->getUseId() ?>;
    // Récupération de l'id du créateur de l'annonce
    userAnnonceId = <?= $annonce->getUseId() ?>;
    // Vérification de l'accès à la page de suppresion
    isUserAuthorizedToDelete(userConnectId, userAnnonceId)

</script>
</body>
