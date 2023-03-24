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
    <div>Message</div>
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
        <div id="message-container">
        </div>
    </div>

</div>
<?php require 'footer.php' ?>
</body>
</html>