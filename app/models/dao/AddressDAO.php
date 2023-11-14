<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\Address;

class AddressDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "adresses";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (Address::class)
        parent::__construct(Address::class);
    }

}
