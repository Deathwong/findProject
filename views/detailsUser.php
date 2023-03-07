<?php

use function Controller\controller;

require '../Controller/AppController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<!--Menu-->
<?php controller();
?>
<div>
    <?= $user->getUseEmail() ?>
    <?= $user->getUsePassword() ?>
</div>

<!--Importer le footer-->
</body>
</html>
