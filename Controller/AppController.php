<?php

namespace Controller;

use model\Annonce;
use model\User;

require_once 'UserController.php';

$users = [];
$user = new User();

$annonces = [];
$annonce = new Annonce();

//session_start();

function controller(): void
{
    global $users, $user;

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    switch ($uri) {
        case '/findProject/views/':
            if (isset($_SESSION["use_id"])) {
                $user = $_SESSION["use_id"];
            }
            break;
        case '/findProject/views/listeUsers':
            $users = UserController::getUsers();
            break;
        case '/findProject/views/detailsUser.php': // todo: modifier le nom
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                UserController::createUser();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $user = UserController::getUserDetails();
            }
            break;
        case '/findProject/views/signup.php':
            // Pour éviter les erreurs 404. A l'enregistrement on pointe sur details
            break;
        case '/findProject/views/signin.php':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // todo Validation
                // Connexion de l'utilisateur
                UserController::connectUser();
            }
            break;
        default:
            header('Status: 404 Not Found');
            echo '<html lang="fr"><body><h1>Page Not Found</h1></body></html>';
    }
}