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

function submitFormAnnonce() {
    const form = $("#createAnnonceForm")

    if (isValidNomAnnonce && isValidPrixAnnonce && isValidDescriptionAnnonce &&
        isValidPhotoAnnonce && isValidCategoryAnnonce) {
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

