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
        <label for="chatUsers"></label>
        <select name="chatUsers" id="chatUsers" multiple>

            <?php
            //    var_dump($usersChatBox);
            foreach ($usersChatBox as $userChatBox) {
//            if ($userIDChatBox != $userChatBox) {
                ?>
                <option value="<?= $userChatBox->getUseId() ?>"><?= $userChatBox->getUseEmail() ?></option>
                <?php
//            }
            }

            ?>
        </select>
    </div>
    
</div>
<?php require 'footer.php' ?>
</body>
</html>