<?php

use Controller\AnnonceController;
use Controller\UserController;
use model\Annonce;
use model\User;
use service\UriHandler;

require_once '../service/UriHandler.php';
require_once 'UserController.php';
require_once 'AnnonceController.php';

$users = [];
$user = new User();

$annonces = [];
$annonce = new Annonce();

$categoriesAnnonce = [];

function controller(): void
{
    global $users, $user, $annonce, $categoriesAnnonce;
    $separator = ",";

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($uri) {
        case UriHandler::$INDEX_URL:
            if (isset($_SESSION["use_id"])) {
                $user = $_SESSION["use_id"];
            }
            break;
        case UriHandler::$LISTEUSERS_URL:
            $users = UserController::getUsers();
            break;

        case UriHandler::$DETAILSUSER_URL:
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
        case UriHandler::$DETAILSANNONCE_URL:
            //on vérifie si la requête est un GET
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                //o récupère les détails de l'Annonce
                $annonce = AnnonceController::getAnnonceDetails();
                $categoriesAnnonce = explode($separator, $annonce->getCategories());
            }
            break;
        default:
            header('Status: 404 Not Found');
            echo '<html lang="fr"><body><h1>Page Not Found</h1></body></html>';
    }
}