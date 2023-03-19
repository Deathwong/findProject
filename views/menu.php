<nav class="navbar fixed-top bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/findProject/views/">Find sToRe</a>
        <div class="d-flex">
            <form>
                <input
                        class="form-control me-2"
                        type="search"
                        placeholder="Search"
                        aria-label="Rechercher une annonce"
                        id="nom"
                        name="nom">
            </form>
            <button class="btn btn-outline-success" onclick="rechercheAjax()">Search</button>
        </div>
    </div>
</nav>