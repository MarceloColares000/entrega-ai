<?php

namespace App\Models;

class Vehicle
{
    
    private ?int $id = null;
    private ?int $vehicle_type_id = null;
    private ?int $driver_id = null;
    private ?string $plate_number = null;
    private ?string $brand = null;
    private ?string $model = null;
    private ?string $color = null;
    private ?int $manufacture_year = null;
    private ?string $details = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getVehicle_type_id()
    {
        return $this->vehicle_type_id;
    }

    public function setVehicle_type_id($vehicle_type_id)
    {
        $this->vehicle_type_id = $vehicle_type_id;
    }

    public function getDriver_id()
    {
        return $this->driver_id;
    }

    public function setDriver_id($driver_id)
    {
        $this->driver_id = $driver_id;
    }

    public function getPlate_number()
    {
        return $this->plate_number;
    }

    public function setPlate_number($plate_number)
    {
        $this->plate_number = $plate_number ?? '';
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand ?? '';
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model ?? '';
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color ?? '';
    }

    public function getManufacture_year()
    {
        return $this->manufacture_year;
    }

    public function setManufacture_year($manufacture_year)
    {
        $this->manufacture_year = $manufacture_year ?? '';
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details)
    {
        $this->details = $details ?? '';
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
