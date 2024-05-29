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
    <h1>Création de compte</h1>
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

    <form action="" method="post" id="formUser">
        <div>
            <label for="nom">Nom</label>
            <input type="text"
                   class="form-control"
                   name="nom"
                   id="nom"
                   placeholder="votre Nom"
            >
            <span id="errorNom"></span>
        </div>
        <div>
            <label for="prenom">Prenom</label>
            <input type="text"
                   class="form-control"
                   name="prenom"
                   id="prenom"
                   placeholder="votre Prenom"
            >
            <span id="errorPrenom"></span>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text"
                   class="form-control"
                   name="email"
                   id="email"
                   placeholder="votre email"
            >
            <span id="errorEmail"></span>
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="text"
                   class="form-control"
                   name="password"
                   id="password"
                   placeholder="mot de passe"
            >
            <span id="errorPassword"></span>
        </div>
        <div>
            <label for="confirmPassword">Confirmation Mot de passe</label>
            <input type="text"
                   class="form-control"
                   name="confirmPassword"
                   id="confirmPassword"
                   placeholder="retapez votre mot de passe"
            >
            <span id="errorConfirmPassword"></span>
        </div>

    </form>
    <div class="d-grid gap-2 d-md-block mt-3">
        <input type="submit" value="s'inscrire" class="btn btn-primary" onclick="submitSignUpUserForm()">
        <a href="index.php">
            <button class="btn btn-secondary">retour</button>
        </a>
    </div>
</div>
<?php require 'footer.php' ?>
<script type="text/javascript">
    validateSignUpFormEventListener();
</script>
</body>
</html>