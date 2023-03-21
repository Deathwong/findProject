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
            foreach ($messageCards as $messageCard) {
                $receiverId = $messageCard->getReceiverId();
                if ($receiverId != $userIDChatBox) {
                    ?>
                    <div class="nowrap message-card"
                         onclick="getDiscussion(<?= $messageCard->getIdAnnonce() ?>,<?= $messageCard->getReceiverId() ?>)">
                        <div>
                            <div>
                                <img class="message-card-photo"
                                     src="../assets/img/annonces/<?= $messageCard->getPhoto() ?>"
                                     alt="image de l'annonce">
                            </div>
                        </div>
                        <div class="">
                            <div id="idReceiver">
                                <?= $messageCard->getReceiver() ?>
                            </div>
                            <div id="idAnnonce">
                                <?= $messageCard->getNomAnnonce() ?>
                            </div>
                            <div>
                                <?= $messageCard->getMessage() ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
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