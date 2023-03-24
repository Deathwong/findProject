let userAnnonceId;
let userConnectId;

/**
 * Valide les deux champs du user
 */
function validateUserForm() {
    validateEmail();
    validatePassword();
}

/**
 * Valide le formulaire de connexion pour le submit
 * Si isValidEmail et isValidPassword sont tous les deux true il submit le formulaire
 */
function submitSigninUserForm() {
    // On récupère l'élément dont l'id est formUser
    const form = $("#formUser");

    // Appel de la fonction de validation des champs du user
    validateUserForm();

    // Vérification des variables de validation
    if (isValidEmail && isValidPassword) {
        form.submit();
    } else {
        form.preventDefault();
    }
}

/**
 * Valide le formulaire de connexion pour le submit
 * Si isValidEmail et isValidPassword sont tous les deux true il submit le formulaire
 */
function submitSignUpUserForm() {
    // On récupère l'élément dont l'id est formUser
    const form = $("#formUser");

    // Appel de la fonction de validation des champs du user
    validateUserForm();

    if (isValidEmail && isValidPassword) {
        form.submit();
    } else {
        form.preventDefault();
    }
}

/**
 * Permet de valider les différents inputs
 */
function validateSignUpFormEventListener() {
    validateEmailEventListener();
    validatePasswordEventListener();
}

function validateSignInFormEventListener() {
    validateEmailEventListener();
    validatePasswordEventListener();
}

function validatedUpdateAnnonceForm() {
    validateNomAnnonce();
    validatePrixAnnonce();
    validateDescriptionAnnonce();
    validateCategoryAnnonce();
}

function submitUpdateFormAnnonce() {
    const form = $("#updateAnnonceForm");

    validatedUpdateAnnonceForm();

    if (isValidNomAnnonce && isValidPrixAnnonce && isValidDescriptionAnnonce &&
        isValidCategoryAnnonce) {
        form.submit();
    }
}

function validAnnonceUpdateEventListnerForm() {
    validateNomAnnonceEventListener();
    validatePrixAnnonceEventListener();
    validateDescriptionAnnonceEventListener();
    validateCategoryAnnonceEventListener()
}


function submitCreateFormAnnonce() {
    const form = $("#createAnnonceForm");
    //Demander si c'est bon
    validateNomAnnonce();
    validatePrixAnnonce();
    validatePhotoAnnonce();
    validateDescriptionAnnonce();
    validateCategoryAnnonce();

    if (isValidNomAnnonce && isValidPrixAnnonce && isValidDescriptionAnnonce && isValidPhotoAnnonce &&
        isValidCategoryAnnonce) {
        form.submit();
    }
}

function validCreateAnnonceForm() {
    validateNomAnnonceEventListener();
    validatePrixAnnonceEventListener();
    validateDescriptionAnnonceEventListener();
    validatePhotoAnnonceEventListener();
    validateCategoryAnnonceEventListener()

}

function setCategoriesSelected(values) {
    console.log(values);
    $('.cat_id option[value=' + values + ']').attr('selected', true);
}

function showContactForAnnonceButton(userConnectID, userAnnonceID) {
    if (userConnectID !== userAnnonceID) {
        $("#contact-me").show();
    }
}

function showUpdateAnnonceButton(userConnectID, userAnnonceID) {
    if (userConnectID === userAnnonceID) {
        $("#update-annonce").show();
    }
}

/**
 * Cache ou affiche un élément en fonction de l'id de l'utilisateur connecté
 * @param userConnectID L'id de l'utilisateur connecté
 * @param userAnnonceID L'id du créateur de l'annonce
 * @param elementID L'id de l'élement à afficher
 * @param condition La condition : True pour l'afficher quand les deux ids sont
 * les memes et false pour afficher lorsqu'ils sont différents
 */
function showElementByUserConnectedId(userConnectID, userAnnonceID, elementID, condition) {
    console.log("#" + elementID);
    if (condition === true) {
        if (userConnectID === userAnnonceID) {
            $("#" + elementID).attr('hidden', false);
        }
    } else if (condition === false) {
        if (userConnectID !== userAnnonceID) {
            $("#" + elementID).attr('hidden', false);
        }
    }
}

/**
 * Permet de rediriger vers une page avec en paramètre dans le get l'id de l'annonce
 * @param idAnnonce Id de L'annonce
 * @param url
 */
function redirectOnAnnoncePages(idAnnonce, url) {
    $(location).attr('href', url + '?idAnnonce=' + idAnnonce);
}

/**
 * Permet de rediriger vers une page
 * @param url
 */
function redirectOnPage(url) {
    $(location).attr('href', url);
}

function addOrRemoveFavori(idAnnonce) {

    let isChecked = $('#favori').is(':checked');
    let data = {'idAnnonce': idAnnonce};

    if (isChecked) {
        console.log('Ajout en favori de l\'annonce qui a pour id = ', idAnnonce);
        addFavori(data)
    } else {
        console.log('Suppression en favori de l\'annonce qui a pour id = ', idAnnonce);
        removeFavori(data);
    }
}

function removeFavori(data) {

    const URL = '/findProject/views/deleteFavoriByAnnonce.php';
    const SIGN_UP_URL = 'http://localhost/findProject/views/signup.php';

    $.ajax({
        type: 'POST',
        url: URL,
        data: data,
        dataType: "json"
    }).always(function (response) {
        if (response.responseText === 'success') {
            // Handle success
            console.log("success: ", response);
        } else {
            // Handle error
            console.log("User is not connected: ", response);
            $(location).attr('href', SIGN_UP_URL);
        }
    });
}

function addFavori(data) {
    const URL = '/findProject/views/addFavoriByAnnonce.php';
    const SIGN_UP_URL = 'http://localhost/findProject/views/signup.php';

    $.ajax({
        type: 'POST',
        url: URL,
        data: data,
        dataType: "json"
    }).always(function (response) {
        if (response.responseText === 'success') {
            // Handle success
            console.log("success: ", response);
        } else {
            // Handle error
            console.log("User is not connected: ", response);
            $(location).attr('href', SIGN_UP_URL);
        }
    });
}

function rechercheAjax() {
    let data = {};

    // Récupération des input du formulaire de recherche
    // Nom
    const nom = $("#nom").val();
    if (!checkEmpty(nom)) {
        data.nom = nom;
    }

    // Prix min
    const prixMin = $("#prix_min").val();
    if (!checkEmpty(prixMin)) {
        data.prixMin = prixMin;
    }

    // Prix max
    const prixMax = $("#prix_max").val();
    if (!checkEmpty(prixMax)) {
        data.prixMax = prixMax;
    }

    //
    const categorieId = $("#categorie_id").val();
    if (!checkEmpty(categorieId) && categorieId !== '---Catégories---') {
        data.categorieId = categorieId;
    }

    const URL = '/findProject/views/getAllAnnonce.php';
    let annonces = null;

    $.ajax({
        method: "POST",
        type: "POST",
        url: URL,
        data: data,
        success: function (data) {
            const annonces = JSON.parse(data);

            // Affichage cards
            let cardGridContainer = $("#annonce-cards-grid");
            // clear content
            cardGridContainer.empty();

            // Construction des différents car d'annonce
            for (var i = 0; i < annonces.length; i++) {
                let json_data = `
                <div class="col">
                    <div class="card h-100">
                        <img src="../assets/img/annonces/${annonces[i].ann_photo}" class="card-img-top" 
                        alt="Skyscrapers" />
                        
                        <div class="card-body">
                        
                            <h5 class="card-title">${annonces[i].ann_nom}</h5>
                            
                            <p class="card-text">
                            ${annonces[i].ann_description}
                            </p>
                        </div>
                        
                        <div class="card-footer">
                            <!--Détails annonce-->
                            <a href="detailsAnnonce.php?idAnnonce=${annonces[i].ann_id}" class="btn btn-light icon-hover px-2 pt-2"><i class="fa-sharp fa-solid fa-info"></i></a>
                            
                            <!--Détails Favorie-->
                            <input type="checkbox" id="favori" name="favori" onchange="addOrRemoveFavori(${annonces[i].ann_id})">
                        </div>
                    </div>
                </div>
                `

                cardGridContainer.append(json_data);
            }
        },
        error: function (data) {
            console.log('Error');
        }
    });
}

function getDiscussion(idReceiver, idAnnonce) {
    let data = {};

    // Récupération des données de chargement de la discussion
    // idReceiver
    // idReceiver = $("#idReceiver").text().trim();
    // if (!checkEmpty(idReceiver)) {
    data.use_id = idReceiver;
    // }

    // idAnnonce
    // const idAnnonce = $("#idAnnonce").text().trim();
    // if (!checkEmpty(idAnnonce)) {
    data.ann_id = idAnnonce;
    // }

    const URL = '/findProject/views/getDiscussion.php';
    let discussion = null;

    $.ajax({
        method: "POST",
        type: "POST",
        url: URL,
        data: data,
        success: function (data) {
            const discussion = JSON.parse(data);
            let messageContainer = $("#message-container");
            messageContainer.find("tr:gt(0)").remove();

            // for (let i = 0; i < discussion.length; i++) {
            //     let json_data = '<tr>' +
            //         '<td>' + discussion[i].ann_nom + '</td>' +
            //         '</tr>';
            //     discussion.append(json_data);
            // }
        },
        error: function (data) {
            console.log('Error');
        }
    });
}

function showOrHideElementByUserConnected(elementId, userIsConnected, show) {

    if (userIsConnected && show) {
        $("#" + elementId).attr('hidden', false);
    } else if (!userIsConnected && !show) {
        $("#" + elementId).attr('hidden', false);
    } else {
        $("#" + elementId).attr('hidden', true);
    }
}

function isUserAuthorizedToDelete(userConnectID, userAnnonceID) {

    if (userConnectID !== userAnnonceID) {
        window.location.href = "findProject/views/detailsAnnonce.php";
    }
}

function showOrHideElementByUserConnected(elementId, userIsConnected, show) {

    if (userIsConnected && show) {
        $("#" + elementId).attr('hidden', false);
    } else if (!userIsConnected && !show) {
        $("#" + elementId).attr('hidden', false);
    } else {
        $("#" + elementId).attr('hidden', true);
    }
}