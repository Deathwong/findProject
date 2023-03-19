let isValidEmail = false;
let isValidPassword = false;
let isValidNomAnnonce = false;
let isValidPrixAnnonce = false;
let isValidDescriptionAnnonce = false;
let isValidPhotoAnnonce = false;
let isValidCategoryAnnonce = false;


function validatePassword() {
    const champError = $("#errorPassword");
    const nomChamp = "Password";
    const password = $("#password").val();

    if (checkEmpty(password)) {
        champError.text(stringFormat(formControlErrorMessage.required, nomChamp));
    } else if (checkMinLength(password, 10)) {
        champError.text(stringFormat(formControlErrorMessage.minlength, 10));
    } else {
        champError.text("")
        isValidPassword = true;
    }
}

function validatePasswordEventListener() {

    $("#password").on("keyup", () => {
        validatePassword();
    });
}

function validateEmail() {
    const nomChamp = "Email";
    const champError = $("#errorEmail");
    const email = $("#email").val();

    if (checkEmpty(email)) {
        champError.text(stringFormat(formControlErrorMessage.required, nomChamp));
    } else if (!checkIsNotEmail(email)) {
        champError.text(stringFormat(formControlErrorMessage.email));
    } else {
        champError.text("");
        isValidEmail = true;
    }
}

function validateEmailEventListener() {

    $("#email").on("keyup", () => {
        validateEmail();
    });
}

function validateNomAnnonce() {
    const nomChamp = "nom de l'annonce";
    const champError = $("#errorNomAnnonce");
    const nomAnnonce = $("#ann_nom").val();

    if (checkEmpty(nomAnnonce)) {
        champError.text(stringFormat(formControlErrorMessage.required, nomChamp));
    } else {
        champError.text("");
        isValidNomAnnonce = true;
    }
}

function validateNomAnnonceEventListener() {
    $("#ann_nom").on("keyup", () => {
        validateNomAnnonce();
    })
}

function validatePrixAnnonce() {
    const nomChamp = "prix de l'annonce";
    const champError = $("#errorPrixAnnonce");
    const prixAnnonce = $("#ann_prix").val();

    if (checkEmpty(prixAnnonce)) {
        champError.text(stringFormat(formControlErrorMessage.required, nomChamp));
    } else if (!checkIsNotDigit(prixAnnonce)) {
        champError.text(formControlErrorMessage.digit);
    } else {
        champError.text("");
        isValidPrixAnnonce = true;
    }
}

function validatePrixAnnonceEventListener() {
    $("#ann_prix").on("keyup", () => {
        validatePrixAnnonce();
    })
}

function validateDescriptionAnnonce() {
    const nomChamp = "description de l'annonce";
    const champError = $("#errorDescriptionAnnonce");
    const descriptionAnnonce = $("#ann_description").val();

    if (checkEmpty(descriptionAnnonce)) {
        champError.text(stringFormat(formControlErrorMessage.required, nomChamp));
    } else {
        champError.text("");
        isValidDescriptionAnnonce = true;
    }
}

function validateDescriptionAnnonceEventListener() {
    $("#ann_description").on("keyup", () => {
        validateDescriptionAnnonce();
    })
}

function validateCategoryAnnonce() {
    const nomChamp = "category de l'annonce";
    const champError = $("#errorCategoryAnnonce");
    const categoryAnnonce = $(".cat_id").val();
    console.log(categoryAnnonce);

    if (checkEmptyArray(categoryAnnonce)) {
        champError.text(stringFormat(formControlErrorMessage.required, nomChamp));
    } else {
        champError.text("");
        isValidCategoryAnnonce = true;
    }
}

function validateCategoryAnnonceEventListener() {
    $("#cat_id").on("change", () => {
        validateCategoryAnnonce();
    })
}

function validatePhotoAnnonce() {
    const nomChamp = "photo de l'annonce";
    const champError = $("#errorPhotoAnnonce");
    const photoAnnonce = $("#ann_photo").val();

    if (checkEmpty(photoAnnonce)) {
        champError.text(stringFormat(formControlErrorMessage.required, nomChamp));
    } else {
        champError.text("");
        isValidPhotoAnnonce = true;
    }
}

function validatePhotoAnnonceEventListener() {
    $("#ann_photo").on("change", () => {
        validatePhotoAnnonce();
    })
}

function checkIsNotEmail(value) {
    const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(\\".+\\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(value.trim());
}

function checkIsNotDigit(value) {
    const regex = /^\d+$/;
    return regex.test(value.trim());
}

function checkMinLength(element, length) {
    return element && element.trim().length < length && element.trim().length !== 0;
}

function checkEmpty(element) {
    return !element || element.trim().length === 0;
}

function checkEmptyArray(element) {
    return !element || element.length === 0;
}