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

function showElementById(elementId, isShow) {
    isShow ? $("#" + elementID).attr('hidden', false) : $("#" + elementID).attr('hidden', true);
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

function rechercheAjax(idUserFavori, idUsuerAnnonce, top) {
    let data = {};

    // Récupération des inputs du formulaire de recherche
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

    // Mes annonces favori
    if (idUserFavori) {
        data = {};
        data.mesFavoris = idUserFavori;
    }

    // Mes annonces
    if (idUsuerAnnonce) {
        data = {};
        data.mesAnnonces = idUsuerAnnonce;
    }

    if (top) {
        data = {};
        data.top = true;
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

            // Construction des différents cas d'annonce
            for (let i = 0; i < annonces.length; i++) {
                let json_data = `
                <div class="col">
                    <div class="card h-100">
                        <img src="../assets/img/annonces/${annonces[i].ann_photo}" class="card-img-top" 
                        alt="Skyscrapers" />
                        
                        <div class="card-body">
                            <div class="card-title">
                                <h5>${annonces[i].ann_nom}</h5>
                                <h5>${annonces[i].ann_prix} €</h5>
                            </div>
                            
                            <p class="card-text">
                                ${annonces[i].ann_description}
                            </p>
                        </div>
                        
                        <div class="card-footer">
                            <!--Détails annonce-->
                            <a href="detailsAnnonce.php?idAnnonce=${annonces[i].ann_id}"
                               class="btn btn-primary shadow-0 me-1">Détails</a>
                        </div>
                    </div>
                </div>
                `

                cardGridContainer.append(json_data);
            }

            annonces.length === 0 ? $('#empty-list-annonce').attr('hidden', false) :
                $('#empty-list-annonce').attr('hidden', true);
        },
        error: function (data) {
            console.log('Error');
        }
    });
}


function createInputToSendMessageOnMessagePage(idConversation, idInterlocuteur) {
    let divMessage = $("#send-message-div");

    divMessage.empty();

    let sendMessageForm = "<form id='sendMessageForm'></form>"

    divMessage.append(sendMessageForm);

    sendMessageForm = $('#sendMessageForm');

    let myInputInterlocuteur = "<input type='hidden' name='idInterlocuteur' id='idInterlocuteur'>";
    sendMessageForm.append(myInputInterlocuteur);
    myInputInterlocuteur = $('#idInterlocuteur');
    myInputInterlocuteur.val(idInterlocuteur);


    let myInputIdConversation = "<input type='hidden' name='idConversation' id='idConversation' value='idConversation'>";
    sendMessageForm.append(myInputIdConversation);
    myInputIdConversation = $('#idConversation')
    myInputIdConversation.val(idConversation)

    let labelOfInput = '<label class="form-label" for="mes_content"></label>';
    let myInput = "<input class='form-control' name='mes_content' id='mes_content' placeholder='your message'>";

    let myButtonSubmit = "<button class='btn btn-primary' onclick='sendMessageAjax()'>envoyer</button/>"

    sendMessageForm.append(labelOfInput + myInput);

    divMessage.append(myButtonSubmit);
}

function getDiscussion(idConversation, idInterlocuteur) {
    let data = {};

    data.idConversation = idConversation;

    const URL = '/findProject/views/getDiscussion.php';

    $.ajax({
        method: "POST",
        type: "POST",
        url: URL,
        data: data,
        success: function (data) {
            const discussion = JSON.parse(data);
            let messageContainer = $("#message-container");
            messageContainer.empty();
            messageContainer.find("tr:gt(0)").remove();

            for (let i = 0; i < discussion.length; i++) {
                let json_data = null;

                let receiverId = discussion[i].use_receiver_id;

                if (receiverId === idInterlocuteur) {
                    // position = 'message-user-interlocuteur';
                    json_data = `
                    <div class="message-user-connected">
                    <div class="message-at-left">               
                        ${discussion[i].mes_content}
                    </div>
                    </div>
                `;
                } else {
                    json_data = `
                    <div class="message-user-interlocuteur">
                        ${discussion[i].mes_content}
                    </div>
                `;
                }

                messageContainer.append(json_data);
            }
            createInputToSendMessageOnMessagePage(idConversation, idInterlocuteur);
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

function deleteAnnonce(idAnnonce, userConnectId, userAnnonceId, url) {
    const nomChamp = "l'annonce";
    const champError = $("#errorValidateDeleteAnnonce");

    if (userConnectId === userAnnonceId) {
        $(location).attr('href', url + '?idAnnonce=' + idAnnonce + '&userAnnonceId=' + userAnnonceId);
    } else {
        champError.text(stringFormat(formControlErrorMessage.unavailable, nomChamp));
    }
}

function checkedFav(annonceIsInUserFavori) {
    if (annonceIsInUserFavori === 1) {
        $("#favori").prop('checked', true);
    }
}

function sendMessageAjax() {

    let data = {};

    let interlocuteur = $('#idInterlocuteur').val();

    let idConversation = $('#idConversation').val();

    let message = $('#mes_content').val();

    if (interlocuteur) {
        data.interlocuteur = interlocuteur;
    }

    if (idConversation) {
        data.idConversation = idConversation;
    }

    if (message) {
        data.message = message;
    }

    const URL = '/findProject/views/sendMessageAjax.php';


    $.ajax({
        method: "POST",
        type: "POST",
        url: URL,
        data: data,

    }).always(function () {
        interlocuteur = parseInt(interlocuteur);
        getDiscussion(idConversation, interlocuteur);
    });
}