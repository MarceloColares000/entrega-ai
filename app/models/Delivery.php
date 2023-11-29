<?php

namespace App\Models;

class Delivery
{
    private ?int $id = null;
    private ?string $delivery_id  = null;
    private ?int $user_id = null;
    private ?int $driver_id = null;
    private ?string $sender_name = null;
    private ?float $sender_latitude = null;
    private ?float $sender_longitude = null;
    private ?string $sender_address_details = null;
    private ?string $sender_house_number = null;
    private ?string $recipient_name = null;
    private ?float $recipient_latitude = null;
    private ?float $recipient_longitude = null;
    private ?string $recipient_address_details = null;
    private ?string $recipient_house_number = null;
    private ?int $vehicle_type_id  = null;
    private ?int $vehicle_id  = null;
    private ?string $weight  = null;
    private ?int $delivery_status_id = null;
    private ?string $total_km  = null;
    private ?string $total_price  = null;
    private ?string $delivery_details = null;
    private ?string $delivery_date = null;
    private ?string $current_latitude = null;
    private ?string $current_longitude = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    // Atributos da classe VehicleType
    private ?string $vehicle_type_name = null;
    private ?string $vehicle_base_rate = null;
    private ?string $vehicle_rate_per_km = null;

    // Atributos da classe Driver
    private ?string $driver_name = null;
    private ?string $driverId = null;
    private ?string $average_rating = null;

    // Atributos da classe Users
    private ?string $user_name = null;

    // Atributos da classe DeliveryStatus
    private ?string $delivery_status_name = null;
    private ?string $delivery_status_description = null;
    private ?string $delivery_icon = null;
    private ?string $delivery_css_class = null;

    private ?string $vehicle_brand = null;
    private ?string $vehicle_model = null;
    private ?string $vehicle_plate_number = null;
    private ?string $vehicle_color = null;

    public function getVehicle_brand()
    {
        return $this->vehicle_brand;
    }

    public function getVehicle_model()
    {
        return $this->vehicle_model;
    }

    public function getVehicle_plate_number()
    {
        return $this->vehicle_plate_number;
    }

    public function getVehicle_color()
    {
        return $this->vehicle_color;
    }

    public function toArrayGet()
    {
        $data = [
        'id' => $this->getId(),
        'delivery_id' => $this->getDelivery_id(),
        'user_id' => $this->getUser_id(),
        'driver_id' => $this->getDriver_id(),
        'sender_name' => $this->getSender_name(),
        'sender_latitude' => $this->getSender_latitude(),
        'sender_longitude' => $this->getSender_longitude(),
        'sender_longitude' => $this->getSender_longitude(),
        'sender_address_details' => $this->getSender_address_details(),
        'sender_house_number' => $this->getSender_house_number(),
        'recipient_name' => $this->getRecipient_name(),
        'recipient_latitude' => $this->getRecipient_latitude(),
        'recipient_longitude' => $this->getRecipient_longitude(),
        'recipient_address_details' => $this->getRecipient_address_details(),
        'recipient_house_number' => $this->getRecipient_house_number(),
        'vehicle_type_id' => $this->getVehicle_type_id(),
        'vehicle_id' => $this->getVehicle_id(),
        'delivery_status_id' => $this->getDelivery_status_id(),
        'weight' => $this->getWeight(),
        'total_km' => $this->getTotal_km(),
        'total_price' => $this->getTotal_price(),
        'delivery_details' => $this->getDelivery_details(),
        'delivery_date' => $this->getDelivery_date(),
        'created_at' => $this->getCreated_at(),
        'updated_at' => $this->getUpdated_at(),
    ];

    // Filtra os campos que não estão vazios
    $filteredData = array_filter($data, function ($value) {
        return $value !== '' && $value !== null;
    });

    return $filteredData;
    }

    // Métodos getters e setters para cada propriedade
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDelivery_id($delivery_id) {
        $this->delivery_id = $delivery_id;
    }

    public function getDelivery_id(){
        return $this->delivery_id;
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

    public function getSender_address_details()
    {
        return $this->sender_address_details;
    }

    public function setSender_address_details($sender_address_details)
    {
        $this->sender_address_details = $sender_address_details;
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

    public function getRecipient_address_details()
    {
        return $this->recipient_address_details;
    }

    public function setRecipient_address_details($recipient_address_details)
    {
        $this->recipient_address_details = $recipient_address_details;
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

    public function getVehicle_id()
    {
        return $this->vehicle_id;
    }

    public function setVehicle_id($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
    }

    public function getDelivery_status_id()
    {
        return $this->delivery_status_id;
    }

    public function setDelivery_status_id($delivery_status_id)
    {
        $this->delivery_status_id = $delivery_status_id;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
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

    public function getCurrent_latitude()
    {
        return $this->current_latitude;
    }

    public function setCurrent_latitude($current_latitude)
    {
        $this->current_latitude = $current_latitude;
    }

    public function getCurrent_longitude()
    {
        return $this->current_longitude;
    }

    public function setCurrent_longitude($current_longitude)
    {
        $this->current_longitude = $current_longitude;
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

    public function getVehicle_type_name()
    {
        return $this->vehicle_type_name;
    }

    public function setVehicle_type_name($vehicle_type_name)
    {
        $this->vehicle_type_name = $vehicle_type_name;
    }
    
    public function getVehicle_base_rate()
    {
        return $this->vehicle_base_rate;
    }

    public function setVehicle_base_rate($vehicle_base_rate)
    {
        $this->vehicle_base_rate = $vehicle_base_rate;
    }

    public function getVehicle_rate_per_km()
    {
        return $this->vehicle_rate_per_km;
    }

    public function setVehicle_rate_per_km($vehicle_rate_per_km)
    {
        $this->vehicle_rate_per_km = $vehicle_rate_per_km;
    }

    public function getDriver_name()
    {
        return $this->driver_name;
    }

    public function setDriver_name()
    {
        return $this->driver_name = $driver_name;
    }

    public function getDriverId()
    {
        return $this->driverId;
    }

    public function setDriverId()
    {
        return $this->driverId = $driverId;
    }

    public function getAverage_rating()
    {
        return $this->average_rating;
    }

    public function getUser_name()
    {
        return $this->user_name;
    }

    public function setUser_name()
    {
        return $this->user_name = $user_name;
    }

    public function getDelivery_Status_Name(): ?string {
        return $this->delivery_status_name;
    }

    public function setDelivery_Status_Name(?string $delivery_status_name): void {
        $this->delivery_status_name = $delivery_status_name;
    }

    public function getDelivery_Status_Description(): ?string {
        return $this->delivery_status_description;
    }

    public function setDelivery_Status_Description(?string $delivery_status_description): void {
        $this->delivery_status_description = $delivery_status_description;
    }

    public function getDelivery_Icon(): ?string {
        return $this->delivery_icon;
    }

    public function setDelivery_Icon(?string $delivery_icon): void {
        $this->delivery_icon = $delivery_icon;
    }

    public function getDelivery_Css_Class(): ?string {
        return $this->delivery_css_class;
    }

    public function setDelivery_Css_Class(?string $delivery_css_class): void {
        $this->delivery_css_class = $delivery_css_class;
    }
}
