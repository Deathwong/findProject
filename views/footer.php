<div class="container">
    <footer class="bg-dark-subtle d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
            <span class="mb-3 mb-md-0 text-muted">© 2022 Find sTore, Inc</span>
        </div>
    </footer>

    <!--Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>

    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!--    JS files -->
    <script type="text/javascript" src="../assets/js/utils.js"></script>
    <script type="text/javascript" src="../assets/js/messages.js"></script>
    <script type="text/javascript" src="../assets/js/validationUtils.js"></script>
    <script type="text/javascript" src="../assets/js/javaScript.js"></script>

    <script>
        $(document).ready(function () {
            // On récupère l'id du user connecté
            userConnectId = '<?=  $userIsConnected ?>';

            // Affichage du bouton vers la page de connexion de l'utilisateur
            showOrHideElementByUserConnected('user-signup-link', userConnectId, false);
            showOrHideElementByUserConnected('user-signing-link', userConnectId, false);
            showOrHideElementByUserConnected('user-logout-link', userConnectId, true);
            showOrHideElementByUserConnected('user-label', userConnectId, true);
        });
    </script>
</div>