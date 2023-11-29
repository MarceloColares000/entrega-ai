<?php

namespace App\Models;

class AccountBank
{
    private ?int $id = null;
    private ?int $driver_id = null;
    private ?string $account_number = null;
    private ?string $account_holder_name = null;
    private ?string $bank_name = null;
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

    public function getDriver_Id(): ?int
    {
        return $this->driver_id;
    }

    public function setDriver_Id(?int $driver_id): void 
    {
        $this->driver_id = $driver_id;
    }

    public function getAccount_number(): string
    {
        return $this->account_number;
    }

    public function setAccount_number(string $account_number): void
    {
        $this->account_number = $account_number;
    }

    public function getAccount_holder_name(): string
    {
        return $this->account_holder_name;
    }

    public function setAccount_holder_name(string $account_holder_name): void
    {
        $this->account_holder_name = $account_holder_name;
    }

    public function getBank_name(): string
    {
        return $this->bank_name;
    }

    public function setBank_name(string $bank_name): void
    {
        $this->bank_name = $bank_name;
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
