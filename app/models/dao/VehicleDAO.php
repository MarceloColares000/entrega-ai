<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\Vehicle;

class VehicleDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "vehicles";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (Vehicle::class)
        parent::__construct(Vehicle::class);
    }

}
