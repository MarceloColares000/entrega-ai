<?php

namespace App\Functions;

class Database
{
    // Variável estática para armazenar a conexão
    private static $connection;

    // Função para obter uma conexão com o banco de dados
    public static function getConnection()
    {
        // Se a conexão ainda não foi criada, cria uma nova
        if (!isset(self::$connection)) {
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'entrega_ai_bd';

            // Cria uma nova conexão PDO com as configurações fornecidas
            self::$connection = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            // Define atributos da conexão
            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }

        // Retorna a conexão
        return self::$connection;
    }
}
