<?php
require '../Controller/AppController.php';
controller();
?>
<!DOCTYPE html>
<html lang="fr">
<?php require 'header.php' ?>
<body>
<div>

    <form action="detailsUser.php" method="post" id="formUser">
        <div>
            <label for="email"></label>
            <input type="text"
                   name="email"
                   id="email"
                   placeholder="votre email"
            >
        </div>
        <div>
            <label for="password"></label>
            <input type="text"
                   name="password"
                   id="password"
                   placeholder="mot de passe"
            >
        </div>

        <input type="submit" value="s'inscrire" onclick="submitSigninUserForm()">
    </form>

</div>
<?php require 'footer.php' ?>
<script type="text/javascript">
    validateFormEventListener();
</script>
</body>
</html>