<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>Message</div>
<div>
    <ul>
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
    </ul>
</div>
<?php require 'footer.php' ?>
</body>
</html>