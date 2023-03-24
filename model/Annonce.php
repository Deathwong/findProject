<?php

namespace model;

class Annonce
{
    private int $ann_id;
    private int $use_id;
    private string $ann_nom;
    private int $ann_prix;
    private string $ann_description;
    private string $ann_photo;
    private int $ann_nombre_consultation;
    private string $ann_create_at;
    private string $ann_update_at;
    private string $categories;
    private string $userIdFavoris;

    /**
     * @return int
     */
    public function getAnnId(): int
    {
        return $this->ann_id;
    }

    /**
     * @param int $ann_id
     */
    public function setAnnId(int $ann_id): void
    {
        $this->ann_id = $ann_id;
    }

    /**
     * @return int
     */
    public function getUseId(): int
    {
        return $this->use_id;
    }

    /**
     * @param int $use_id
     */
    public function setUseId(int $use_id): void
    {
        $this->use_id = $use_id;
    }

    /**
     * @return string
     */
    public function getAnnNom(): string
    {
        return $this->ann_nom;
    }

    /**
     * @param string $ann_nom
     */
    public function setAnnNom(string $ann_nom): void
    {
        $this->ann_nom = $ann_nom;
    }

    /**
     * @return int
     */
    public function getAnnPrix(): int
    {
        return $this->ann_prix;
    }

    /**
     * @param int $ann_prix
     */
    public function setAnnPrix(int $ann_prix): void
    {
        $this->ann_prix = $ann_prix;
    }

    /**
     * @return string
     */
    public function getAnnDescription(): string
    {
        return $this->ann_description;
    }

    /**
     * @param string $ann_description
     */
    public function setAnnDescription(string $ann_description): void
    {
        $this->ann_description = $ann_description;
    }

    /**
     * @return string
     */
    public function getAnnPhoto(): string
    {
        return $this->ann_photo;
    }

    /**
     * @param string $ann_photo
     */
    public function setAnnPhoto(string $ann_photo): void
    {
        $this->ann_photo = $ann_photo;
    }

    /**
     * @return int
     */
    public function getAnnNombreConsultation(): int
    {
        return $this->ann_nombre_consultation;
    }

    /**
     * @param int $ann_nombre_consultation
     */
    public function setAnnNombreConsultation(int $ann_nombre_consultation): void
    {
        $this->ann_nombre_consultation = $ann_nombre_consultation;
    }

    /**
     * @return string
     */
    public function getAnnCreateAt(): string
    {
        return $this->ann_create_at;
    }

    /**
     * @param string $ann_create_at
     */
    public function setAnnCreateAt(string $ann_create_at): void
    {
        $this->ann_create_at = $ann_create_at;
    }

    /**
     * @return string
     */
    public function getAnnUpdateAt(): string
    {
        return $this->ann_update_at;
    }

    /**
     * @param string $ann_update_at
     */
    public function setAnnUpdateAt(string $ann_update_at): void
    {
        $this->ann_update_at = $ann_update_at;
    }

    /**
     * @return string
     */
    public function getCategories(): string
    {
        return $this->categories;
    }

    /**
     * @param string $categories
     */
    public function setCategories(string $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return string
     */
    public function getUserIdFavoris(): string
    {
        return $this->userIdFavoris;
    }

    /**
     * @param string $userIdFavoris
     */
    public function setUserIdFavoris(string $userIdFavoris): void
    {
        $this->userIdFavoris = $userIdFavoris;
    }
}