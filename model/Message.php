<?php

namespace model;

class Message
{
    private int $mes_id;
    private int $ann_id;
    private int $mes_sender_id;
    private int $use_receiver_id;
    private string $mes_content;
    private string $mes_create_at;

    public function __construct()
    {
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
    public function getMesId(): int
    {
        return $this->mes_id;
    }

    /**
     * @param int $mes_id
     */
    public function setMesId(int $mes_id): void
    {
        $this->mes_id = $mes_id;
    }

    /**
     * @return int
     */
    public function getMesSenderId(): int
    {
        return $this->mes_sender_id;
    }

    /**
     * @param int $mes_sender_id
     */
    public function setMesSenderId(int $mes_sender_id): void
    {
        $this->mes_sender_id = $mes_sender_id;
    }

    /**
     * @return int
     */
    public function getUseReceiverId(): int
    {
        return $this->use_receiver_id;
    }

    /**
     * @param int $use_receiver_id
     */
    public function setUseReceiverId(int $use_receiver_id): void
    {
        $this->use_receiver_id = $use_receiver_id;
    }

    /**
     * @return string
     */
    public function getMesContent(): string
    {
        return $this->mes_content;
    }

    /**
     * @param string $mes_content
     */
    public function setMesContent(string $mes_content): void
    {
        $this->mes_content = $mes_content;
    }

    /**
     * @return string
     */
    public function getMesCreateAt(): string
    {
        return $this->mes_create_at;
    }

    /**
     * @param string $mes_create_at
     */
    public function setMesCreateAt(string $mes_create_at): void
    {
        $this->mes_create_at = $mes_create_at;
    }
}