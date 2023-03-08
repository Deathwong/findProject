<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php
?>
<div>
    <div><?= $user->getUseId() ?></div>
    <div><?= $user->getUseEmail() ?></div>
    <div><?= $user->getUsePassword() ?></div>
</div>
<?php require 'footer.php' ?>
</body>
</html>