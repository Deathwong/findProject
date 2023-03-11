<?php

use Controller\AnnonceController;
use Controller\UserController;
use model\Annonce;
use model\User;
use service\UriHandler;

require_once '../service/UriHandler.php';
require_once 'UserController.php';
require_once 'AnnonceController.php';
require_once 'CategoryController.php';

$users = [];
$user = new User();

$annonces = [];
$annonce = new Annonce();

$categories = [];
$categoriesAnnonce = [];

$arrayOfSelectedValues = [];

session_start();

function controller(): void
{
    global $users, $user, $annonce, $annonces, $categories, $categoriesAnnonce, $arrayOfSelectedValues;
    $separator = ",";

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($uri) {
        case UriHandler::$INDEX_URL:
            if (isset($_SESSION["use_id"])) {
                $user = $_SESSION["use_id"];
            }
            break;

        case UriHandler::$LISTE_USERS_URL:
            $users = UserController::getUsers();
            break;

        case UriHandler::$DETAILS_USER_URL:
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                UserController::createUser();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $user = UserController::getUserDetails();
            }
            break;

        case UriHandler::$SIGNUP_URL:
            // Pour éviter les erreurs 404. À l'enregistrement, on pointe sur details
            break;

        case UriHandler::$SIGNIN_URL:
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // todo Validation
                // Connexion de l'utilisateur
                UserController::connectUser();
            }
            break;

        case UriHandler::$DETAILS_ANNONCE_URL:
            //on vérifie si la requête est un GET
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                //o récupère les détails de l'Annonce
                $annonce = AnnonceController::getAnnonceDetails();
                $categoriesAnnonce = explode($separator, getLettersOfTheString($annonce->getCategories()));
            }
            break;

        case UriHandler::$DELETE_ANNONCE_URL:
            // Suppression d'une annonce via son Id
            AnnonceController::deleteAnnonce();
            break;

        case UriHandler::$LIST_ANNONCE_URL:
            // TODO Mettre un commentaire de la fonctionnalité
            // TODO : Appelle de la fonction qui va bien d'annonceController
            break;

        case UriHandler::$EDIT_ANNONCE_URL:
            // Modification de l'annonce
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $annonce = AnnonceController::getAnnonceDetails();
                $categoriesAnnonce = explode($separator, $annonce->getCategories());
                $categories = CategoryController::getAllCategories();

                foreach ($categoriesAnnonce as $categoryAnnonce) {
                    $categoryAnnonceId = getDigitsOfTheString($categoryAnnonce);
                    $arrayOfSelectedValues[] = $categoryAnnonceId;
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
                AnnonceController::updateAnnonce();
            break;

        case UriHandler::$GET_ALL_ANNONCE_URL:
            // Récupération des annonces
            $annonces = AnnonceController::getAllAnnonce();
            break;

        default:
            header('Status: 404 Not Found');
            echo '<html lang="fr"><body><h1>Page Not Found</h1></body></html>';
    }
}