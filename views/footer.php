<nav class="navbar fixed-bottom bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container justify-content-center">
        <span class="mb-3 mb-md-0 text-muted">© 2023 Find sTore, Inc (<b>Jean MENSAH, Peggy CODO,
            Christopher MOUITY MACKONGO, Charlin Joane NDONG SIMA, Tristan PIERRE-LOUIS</b>)</span>
    </div>
</nav>

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

        showOrHideElementByUserConnected('user-connect-div', userConnectId, false);
        showOrHideElementByUserConnected('user-annonce', userConnectId, true);
    });
</script>