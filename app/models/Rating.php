<?php

namespace App\Models;

class Rating
{
 

    private ?int $id = null;
    private ?int $delivery_id = null;
    private ?int $user_id = null;
    private ?int $driver_id = null;
    private ?string $rating = null;
    private ?string $comment = null;
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

    public function getDelivery_id(): ?int
    {
        return $this->delivery_id;
    }

    public function setDelivery_id(?int $delivery_id): void 
    {
        $this->delivery_id = $delivery_id;
    }

    public function getUser_Id(): ?int
    {
        return $this->user_id;
    }

    public function setUser_Id(?int $user_id): void 
    {
        $this->user_id = $user_id;
    }

    public function getDriver_id(): ?int
    {
        return $this->driver_id;
    }

    public function setDriver_id(?int $driver_id): void 
    {
        $this->driver_id = $driver_id;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): void 
    {
        $this->rating = $rating;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void 
    {
        $this->comment = $comment;
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
