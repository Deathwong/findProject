<?php

use function Controller\controller;

require '../Controller/AppController.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php require 'header.php' ?>
<body>
<?php controller();
?>
<div>
    <div><?= $user->getUseId() ?></div>
    <div><?= $user->getUseEmail() ?></div>
    <div><?= $user->getUsePassword() ?></div>
</div>
<?php require 'footer.php' ?>
</body>
</html>