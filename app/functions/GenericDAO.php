<?php

namespace App\Functions;

use App\Functions\Database;
use PDO;

class GenericDAO
{
    // Armazena o nome da classe da entidade
    private $entityClass;

    // Construtor da classe
    public function __construct(string $entityClass)
    {
        // Define o nome da classe da entidade
        $this->entityClass = $entityClass;
    }

    // Executa uma consulta SQL no banco de dados
    public function executeQuery(string $sql, array $params = [])
    {
        // Obtém uma conexão com o banco de dados
        $db = Database::getConnection();
        
        // Prepara a consulta SQL
        $stmt = $db->prepare($sql);

        // Substitui os parâmetros na consulta SQL
        foreach ($params as $param => $value) {
            $stmt->bindValue(":$param", $value);
        }

        // Executa a consulta SQL
        $stmt->execute();
        
        // Define o modo de busca para retornar os resultados como instâncias da classe de entidade
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass);
        
        // Retorna todos os resultados como um array de objetos da classe de entidade
        return $stmt->fetchAll();
    }


    // Mapeia os nomes do banco de dados para garantir que as colunas passadas, sejam as mesmas que estão no banco
    public function getTableColumns()
    {

        // Consulta para obter os nomes das colunas da tabela
        $sql = "SHOW COLUMNS FROM $this->table";

        // Execute a consulta para obter as informações das colunas
        $columnsInfo = $this->executeQuery($sql);

        $columns = [];

        foreach ($columnsInfo as $columnInfo) {
            $columns[] = $columnInfo->Field;
        }

        return $columns;

    }

    //Consultas Genéricas:

    // Selecionar todos os registros
    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table;

        return $this->executeQuery($sql);
    }

    // Selecionar um registro por ID

   
    public function getById($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";

        $params = [
            'id' => $id
        ];

        $result = $this->executeQuery($sql, $params);

        if (!empty($result)) {
            return reset($result);
        } else {
            return null; 
        }
    }
    
     /*
    public function getById(int $id)
    {   
        $db = Database::getConnection();
        try {
            $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_CLASS, $this->entityClass);
        } catch (PDOException $ex) {
            $this->exception = $ex;
            $this->message = $ex->getMessage();
            return null;
        }
    }
    */

    // Selecionar um registro por ID
    public function getByDeliveryId($delivery_id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE delivery_id = :delivery_id LIMIT 1";

        $params = [
            'delivery_id' => $delivery_id
        ];

        return $this->executeQuery($sql, $params);
        
    }

    // Selecionar os registros com condicições
    public function getByConditions($conditions)
    {
        if (!empty($conditions) && is_string($conditions)) {
            $sql = "SELECT * FROM " . $this->table . " WHERE " . $conditions;

            return $this->executeQuery($sql);
        
        } else {
        
            return [];
        }
    }

    public function getByRestrictions(string $restrictions)
    {
        try {
            $table = $this->validationTable($tableParam);

            $sql = "SELECT * FROM $table WHERE $restrictions";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $ex) {
            $this->exception = $ex;
            $this->message = $ex->getMessage();
            return null;
        }
    }

    // Seleciona e pagina todos os registros
    public function getPagination($limit, $page)
    {
        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM " . $this->table . " LIMIT :limit OFFSET :offset";

        $params = [
            'limit' => (int)$limit,
            'offset' => (int)$offset,
        ];

        return $this->executeQuery($sql, $params);
    }

    
    // Verifica se o email já está cadastrado
    public function isEmailRegistered($email)
    {
        $sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email";
        
        $params = [
            'email' => $email
        ];

        $result = $this->executeQuery($sql, $params);

        if (!empty($result)) {
            return (int)$result[0]->{'COUNT(*)'} > 0;
        }

        return false;
    }

    // Verifica se os dados de login estão cadastrados no banco de dados
    public function checkCredentials($email, $password)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";

        $params = [
            'email' => $email
        ];

        $result = $this->executeQuery($sql, $params);

        if ($result) {
            $userData = $result[0];
            if (password_verify($password, $userData->getPassword())) {
                return $userData;
            }
        }

        return false;
    }
    
    // Insere registros
    /*public function insert(array $data)
    {
        // Pega os nomes válidos das colunas da tabela
        $validColumns = $this->getTableColumns();

        // Filtra apenas as colunas válidas do array de dados
        $filteredData = array_intersect_key($data, array_flip($validColumns));

        // Verifica se tem colunas válidas
        if (empty($filteredData)) {
            throw new \InvalidArgumentException("Nenhum nome de coluna válido fornecido.");
        }

        // Verifica se há dados válidos antes de prosseguir com a inserção
        if (empty(array_filter($filteredData))) {
            throw new \InvalidArgumentException("Nenhum dado válido fornecido para inserção.");
        }

        // Gerar placeholders para colunas válidas
        $columns = implode(", ", array_keys($filteredData));
        $placeholders = ":" . implode(", :", array_keys($filteredData));

        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";

        // Executa a consulta
        $stmt = $this->executeQuery($sql, $filteredData);

        // Retorna o último ID inserido
        return Database::getConnection()->lastInsertId();
    }*/

    public function insert(object $object)
    {
        $db = Database::getConnection();
        try {
            $params = $this->validationInsert($object);
            $columns = implode(", ", array_keys($params));
            $values = ":" . implode(", :", array_keys($params));

            $sql = "INSERT INTO " . $this->table . " ($columns) "
                    . "VALUES($values)";

            $stmt = $db->prepare($sql);
            $stmt->execute($this->filter($params));
            return $this->lastInsertId();
        } catch (PDOException $ex) {
            $this->exception = $ex;
            $this->message = $ex->getMessage();
            return null;
        }
    }

    // Atualiza registro
    /*public function update(array $data, $id)
    {
        // Obter os nomes válidos das colunas da tabela
        $validColumns = $this->getTableColumns();

        // Filtrar apenas as colunas válidas do array de dados
        $filteredData = array_intersect_key($data, array_flip($validColumns));

        // Verificar se há colunas válidas após a filtragem
        if (empty($filteredData)) {
            throw new \InvalidArgumentException("Nenhum nome de coluna válido fornecido.");
        }

        $params = array_merge($filteredData, ['id' => $id]);

        $placeholders = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($filteredData)));

        $sql = "UPDATE " . $this->table . " SET $placeholders WHERE id = :id";

        $result = $this->executeQuery($sql, $params);
        
        if (!empty($result)) {
            return reset($result);
        } else {
            return null;
        }
    }*/
    
    public function update(object $object, string $restriction)
    {
        
        $db = Database::getConnection();
        
        try {
            $params = $this->validationUpdate($object);
            $arraySet = [];
            foreach ($params as $bind => $value) {
                $arraySet[] = "$bind = :$bind";
            }
            $arraySet = implode(", ", $arraySet);

            $sql = "UPDATE " . $this->table . " SET $arraySet WHERE $restriction";

            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            return ($stmt->rowCount() ?: 1);
        } catch (PDOException $ex) {
            $this->exception = $ex;
            $this->message = $ex->getMessage();
            return null;
        }
    }

    // Deletar um registro
    public function delete($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id LIMIT 1";

        $params = [
            'id' => $id
        ];

        return $this->executeQuery($sql, $params);
    }

    protected function filter(array $data): ?array
    {
        $filter = [];
        foreach ($data as $key => $value) {
            $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
        }
        return $filter;
    }
    
    private function validationInsert(object $object): array
    {
        $params = [];
        $methods = get_class_methods(get_class($object));

        foreach ($methods as $value) {
            if (preg_match("/^set/", $value)) {
                $nameProperty = lcfirst(str_replace("set", "", $value));
                $nameMethod = "get{$nameProperty}";
                $value = $object->$nameMethod();

                if ($value !== null && $value !== '') {
                    $params[$nameProperty] = $value;
                }
            }
        }

        return $params;
    }
    
    private function validationUpdate(object $object): array
    {
        $params = [];
        $methods = get_class_methods(get_class($object));

        foreach ($methods as $value) {
            if (preg_match("/^set/", $value)) {
                $nameProperty = lcfirst(str_replace("set", "", $value));
                $nameMethod = "get$nameProperty";
                $value = $object->$nameMethod();

                if ($value !== null) {
                    $params[$nameProperty] = $value;
                }
            }
        }

        return $params;
    }

    public function lastInsertId(): int
    {
        $db = Database::getConnection();
        return $db->lastInsertId();
    }

    public function lastId(string $tableParam = ""): ?int
    {
        try {
            $table = $this->validationTable($tableParam);

            return DB::getInstance()->query("SELECT MAX(id) as maxId FROM $table")->fetch()->maxId + 1;
        } catch (PDOException $ex) {
            $this->exception = $ex;
            $this->message = $ex->getMessage();
            return null;
        }
    }
}
