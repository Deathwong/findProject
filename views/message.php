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
    <?php
    var_dump($usersChatBox);
    ?>
</div>
<?php require 'footer.php' ?>
</body>
</html>