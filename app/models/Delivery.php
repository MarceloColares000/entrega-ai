<?php

namespace App\Models;

class Delivery
{
    private ?int $id = null;
    private string $delivery_id;
    private ?int $user_id = null;
    private ?int $driver_id = null;
    private ?string $sender_name = null;
    private ?float $sender_latitude = null;
    private ?float $sender_longitude = null;
    private ?string $sender_house_number = null;
    private ?string $recipient_name = null;
    private ?float $recipient_latitude = null;
    private ?float $recipient_longitude = null;
    private ?string $recipient_house_number = null;
    private ?int $vehicle_type_id = null;
    private ?int $delivery_status_id = null;
    private string $total_km;
    private string $total_price;
    private ?string $delivery_details = null;
    private ?string $delivery_date = null;
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

    public function getDelivery_id()
    {
        return $this->delivery_id;
    }

    public function setDelivery_id($delivery_id)
    {
        $this->delivery_id = $delivery_id;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getDriver_id()
    {
        return $this->driver_id;
    }

    public function setDriver_id($driver_id)
    {
        $this->driver_id = $driver_id;
    }

    public function getSender_name()
    {
        return $this->sender_name;
    }

    public function setSender_name($sender_name)
    {
        $this->sender_name = $sender_name;
    }

    public function getSender_latitude()
    {
        return $this->sender_latitude;
    }

    public function setSender_latitude($sender_latitude)
    {
        $this->sender_latitude = $sender_latitude;
    }

    public function getSender_longitude()
    {
        return $this->sender_longitude;
    }

    public function setSender_longitude($sender_longitude)
    {
        $this->sender_longitude = $sender_longitude;
    }

    public function getSender_house_number()
    {
        return $this->sender_house_number;
    }

    public function setSender_house_number($sender_house_number)
    {
        $this->sender_house_number = $sender_house_number;
    }

    public function getRecipient_name()
    {
        return $this->recipient_name;
    }

    public function setRecipient_name($recipient_name)
    {
        $this->recipient_name = $recipient_name;
    }

    public function getRecipient_latitude()
    {
        return $this->recipient_latitude;
    }

    public function setRecipient_latitude($recipient_latitude)
    {
        $this->recipient_latitude = $recipient_latitude;
    }

    public function getRecipient_longitude()
    {
        return $this->recipient_longitude;
    }

    public function setRecipient_longitude($recipient_longitude)
    {
        $this->recipient_longitude = $recipient_longitude;
    }

    public function getRecipient_house_number()
    {
        return $this->recipient_house_number;
    }

    public function setRecipient_house_number($recipient_house_number)
    {
        $this->recipient_house_number = $recipient_house_number;
    }

    public function getVehicle_type_id()
    {
        return $this->vehicle_type_id;
    }

    public function setVehicle_type_id($vehicle_type_id)
    {
        $this->vehicle_type_id = $vehicle_type_id;
    }

    public function getDelivery_status_id()
    {
        return $this->delivery_status_id;
    }

    public function setDelivery_status_id($delivery_status_id)
    {
        $this->delivery_status_id = $delivery_status_id;
    }

    public function getTotal_km()
    {
        return $this->total_km;
    }

    public function setTotal_km($total_km)
    {
        $this->total_km = $total_km;
    }

    public function getTotal_price()
    {
        return $this->total_price;
    }

    public function setTotal_price($total_price)
    {
        $this->total_price = $total_price;
    }

    public function getDelivery_details()
    {
        return $this->delivery_details;
    }

    public function setDelivery_details($delivery_details)
    {
        $this->delivery_details = $delivery_details;
    }

    public function getDelivery_date()
    {
        return $this->delivery_date;
    }

    public function setDelivery_date($delivery_date)
    {
        $this->delivery_date = $delivery_date;
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
