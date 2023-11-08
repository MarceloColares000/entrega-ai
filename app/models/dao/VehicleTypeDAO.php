<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\VehicleType;

class VehicleTypeDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "vehicle_types";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (VehicleType::class)
        parent::__construct(VehicleType::class);
    }

}
