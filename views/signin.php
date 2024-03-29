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
    <h1>Connexion</h1>

    <form action="" method="post" id="formUser">
        <div>
            <label for="email">Email</label>
            <input type="text"
                   name="email"
                   id="email"
                   placeholder="votre email"
                   class="form-control"
                   style="width: auto"
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
            <label for="password">Mot de passe</label>
            <input type="text"
                   name="password"
                   id="password"
                   placeholder="mot de passe"
                   class="form-control"
                   style="width: auto"
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
    <div class="d-grid gap-2 d-md-block mt-3">
        <input type="submit" value="se connecter" class="btn btn-primary" onclick="submitSigninUserForm()">
        <a href="index.php">
            <button class="btn btn-secondary">retour</button>
        </a>
    </div>
</div>
<?php require 'footer.php' ?>
<script type="text/javascript">
    validateSignInFormEventListener();
</script>
</body>
</html>