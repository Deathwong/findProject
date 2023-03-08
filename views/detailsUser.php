<?php
require '../Controller/AppController.php';
controller();
?>

<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>
    <?= $user->getUseEmail() ?>
    <?= $user->getUsePassword() ?>
</div>
</body>
</html>
