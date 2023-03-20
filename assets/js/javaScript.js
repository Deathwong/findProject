let userAnnonceId;
let userConnectId;

function submitSigninUserForm() {
    const form = $("#formUser");

    validateEmail();
    validatePassword();

    if (isValidEmail && isValidPassword) {
        form.submit();
    } else {
        form.preventDefault();
    }
}

function submitSignUpUserForm() {
    const form = $("#formUser");

    validateEmail();
    validatePassword();

    if (isValidEmail && isValidPassword) {
        form.submit();
    } else {
        form.preventDefault();
    }
}

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

function validAnnonceUpdateForm() {
    validateNomAnnonceEventListener();
    validatePrixAnnonceEventListener();
    validateDescriptionAnnonceEventListener();
    validateCategoryAnnonceEventListener()
}


function submitCreateFormAnnonce() {
    const form = $("#updateAnnonceForm");

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

function redirectOnSendMessagePage(idAnnonce) {
    const MESSAGE = 'sendMessage.php?idAnnonce=';
    $(location).attr('href', MESSAGE + idAnnonce);
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
            let annonceTable = $("#annonce-tab");
            annonceTable.find("tr:gt(0)").remove();

            for (var i = 0; i < annonces.length; i++) {
                let json_data = '<tr>' +
                    "<td> <img src='../assets/img/annonces/" + annonces[i].ann_photo + "' alt='image annonce'></td>" +
                    '<td>' + annonces[i].ann_nom + '</td>' +
                    '<td>' + annonces[i].ann_prix + '</td>' +
                    '<td>' + annonces[i].ann_description + '</td>' +
                    '</tr>';
                annonceTable.append(json_data);
            }
        },
        error: function (data) {
            console.log('Error');
        }
    });
}