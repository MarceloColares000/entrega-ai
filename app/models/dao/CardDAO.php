<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\Card;

class CardDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "payment_cards";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (Card::class)
        parent::__construct(Card::class);
    }

}
