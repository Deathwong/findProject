<nav class="navbar sticky-top bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/findProject/views/">Find sToRe</a>

        <!--User Annonce-->
        <div class="btn-group" role="group" aria-label="Gestion annonce utilisateur" hidden="hidden" id="user-annonce">
            <button type="button" class="btn btn-primary" id="user-annonce-link"
                    onclick="rechercheAjax(null, <?= $userIdConnected ?>)">Mes annonces
            </button>
            <button type="button" class="btn btn-light" id="user-annonce-favori-link"
                    onclick="rechercheAjax(<?= $userIdConnected ?>, null)">Mes annonces favori
            </button>
        </div>
        <!--User Annonce-->

        <!--User Connexion-->
        <div class="btn-group" role="group" aria-label="Gestion utilisateur">
            <button type="button" class="btn btn-light btn-link" id="user-signing-link" hidden="hidden"
                    onclick="redirectOnPage('signin.php')">Se connecter
            </button>
            <button type="button" class="btn btn-light btn-link" id="user-signup-link" hidden="hidden"
                    onclick="redirectOnPage('signup.php')">Créer un compte
            </button>
            <button type="button" class="btn btn-outline-light" hidden="hidden" id="user-label" disabled>
                Bienvenue
            </button>
            <button type="button" class="btn btn-light btn-link" hidden="hidden" id="user-logout-link"
                    onclick="redirectOnPage('exitUser.php')">Se déconnecter
            </button>
            <button type="button" class="btn btn-light btn-link" id="user-create-annonce-link" hidden="hidden"
                    onclick="redirectOnPage('createAnnonce.php')">Créer une annonce
            </button>
            <button type="button" class="btn btn-light btn-link" id="user-messagerie-link" hidden="hidden"
                    onclick="redirectOnPage('message.php')">Messagerie
            </button>
        </div>
        <!--User Connexion-->

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                aria-controls="offcanvasDarkNavbar">Rechercher
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--Recherche-->
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
             aria-labelledby="offcanvasDarkNavbarLabel">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Rechercher une annonce</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form>
                    <div class="mb-3">
                        <input
                                type="search"
                                class="form-control"
                                placeholder="Titre"
                                aria-label="Titre de l'annonce"
                                id="nom"
                                name="nom">
                    </div>
                    <div class="mb-3">
                        <input
                                type="number"
                                class="form-control"
                                placeholder="Prix minimum"
                                aria-label="Prix minimum"
                                id="prix_min"
                                name="prix_min">
                    </div>
                    <div class="mb-3">
                        <input
                                type="number"
                                class="form-control"
                                placeholder="Prix max"
                                aria-label="Prix max"
                                id="prix_max"
                                name="prix_max">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Catégories" name="categorieId" id="categorie_id">
                            <option>---Catégories---</option>
                            <?php
                            foreach ($categories as $category) {
                                $categoryLibelle = $category->getCatLibelle();
                                $categoryId = $category->getCatId();
                                ?>
                                <option value="<?= $categoryId ?>"><?= $categoryLibelle ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </form>
                <button class="btn btn-outline-success" onclick="rechercheAjax()">Search</button>
            </div>
        </div>
        <!--Recherche-->

    </div>
</nav>
