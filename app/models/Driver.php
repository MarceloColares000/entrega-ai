<?php

namespace App\Models;

class Driver
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?int $phone = null;
    private ?int $cpf = null;
    private ?int $licence = null;
    private ?string $birthdate = null;
    private ?string $validated = null;
    private ?int $type_user = null;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCpf(): int
{
    return $this->cpf;
}

public function setCpf(int $cpf): void
{
    $this->cpf = $cpf;
}


    public function getLicence(): string
    {
        return $this->licence;
    }

    public function setLicence(string $licence): void
    {
        $this->licence = $licence;
    }

    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    public function setBirthdate(string $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function getValidated(): ?string
    {
        return $this->validated;
    }

    public function setValidated(?string $validated): void
    {
        $this->validated = $validated;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
