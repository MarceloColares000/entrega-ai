<?php

namespace App\Models;

class Address
{
    private ?int $id = null;
    private int $user_id;
    private string $description;
    private string $latitude;
    private string $longitude;    
    private string $addressDetails;    
    private int $number;    
    private int $is_main;    
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

    public function getUser_Id()
    {
        return $this->user_id;
    }

    public function setUser_Id($user_id) 
    {
        $this->user_id = $user_id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description) 
    {
        $this->description = $description ?? '';
    }

    public function getLatitude(){
        return $this->latitude;
    }

    public function setLatitude($latitude){
        return $this->latitude = $latitude;
    }

    public function getLongitude(){
        return $this->longitude;
    }

    public function setLongitude($longitude){
        return $this->longitude = $longitude;
    } 

    public function getAddressDetails(){
        return $this->addressDetails;
    }

    public function setAddressDetails($addressDetails){
        return $this->addressDetails = $addressDetails;
    }    

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
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
