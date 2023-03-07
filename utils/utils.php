<?php

function getElementInRequestByAttribute(string $param): ?string
{
    $value = null;
    switch ($param) {
        case isset($_POST[$param]):
            $value = strip_tags($_POST[$param]);
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

    $positionPoint = strpos($uploadFileName, ".");
    $extension = substr($uploadFileName, $positionPoint);

    $transformFileName = $name . $extension;
    move_uploaded_file($file['tmp_name'], "../assets/img/annonces/" . $transformFileName);
    

    return $transformFileName;
}
