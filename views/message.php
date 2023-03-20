<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>
    <div>Message</div>
    <div>
        <div>
            <?php
            foreach ($messageCards as $messageCard) {
                $receiverId = $messageCard->getReceiverId();
                if ($receiverId != $userIDChatBox) {
                    ?>
                    <div class="nowrap message-card">
                        <div>
                            <div>
                                <img class="message-card-photo"
                                     src="../assets/img/annonces/<?= $messageCard->getPhoto() ?>"
                                     alt="image de l'annonce">
                            </div>
                        </div>
                        <div class="">
                            <div>
                                <?= $messageCard->getReceiver() ?>
                            </div>
                            <div>
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
    </div>

</div>
<?php require 'footer.php' ?>
</body>
</html>