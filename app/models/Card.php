<?php

namespace App\Models;

class Card
{
    private ?int $id = null;
    private ?int $user_id = null;
    private ?string $card_number = null;
    private ?string $cardholder_name = null;
    private ?string $expiration_date = null;
    private ?string $cvv = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    // Métodos getters e setters para cada propriedade

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUser_Id(): ?int
    {
        return $this->user_id;
    }

    public function setUser_Id(?int $user_id): void 
    {
        $this->user_id = $user_id;
    }

    public function getCard_number(): string
    {
        return $this->card_number;
    }

    public function setCard_number(string $card_number): void
    {
        $this->card_number = $card_number;
    }

    public function getCardholder_name(): string
    {
        return $this->cardholder_name;
    }

    public function setCardholder_name(string $cardholder_name): void
    {
        $this->cardholder_name = $cardholder_name;
    }

    public function getExpiration_date(): string
    {
        return $this->expiration_date;
    }

    public function setExpiration_date(string $expiration_date): void
    {
        $this->expiration_date = $expiration_date;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): void
    {
        $this->cvv = $cvv;
    }

    public function getCreated_at(): ?string
    {
        return $this->created_at;
    }

    public function setCreated_at(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdated_at(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdated_at(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
