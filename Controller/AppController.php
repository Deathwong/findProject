<?php

use Controller\AnnonceController;
use Controller\FavoriController;
use Controller\MessageController;
use Controller\UserController;
use model\Annonce;
use model\AppConstant;
use model\User;

require_once '../model/AppConstant.php';
require_once 'UserController.php';
require_once 'AnnonceController.php';
require_once 'CategoryController.php';
require_once 'FavoriController.php';
require_once 'MessageController.php';

$user = new User();
$userIsConnected = false;
$userIdConnected = null;

$annonces = [];
$annonce = new Annonce();
$annonceUserIdsFavoris = [];
$annonceIsInUserFavori = false;

$categories = [];
$categoriesAnnonce = [];

$arrayOfSelectedValues = [];

$conversationsCards = [];
$userConnectChatBox = null;
$userIDChatBox = null;

session_start();

function controller(): void
{
    global $user, $userIsConnected, $annonce, $annonces, $categories, $categoriesAnnonce,
           $arrayOfSelectedValues, $conversationsCards, $userConnectChatBox, $userIDChatBox, $annonceUserIdsFavoris,
           $annonceIsInUserFavori, $userIdConnected;

    $separator = ",";

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (isset($_SESSION["use_id"])) {
        $user = $_SESSION["use_id"];
        $userIsConnected = true;
        $userIdConnected = $user->getUseId();
    }

    switch ($uri) {
        case AppConstant::$INDEX_REAL_URL:
        case AppConstant::$INDEX_URL:

            $categories = CategoryController::getAllCategories();
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {

                $annonces = AnnonceController::getAllAnnonce();
            }

            if (isset($_SESSION["use_id"])) {
                $user = $_SESSION["use_id"];
                $userIsConnected = true;
                $userIdConnected = $user->getUseId();
            }
            break;

        case AppConstant::$SIGNUP_URL:
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                UserController::createUser();
            }
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
                AnnonceController::createAnnonce();
            }

            $categories = CategoryController::getAllCategories();
            break;

        case AppConstant::$DETAILS_ANNONCE_URL:
            //on vérifie si la requête est un GET
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                // On récupère les détails de l'Annonce
                $annonce = AnnonceController::getAnnonceDetails();
                $user = getElementInSession(AppConstant::USE_ID_SESSION_KEY);
                $categoriesAnnonce = explode($separator, getLettersOfTheString($annonce->getCategories()));

                $favoris = $annonce->getUserIdFavoris();

                if (isset($user) && isset($favoris)) {
                    $annonceUserIdsFavoris = explode($separator, $annonce->getUserIdFavoris());
                    $annonceIsInUserFavori = in_array($user->getUseId(), $annonceUserIdsFavoris);
                }
            }
            break;

        case AppConstant::$DELETE_ANNONCE_URL:
            // Suppression d'une annonce via son Id
            AnnonceController::deleteAnnonce();
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

            // Cas d'une recherche ajax.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo json_encode($annonces);
            }
            break;

        case AppConstant::$DELETE_FAVORI_BY_ANNONCE_URL:
            // Suppression des favoris d'une annonce
            FavoriController::deleteLinkFavorisAnnonce();
            break;

        case AppConstant::ADD_FAVORI_BY_ANNONCE_URL:
            // Suppression des favoris d'une annonce
            FavoriController::addLinkFavorisAnnonce();
            break;

        case AppConstant::$MESSAGE_URL:
            // On récupère les utilisateurs auquel l'utilisateur a écrit
            $conversationsCards = MessageController::getConversationsCards();
            // On récupère l'utilisateur connecté
            $userConnectChatBox = getElementInSession(AppConstant::USE_ID_SESSION_KEY);
            $userIDChatBox = $userConnectChatBox->getUseId();
            break;

        case AppConstant::$SEND_MESSAGE_URL:
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                MessageController::sendMessage();
            }
            break;

        case AppConstant::$GET_DISCUSSION:
            $discussions = MessageController::getDiscussion();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo json_encode($discussions);
            }
            break;

        case AppConstant::$SEND_MESSAGE_AJAX_URL:
            MessageController::sendMessageAjax();
            break;

        case AppConstant::EXIT_USER:
            UserController::exit();
            break;

        default:
            header('Status: 404 Not Found');
            echo '<html lang="fr"><body><h1>Page Not Found</h1></body></html>';
    }
}