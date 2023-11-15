<?php

namespace App\Models;

class User
{

    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private string $phone;
    private ?string $cpf = null;
    private ?string $password = null;
    private string $birthdate;
    private ?string $validated = null;
    private ?int $type_user = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;


    public function toArrayGet()
    {
        $data = [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'cpf' => $this->getCpf(),
            'birthdate' => $this->getBirthdate(),
            'password' => $this->getPassword(), // Incluído se não estiver vazio
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

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    public function getValidated()
    {
        return $this->validated;
    }

    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    public function getTypeUser(): int {
        return $this->type_user;
    }

    public function setTypeUser(int $type_user): void {
        $this->type_user = $type_user;
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
