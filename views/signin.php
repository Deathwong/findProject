<?php

use function Controller\controller;

require '../Controller/AppController.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php require 'header.php' ?>
<body>
<?php
controller();
?>
<div>

    <form action="" method="post" id="formUser">
        <div>
            <label for="email"></label>
            <input type="text"
                   name="email"
                   id="email"
                   placeholder="votre email"
            >
            <span id="errorEmail">
                <?php
                if (isset($_SESSION["errorEmail"])) {
                    echo $_SESSION["errorEmail"];
                }
                ?>
            </span>
        </div>
        <div>
            <label for="password"></label>
            <input type="text"
                   name="password"
                   id="password"
                   placeholder="mot de passe"
            >
            <span id="errorPassword">
                <?php
                if (isset($_SESSION["errorPassword"])) {
                    printf($_SESSION["errorPassword"]);
                }
                ?>
            </span>
        </div>

        <input type="submit" value="se connecter" onclick="submitSigninUserForm()">
    </form>
</div>
<?php require 'footer.php' ?>
<script type="text/javascript">
    validateFormEventListener();
</body>
</html>