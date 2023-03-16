<?php
session_start();

use Controller\AnnonceController;
use Controller\FavoriController;
use Controller\UserController;
use model\Annonce;
use model\AppConstant;
use model\User;

require_once '../model/AppConstant.php';
require_once 'UserController.php';
require_once 'AnnonceController.php';
require_once 'CategoryController.php';
require_once 'FavoriController.php';

$users = [];
$user = new User();

$annonces = [];
$annonce = new Annonce();

$categories = [];
$categoriesAnnonce = [];

$arrayOfSelectedValues = [];

function controller(): void
{
    global $users, $user, $annonce, $annonces, $categories, $categoriesAnnonce, $arrayOfSelectedValues;
    $separator = ",";

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($uri) {
        case AppConstant::$INDEX_URL:
            if (isset($_SESSION["use_id"])) {
                $user = $_SESSION["use_id"];
            }
            break;

        case AppConstant::$LISTE_USERS_URL:
            $users = UserController::getUsers();
            break;

        case AppConstant::$DETAILS_USER_URL:
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                UserController::createUser();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $user = UserController::getUserDetails();
            }
            break;

        case AppConstant::$SIGNUP_URL:
            // Pour éviter les erreurs 404. À l'enregistrement, on pointe sur details
            break;

        case AppConstant::$SIGNIN_URL:
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // todo Validation
                // Connexion de l'utilisateur
                UserController::connectUser();
            }
            break;

        case AppConstant::$CREATE_ANNONCE_URL:
            //Création d'une annonce
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // todo Validation
                // Connexion de l'utilisateur
                AnnonceController::createAnnonce();
            }
            break;

        case AppConstant::$DETAILS_ANNONCE_URL:
            //on vérifie si la requête est un GET
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                //o récupère les détails de l'Annonce
                $annonce = AnnonceController::getAnnonceDetails();
                $categoriesAnnonce = explode($separator, getLettersOfTheString($annonce->getCategories()));
            }
            break;

        case AppConstant::$DELETE_ANNONCE_URL:
            // Suppression d'une annonce via son Id
            AnnonceController::deleteAnnonce();
            break;

        case AppConstant::$LIST_ANNONCE_URL:
            // TODO Mettre un commentaire de la fonctionnalité
            // TODO : Appelle de la fonction qui va bien d'annonceController
            break;

        case AppConstant::$EDIT_ANNONCE_URL:
            // Modification de l'annonce
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $annonce = AnnonceController::getAnnonceDetails();
                $categoriesAnnonce = explode($separator, $annonce->getCategories());
                $categories = CategoryController::getAllCategories();

                foreach ($categoriesAnnonce as $categoryAnnonce) {
                    $categoryAnnonceId = getDigitsOfTheString($categoryAnnonce);
                    $arrayOfSelectedValues[] = $categoryAnnonceId;
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                AnnonceController::updateAnnonce();
            }
            break;

        case AppConstant::$GET_ALL_ANNONCE_URL:
            // Récupération des annonces
            $annonces = AnnonceController::getAllAnnonce();
            break;

        case AppConstant::$DELETE_FAVORI_BY_ANNONCE_URL:
            // Suppression des favoris d'une annonce
            FavoriController::deleteLinkFavorisAnnonce();
            break;

        case AppConstant::ADD_FAVORI_BY_ANNONCE_URL:
            // Suppression des favoris d'une annonce
            FavoriController::addLinkFavorisAnnonce();
            break;

        default:
            header('Status: 404 Not Found');
            echo '<html lang="fr"><body><h1>Page Not Found</h1></body></html>';

    }


}