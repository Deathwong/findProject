<?php
require '../Controller/AppController.php';
controller();
?>

<!DOCTYPE html>
<html lang="en">
<?php require 'header.php' ?>
<body>
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