<nav class="navbar fixed-top bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/findProject/views/">Find sToRe</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
                aria-controls="offcanvasDarkNavbar">Rechercher
            <span class="navbar-toggler-icon"></span>
        </button>

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

    </div>
</nav>
