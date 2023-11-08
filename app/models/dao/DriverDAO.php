<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\Driver;

class DriverDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "drivers";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (Driver::class)
        parent::__construct(Driver::class);
    }

}
