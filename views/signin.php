<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php require 'menu.php' ?>
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

    </form>
    <input type="submit" value="se connecter" onclick="submitSigninUserForm()">
</div>
<?php require 'footer.php' ?>
<script type="text/javascript">
    validateSignInFormEventListener();
</script>
</body>
</html>