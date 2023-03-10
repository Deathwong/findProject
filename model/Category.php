<?php

namespace model;

class Category
{
    private int $cat_id;
    private string $cat_libelle;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getCatId(): int
    {
        return $this->cat_id;
    }

    /**
     * @param int $cat_id
     */
    public function setCatId(int $cat_id): void
    {
        $this->cat_id = $cat_id;
    }

    /**
     * @return string
     */
    public function getCatLibelle(): string
    {
        return $this->cat_libelle;
    }

    /**
     * @param string $cat_libelle
     */
    public function setCatLibelle(string $cat_libelle): void
    {
        $this->cat_libelle = $cat_libelle;
    }
}