<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<?php require 'menu.php' ?>
<div class="container">
    <div>
        <span>
            <?php
            if (isset($_SESSION['errorValidationUser'])) {
                echo $_SESSION['errorValidationUser'];
                $_SESSION['errorValidationUser'] = null;
            }
            ?>
        </span>
    </div>

    <form action="detailsUser.php" method="post" id="formUser">
        <div>
            <label for="email"></label>
            <input type="text"
                   class="form-control"
                   name="email"
                   id="email"
                   placeholder="votre email"
            >
            <span id="errorEmail"></span>
        </div>
        <div>
            <label for="password"></label>
            <input type="text"
                   class="form-control"
                   name="password"
                   id="password"
                   placeholder="mot de passe"
            >
            <span id="errorPassword"></span>
        </div>

    </form>
    <div>
        <input type="submit" class="btn btn-primary" value="s'inscrire" onclick="submitSignUpUserForm()">
    </div>

</div>
<?php require 'footer.php' ?>
<script type="text/javascript">
    validateSignUpFormEventListener();
</script>
</body>
</html>