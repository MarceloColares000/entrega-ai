<?php

namespace App\Models;

class VehicleType
{
    private ?int $id = null;
    private ?string $type_name = null;
    private ?string $description = null;
    private ?string $image_path = null;
    private ?float $base_rate = null;
    private ?float $rate_per_km = null;
    private ?float $max_weight = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    // Métodos getters e setters para cada propriedade

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getType_name()
    {
        return $this->type_name;
    }

    public function setType_name($type_name)
    {
        $this->type_name = $type_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage_path()
    {
        return $this->image_path;
    }

    public function setImage_path($image_path)
    {
        $this->image_path = $image_path;
    }

    public function getBase_rate()
    {
        return $this->base_rate;
    }

    public function setBase_rate($base_rate)
    {
        $this->base_rate = $base_rate;
    }

    public function getRate_per_km()
    {
        return $this->rate_per_km;
    }

    public function setRate_per_km($rate_per_km)
    {
        $this->rate_per_km = $rate_per_km;
    }

    public function getMax_weight()
    {
        return $this->max_weight;
    }

    public function setMax_weight($max_weight)
    {
        $this->max_weight = $max_weight;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}
