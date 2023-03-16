<?php

namespace service;

use PDO;

class PhotoService
{

    /**
     * Insert la photo dans la base de donnée
     * @param int $idAnnonce
     * @param PDO $connection
     * @return void
     */
    public static function insertPhotoNameInAnnonce(int $idAnnonce, PDO $connection): void
    {
        $photoName = self::getPhotoNameByAnnonceId($idAnnonce, $connection);

        self::deletePhotoInDirectoryByHisName($photoName);

        $photo = getFileNamePlusExtension("ann_photo", $idAnnonce);

        $query = "UPDATE annonce a SET a.ann_photo = :photo WHERE ann_id = :idAnnonce";

        $requestPhotoAnnonce = $connection->prepare($query);

        $requestPhotoAnnonce->bindParam(':photo', $photo);
        $requestPhotoAnnonce->bindParam(':idAnnonce', $idAnnonce);

        $requestPhotoAnnonce->execute();
    }

    /**
     * Récupère le nom de la photo dans la base de donnée à partir de l'id de l'annonce
     * @param int $idAnnonce
     * @param PDO $connection
     * @return string
     */
    public static function getPhotoNameByAnnonceId(int $idAnnonce, PDO $connection): string
    {
        // Requête
        $query = "select a.ann_photo from annonce a where a.ann_id = :idAnnonce";
        $requestPhotoAnnonce = $connection->prepare($query);
        $requestPhotoAnnonce->bindParam(':idAnnonce', $idAnnonce);

        //execution de la requête
        $requestPhotoAnnonce->execute();

        return $requestPhotoAnnonce->fetch(PDO::FETCH_ASSOC)['ann_photo'];
    }

    /**
     * Supprime la photo dans le répertoire image
     * @param string $name
     * @return void
     */
    public static function deletePhotoInDirectoryByHisName(string $name): void
    {
        unlink('../assets/img/annonces/' . $name);
    }
}