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
    <div>Envoi Message</div>
    <div>
        <form method="post" action="" id="messageForm">
            <div>
                <input type="hidden" name="ann_id" id="ann_id" value="<?= $annonce->getAnnId() ?>">
            </div>
            <div>
                <input type="hidden" name="use_receiver_id" id="use_receiver_id"
                       value="<?= $annonce->getUseId() ?>">
            </div>
            <div>
                <label for="mes_content"></label>
                <input type="text" name="mes_content" id="mes_content">
            </div>
        </form>
    </div>
    <div>
        <button onclick="submitForm('messageForm')">envoyer</button>
    </div>
</div>
<?php require 'footer.php' ?>
</body>
</html>