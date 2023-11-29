<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\AccountBank;

class AccountBankDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "banking_info";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (AccountBank::class)
        parent::__construct(AccountBank::class);
    }

}
