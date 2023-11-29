<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\Rating;

class RatingDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "ratings";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (Rating::class)
        parent::__construct(Rating::class);
    }

}
