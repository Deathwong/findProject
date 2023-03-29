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
    <div>Message</div>
    <div><a href="../views/">
            <button class="btn btn-primary">retour</button>
        </a>
        <div>
            <div>
                <?php
                foreach ($conversationsCards as $conversation) {
                    $userConversationId = $conversation->getVendeurId();
                    $userConversationMail = $conversation->getVendeurEmail();
                    if ($userIDChatBox != $conversation->getAcheteurId()) {
                        $userConversationId = $conversation->getAcheteurId();
                        $userConversationMail = $conversation->getAcheteurEmail();
                    }
                    ?>
                    <div class="nowrap message-card"
                         onclick="getDiscussion(<?= $conversation->getIdConversation() ?>,<?= $userConversationId ?>)">
                        <div>
                            <div>
                                <img class="message-card-photo"
                                     src="../assets/img/annonces/<?= $conversation->getPhoto() ?>"
                                     alt="image de l'annonce">
                            </div>
                        </div>
                        <div class="">
                            <div id="interlocuteur">
                                <?= $userConversationMail ?>
                            </div>
                            <div id="nomAnnonce">
                                <?= $conversation->getAnnonceNom() ?>
                            </div>
                            <div>
                                <?= $conversation->getMessage() ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="chat-box" id="message-container">
            </div>
            <div id="send-message-div"></div>
        </div>

    </div>
    <?php require 'footer.php' ?>
</body>
</html>