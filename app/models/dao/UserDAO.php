<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Models\User;

class UserDAO extends GenericDAO
{
    // Define o nome da tabela no banco de dados que esta classe irá manipular
    protected string $table = "users";

    // Construtor da classe
    public function __construct()
    {
        // Chama o construtor da classe pai (GenericDAO) e passa a classe de entidade (User::class)
        parent::__construct(User::class);
    }

    // Consultas específicas que não estão na GenericDAO
    
    public function searchUsers($termo)
    { 
        $sql = "SELECT * FROM " . $this->table . " WHERE nome LIKE :termo OR email LIKE :termo2";
        
        $params = [
            'termo' => "%{$termo}%",
            'termo2' => "%{$termo}%"
        ];

        return $this->executeQuery($sql, $params);
    }
    
    // Exemplo de consulta com mais 
    public function searchUsersWithAnotherTable()
    { 
        $sql = "
            SELECT
                u.id AS user_id,
                u.name AS user_name,
                u.email AS user_email,
                u.phone AS user_phone,
                u.password AS user_password,
                u.birthdate AS user_birthdate,
                u.validated AS user_validated,
                d.id AS driver_id,
                d.name AS driver_name,
                d.email AS driver_email,
                d.password AS driver_password,
                d.phone AS driver_phone,
                d.cpf AS driver_cpf,
                d.licence AS driver_licence,
                d.birthdate AS driver_birthdate
            FROM users AS u
            LEFT JOIN drivers AS d ON u.id = d.id
        ";

        return $this->executeQuery($sql);
    }
   

}
