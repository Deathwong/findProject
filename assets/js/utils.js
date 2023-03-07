function stringFormat(str, ...arr) {
    return str.replace(/%(\d+)/g, function (_, i) {
        return arr[--i];
    });
}

/**
 * Permet de désactiver tous éléments de html
 * @param id <p> Id de l'élément à désactiver. Id est de type string</p>
 * <p>Si l'id fourni n'existe pas, aucune action n'est effectuée</p>
 */
function disabledElementById(id) {
    const element = $("#" + id);

    if (element != null) {
        element.prop("disabled", false);
    }
}

/**
 * Permet de montrer ou de cacher un élément
 * @param id <p> Id de votre élément. Id de type string</p>
 * @param action <p><b>true</b> pour afficher l'élement et <b>false</b> pour le cacher. Id est de type string</p>
 * <p>Si l'id fourni n'existe pas, aucune action n'est effectuée</p>
 */
function showOrHideElementById(id, action) {
    const element = $("#" + id);

    if (element != null) {
        if (action) {
            element.show();
        } else {
            element.hide();
        }
    }
}

function submitForm(formId) {
    $('#' + formId).submit();
}