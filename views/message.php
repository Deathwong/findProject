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
    <h1>Messagerie</h1>
    <div>
        <div class="row">
            <div class="col-md-3">
                <?php
                foreach ($conversationsCards as $conversation) {
                    $userConversationId = $conversation->getVendeurId();
                    $userConversationMail = $conversation->getVendeurEmail();
                    if ($userIDChatBox != $conversation->getAcheteurId()) {
                        $userConversationId = $conversation->getAcheteurId();
                        $userConversationMail = $conversation->getAcheteurEmail();
                    }
                    ?>
                    <div class="row border border-secondary rounded"
                         onclick="getDiscussion(<?= $conversation->getIdConversation() ?>,<?= $userConversationId ?>)">
                        <div class="col-md-4">
                            <img class="img-thumbnail message-card-photo"
                                 src="../assets/img/annonces/<?= $conversation->getPhoto() ?>"
                                 alt="image de l'annonce">
                        </div>
                        <div class="col">
                            <div id="interlocuteur">
                                <?= $userConversationMail ?>
                            </div>
                            <div id="nomAnnonce">
                                <?= $conversation->getAnnonceNom() ?>
                            </div>
                            <div class="d-inline-block text-truncate max-150">
                                <?= $conversation->getMessage() ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col ps-5 border border-secondary rounded ms-3 me-4">
                <div class="col overflow-auto" id="message-container">
                </div>
                <div class="sticky-bottom" id="send-message-div"></div>
            </div>
        </div>
    </div>
    <div>
        <a href="../views/">
            <button class="mt-3 btn btn-primary">retour</button>
        </a>
    </div>
    <?php require 'footer.php' ?>
</body>
</html>