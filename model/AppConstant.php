<?php

namespace model;

class AppConstant
{

    public static string $HEADER_LOCATION_LABEL = 'location:';
    public static string $EDIT_ANNONCE_LOCATION_LABEL = '../views/editAnnonce.php';
    public static string $ACCUEIL_LOCATION_LABEL = '../views/';

    public static string $INDEX_URL = '/findProject/views/';
    public static string $LISTE_USERS_URL = '/findProject/views/listeUsers.php';
    public static string $DETAILS_USER_URL = '/findProject/views/detailsUser.php';
    public static string $SIGNUP_URL = '/findProject/views/signup.php';
    public static string $SIGNIN_URL = '/findProject/views/signin.php';
    public static string $CREATE_ANNONCE_URL = '/findProject/views/createAnnonce.php';
    public static string $DETAILS_ANNONCE_URL = '/findProject/views/detailsAnnonce.php';
    public static string $DELETE_ANNONCE_URL = '/findProject/views/deleteAnnonce.php';
    public static string $LIST_ANNONCE_URL = '/findProject/views/listAnnonce.php';
    public static string $EDIT_ANNONCE_URL = '/findProject/views/editAnnonce.php';
    public static string $GET_ALL_ANNONCE_URL = '/findProject/views/getAllAnnonce.php';
    public static string $DELETE_FAVORI_BY_ANNONCE_URL = '/findProject/views/deleteFavoriByAnnonce.php';
    public static string $MESSAGE_URL = "/findProject/views/message.php";
    public static string $SEND_MESSAGE_URL = '/findProject/views/sendMessage.php';
    public static string $GET_DISCUSSION = '/findProject/views/getDiscussion.php';
    public const ADD_FAVORI_BY_ANNONCE_URL = '/findProject/views/addFavoriByAnnonce.php';
    public const EXIT_USER = "/findProject/views/exitUser.php";

    public const USE_ID_SESSION_KEY = 'use_id';
    public const HTTP_REQUEST_SUCCESS = 'success';
}