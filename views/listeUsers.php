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
    <h1>Liste Users</h1>
    <?php
    foreach ($users as $user) {
        ?>
        <div><?= $user->getUseEmail() ?> <?= $user->getUsePassword() ?></div>
        <?php
    }
    ?>
</div>
</body>
</html>