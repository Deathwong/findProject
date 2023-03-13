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

    if (isChecked) {
        console.log('Ajout en favori de l\'annonce qui a pour id = ', idAnnonce);
    } else {
        console.log('Suppression en favori de l\'annonce qui a pour id = ', idAnnonce);

        const URL = '/findProject/views/deleteFavoriByAnnonce.php';
        let data = {'idAnnonce': idAnnonce};

        $.ajax({
            type: 'GET',
            url: URL,
            data: data,
            dataType: "json"
            // ,
            // success: function (response) {
            //     console.log("success: ", response);
            //     // if (typeof successCallback === 'function') {
            //     //     successCallback(response);
            //     // }
            // },
            // error: function (error) {
            //     console.log("error: ", error);
            //     $(location).attr('href', 'http://localhost/findProject/views/signup.php');
            //     // if (typeof errorCallback === 'function') {
            //     //     errorCallback(error);
            //     // }
            // }
        }).always(function (response) {
            if (response.responseText === 'OK') {
                // Handle success
                console.log("success: ", response);
            } else {
                // Handle error
                $(location).attr('href', 'http://localhost/findProject/views/signup.php');
            }
        });
        ;
    }
}