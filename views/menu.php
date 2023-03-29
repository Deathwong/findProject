<nav class="navbar sticky-top bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/findProject/views/">Find sToRe</a>

        <!--Top Annonce-->
        <div>
            <button type="button" class="btn btn-primary btn-sm" id="user-annonce-link"
                    onclick="rechercheAjax(null, null, true)">Top annonces
            </button>
        </div>
        <!--Top Annonce-->

        <!--User Annonce dropdown-->
        <div class="dropdown" id="user-annonce">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">Mon Compte
            </button>
            <ul class="dropdown-menu">
                <!--Mes Annonces-->
                <li>
                    <button class="dropdown-item" type="button" onclick="rechercheAjax(null, <?= $userIdConnected ?>)">
                        Mes annonces
                    </button>
                </li>
                <!--Mes Annonces-->

                <!--Mes Favoris-->
                <li>
                    <button class="dropdown-item" type="button" onclick="rechercheAjax(<?= $userIdConnected ?>, null)">
                        Mes annonces favori
                    </button>
                </li>
                <!--Mes Favoris-->

                <!--Créer une annonce-->
                <li>
                    <button class="dropdown-item" type="button" onclick="redirectOnPage('createAnnonce.php')">
                        Créer une annonce
                    </button>
                </li>
                <!--Créer une annonce-->

                <!--Messagerie-->
                <li>
                    <button class="dropdown-item" type="button" onclick="redirectOnPage('message.php')">
                        Mes messages
                    </button>
                </li>
                <!--Messagerie-->

                <li>
                    <hr class="dropdown-divider">
                </li>

                <!--Déconnexion-->
                <li>
                    <button class="dropdown-item" type="button" onclick="redirectOnPage('exitUser.php')">
                        Se déconnecter
                    </button>
                </li>
                <!--Déconnexion-->
            </ul>
        </div>
        <!--User Annonce dropdown-->

        <!--User Connexion-->
        <div class="btn-group" role="group" aria-label="Gestion utilisateur">
            <button type="button" class="btn btn-light btn-link btn-sm" id="user-signing-link" hidden="hidden"
                    onclick="redirectOnPage('signin.php')">Se connecter
            </button>
            <button type="button" class="btn btn-light btn-link btn-sm" id="user-signup-link" hidden="hidden"
                    onclick="redirectOnPage('signup.php')">Créer un compte
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
