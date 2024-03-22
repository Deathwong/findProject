<?php

function getElementInRequestByAttribute(string $param): string|null|array
{
    $value = null;
    switch ($param) {
        case isset($_POST[$param]):
            $value = is_array($_POST[$param]) ? $_POST[$param] : strip_tags($_POST[$param]);
            $value = empty($value) ? null : $value;
            break;
        case isset($_GET[$param]):
            $value = strip_tags($_GET[$param]);
            $value = empty($value) ? null : $value;
            break;

        case isset($_FILES[$param]):
            $value = strip_tags($_FILES[$param]["name"]);
            $value = empty($value) ? null : $value;
            break;

        case isset($_ENV[$param]):
            $value = strip_tags($_ENV[$param]);
            $value = empty($value) ? null : $value;
            break;

        case isset($_COOKIE[$param]):
            $value = strip_tags($_COOKIE[$param]);
            $value = empty($value) ? null : $value;
            break;

        case isset($_REQUEST[$param]):
            $value = strip_tags($_REQUEST[$param]);
            $value = empty($value) ? null : $value;
            break;

        case isset($_SERVER[$param]):
            $value = strip_tags($_SERVER[$param]);
            $value = empty($value) ? null : $value;
            break;

        case isset($_SESSION[$param]):
            $value = strip_tags($_SESSION[$param]);
            $value = empty($value) ? null : $value;
            break;

        default:
            echo "Param not found";
            break;
    }

    return $value;
}

function nullIfEmpty(?string $value): ?string
{
    return $value == '' || $value == null ? null : $value;
}

function getFileNamePlusExtension($param, $name): string
{
    $file = $_FILES[$param];
    $uploadFileName = $file["name"];

    $extension = getFileExtension($uploadFileName);

    return constructNamePlusExtensionAndMove($name, $extension, $file['tmp_name']);
}

/**
 * @param $name
 * @param string $extension
 * @param $tmp_name
 * @return string
 */
function constructNamePlusExtensionAndMove($name, string $extension, $tmp_name): string
{
    $transformFileName = $name . '.' . $extension;
    move_uploaded_file($tmp_name, "../assets/img/annonces/" . $transformFileName);
    return $transformFileName;
}

/**
 * Permet de récupérer l'extension d'un fichier
 * @param string $fileName Le nom du fichier
 * @return string L'extension du fichier
 */
function getFileExtension(string $fileName): string
{
    if ($fileName == null) {
        return '';
    }

    $positionPoint = strripos($fileName, "."); // TODO à tester

    if (!$positionPoint) {
        return '';
    }

    return substr($fileName, $positionPoint + 1);
}

/**
 * Permet de récupérer uniquement les chiffres contenus dans la chaine de caractère
 * @param $string
 * @return string
 */
function getDigitsOfTheString($string): string
{
    return preg_replace('/[^0-9]/', '', $string);
}

/**
 * Permet de récupérer uniquement les lettres contenues dans la chaine de caractère
 * @param $string
 * @return string
 */
function getLettersOfTheString($string): string
{
    return preg_replace('/[0-9]/', '', $string);
}

/**
 * Permet de récupérer un élément mis dans la session de l'application.
 * @param $param string Représentant la clé de l'élément en session.
 * @return mixed|null Element correspondant au param. On renvoie null si param est vide, null ou n'existe pas dans la
 * session en tant que clé
 */
function getElementInSession(string $param): mixed
{
    return !isset($param) || !isset($_SESSION[$param]) ? null : $_SESSION[$param];
}

/**
 * Valide les prix sous le format 9 ou 9.99
 * @param $price
 * @return bool
 */
function validatePrice($price): bool
{
    $isValidPrice = false;
    $regex = '/^[0-9]+(\.[0-9]{2})?$/';

    if (preg_match($regex, $price)) {
        $isValidPrice = true;
    }
    return $isValidPrice;
}

/**
 * Valid la longueur maximum d'une chaine de caractère
 * @param int $length
 * @param string $value
 * @return bool
 */
function validateMaxLength(int $length, string $value): bool
{
    return strlen(trim($value)) < $length;
}

/**
 * Valide l'Email
 * @param string $email
 * @return bool
 */
function validateEmail(string $email): bool
{
    $isValidMail = false;
    $regex = '/^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

    if (preg_match($regex, $email)) {
        $isValidMail = true;
    }
    return $isValidMail;
}

/**
 * Valid la longueur minimum d'une chaine de caractère
 * @param int $length
 * @param string $value
 * @return bool
 */
function validateMinLength(int $length, string $value): bool
{
    return strlen(trim($value)) >= $length;
}

/**
 * Ajoute une virgule s'il contient un element
 * @param string $param
 * @return string
 */
function addVirguleIfIsSet(string $param): string
{
    $virgule = ", ";
    if (!empty($param)) {
        $param .= $virgule;
    }
    return $param;
}

