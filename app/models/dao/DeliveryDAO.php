<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\Delivery;

class DeliveryDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "deliveries";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (Delivery::class)
        parent::__construct(Delivery::class);
    }

}
