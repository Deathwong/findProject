function submitSigninUserForm() {
    const form = $("#formUser");

    form.validate({
        rules: userRulesHandler,
        messages: errorMessagesUserHandler,
    });

    if (form.validate() && (isValidEmail && isValidPassword)) {
        form.submit();
    } else {
        form.preventDefault();
    }
}

function validateFormEventListener() {
    validateEmailEventListener();
    validatePasswordEventListener();
}

function submitFormAnnonce(formId) {
    const form = $("#" + formId);

    form.validate({
        rules: annonceRulesHandler,
        messages: errorMessagesAnnonceHandler
    })

    if ((isValidNomAnnonce && isValidPrixAnnonce && isValidDescriptionAnnonce &&
        isValidPhotoAnnonce && isValidCategoryAnnonce) || form.validate()) {
        form.submit();
    }
}

function validAnnonceForm() {
    validateNomAnnonceEventListener();
    validatePrixAnnonceEventListener();
    validateDescriptionAnnonceEventListener();
    validatePhotoAnnonceEventListener();
    validateCategoryAnnonceEventListener()
}

function setCategoriesSelected($values) {
    console.log($values);
    $('#cat_id option[value=' + $values + ']').attr('selected', true);
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

    // const URL = '/findProject/views';
    const URL = '/findProject/views/getAllAnnonce.php';
    let annonces = null;

    $.ajax({
        method: "POST",
        type: "POST",
        url: URL,
        data: data,
        // dataType: "JSON",
        success: function (data) {
            annonces = JSON.parse(data);

            $.each(annonces, function (field) {

                console.log(field[0].toString());
                console.log(field[0].ann_id + ': ' + field.ann_nom);
            });
            // ann = data;
        },
        error: function (data) {
            console.log('Error');
        }
    });

    //     .always(function (response) {
    //     if (response.statusText === 'OK') {
    //         // Handle success
    //         console.log("success: ", response);
    //     } else {
    //         // Handle error
    //         console.log("ERROR ", response);
    //         $(location).attr('href', URL);
    //     }
    // });
}