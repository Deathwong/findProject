<?php

namespace model;

class Favoris
{
    private int $fav_id;
    private int $ann_id;
    private int $use_id;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getFavId(): int
    {
        return $this->fav_id;
    }

    /**
     * @param int $fav_id
     */
    public function setFavId(int $fav_id): void
    {
        $this->fav_id = $fav_id;
    }

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
}