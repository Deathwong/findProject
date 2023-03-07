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
    <div>
        <?= $user->getUseEmail() ?>
        <?= $user->getUsePassword() ?>
    </div>
</div>
</body>
</html>
