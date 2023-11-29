<?php

namespace App\Models\DAO;

use App\Functions\GenericDAO;
use App\Functions\Database;
use App\Models\Delivery;
use App\Models\VehicleType;

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

    // Pegar o todos os pedidos do usuário
    public function getDeliveries($user_id)
    { 
        $sql = "
        SELECT 
        deliveries.*, 
        vehicles.id AS vehicle_id, 
        vehicles.brand AS vehicle_brand, 
        vehicles.model AS vehicle_model, 
        vehicles.plate_number AS vehicle_plate_number, 
        vehicles.color AS vehicle_color, 
        vehicle_types.type_name AS vehicle_type_name, 
        vehicle_types.base_rate AS vehicle_base_rate, 
        vehicle_types.rate_per_km AS vehicle_rate_per_km,
        drivers.id AS driver_id,
        drivers.name AS driver_name,
        delivery_status.status_name AS delivery_status_name,
        delivery_status.status_description AS delivery_status_description,
        delivery_status.icon AS delivery_icon,
        delivery_status.css_class AS delivery_css_class,
        AVG(ratings.rating) AS average_rating
        FROM deliveries
        JOIN vehicle_types ON deliveries.vehicle_type_id = vehicle_types.id
        LEFT JOIN drivers ON deliveries.driver_id = drivers.id
        LEFT JOIN ratings ON deliveries.driver_id = ratings.driver_id
        LEFT JOIN delivery_status ON deliveries.delivery_status_id = delivery_status.id
        LEFT JOIN vehicles ON deliveries.vehicle_id = vehicles.id
        WHERE deliveries.user_id = :user_id
        GROUP BY 
        deliveries.id,
        vehicles.id,
        drivers.id,
        vehicle_types.id,
        delivery_status.id
        ORDER BY deliveries.created_at DESC;
        ";

        $params = [
            'user_id' => $user_id,
        ];

        return $this->executeQuery($sql, $params);
    }

    // Pegar o todos os pedidos do usuário
    public function getDeliveryId($delivery_id)
    { 
        $sql = "
        SELECT 
        deliveries.*,
        vehicles.id AS vehicle_id, 
        vehicles.brand AS vehicle_brand, 
        vehicles.model AS vehicle_model, 
        vehicles.plate_number AS vehicle_plate_number, 
        vehicles.color AS vehicle_color,
        vehicle_types.id AS vehicle_type_id, 
        vehicle_types.type_name AS vehicle_type_name, 
        vehicle_types.base_rate AS vehicle_base_rate, 
        vehicle_types.rate_per_km AS vehicle_rate_per_km,
        drivers.name AS driver_name,
        delivery_status.status_name AS delivery_status_name,
        delivery_status.status_description AS delivery_status_description,
        delivery_status.icon AS delivery_icon,
        delivery_status.css_class AS delivery_css_class
        FROM deliveries
        JOIN vehicle_types ON deliveries.vehicle_type_id = vehicle_types.id
        LEFT JOIN drivers ON deliveries.driver_id = drivers.id
        LEFT JOIN delivery_status ON deliveries.delivery_status_id = delivery_status.id
        LEFT JOIN vehicles ON deliveries.vehicle_id = vehicles.id
        WHERE deliveries.delivery_id = :delivery_id
        ORDER BY deliveries.created_at DESC;
        ";

        $params = [
            'delivery_id' => $delivery_id,
        ];

        return $this->executeQuery($sql, $params);
    }

    // Pegar o todos os pedidos do motorista
    public function getDeliveriesDriver($driver_id)
    { 
        $sql = "
        SELECT 
        deliveries.*, 
        vehicles.id AS vehicle_id, 
        vehicles.brand AS vehicle_brand, 
        vehicles.model AS vehicle_model, 
        vehicles.plate_number AS vehicle_plate_number, 
        vehicles.color AS vehicle_color,
        vehicle_types.id AS vehicle_type_id, 
        vehicle_types.type_name AS vehicle_type_name, 
        vehicle_types.base_rate AS vehicle_base_rate, 
        vehicle_types.rate_per_km AS vehicle_rate_per_km,
        drivers.id AS driver_id,
        drivers.name AS driver_name,
        delivery_status.status_name AS delivery_status_name,
        delivery_status.status_description AS delivery_status_description,
        delivery_status.icon AS delivery_icon,
        delivery_status.css_class AS delivery_css_class
        FROM deliveries
        JOIN vehicle_types ON deliveries.vehicle_type_id = vehicle_types.id
        LEFT JOIN drivers ON deliveries.driver_id = drivers.id
        LEFT JOIN delivery_status ON deliveries.delivery_status_id = delivery_status.id
        LEFT JOIN vehicles ON deliveries.vehicle_id = vehicles.id
        WHERE deliveries.driver_id = :driver_id
        ORDER BY deliveries.created_at DESC;
        ";

        $params = [
            'driver_id' => $driver_id,
        ];

        return $this->executeQuery($sql, $params);
    }

    /*
    public function getDeliveryById($delivery_id){
        $sql = "

        SELECT * FROM deliveries WHERE delivery_id = :delivery_id

        ";

        $params = [
            'delivery_id' => $delivery_id
        ];
    }
    */

    // Pegar o todos os pedidos disponíveis
    public function getAvailableDeliveries()
    { 
        $sql = "
        SELECT 
        deliveries.*, users.*, 
        users.name AS user_name, 
        vehicle_types.id AS vehicle_type_id, 
        vehicle_types.type_name AS vehicle_type_name, 
        vehicle_types.base_rate AS vehicle_base_rate, 
        vehicle_types.rate_per_km AS vehicle_rate_per_km,
        drivers.id AS driver_id,
        drivers.name AS driver_name,
        delivery_status.status_name AS delivery_status_name,
        delivery_status.status_description AS delivery_status_description,
        delivery_status.icon AS delivery_icon,
        delivery_status.css_class AS delivery_css_class
        FROM deliveries
        JOIN vehicle_types ON deliveries.vehicle_type_id = vehicle_types.id
        LEFT JOIN drivers ON deliveries.driver_id = drivers.id
        LEFT JOIN users ON deliveries.user_id = users.id
        LEFT JOIN delivery_status ON deliveries.delivery_status_id = delivery_status.id
        WHERE deliveries.delivery_status_id = 1
        ORDER BY deliveries.total_price DESC;
        ";

        return $this->executeQuery($sql);
    }


    // Atualiza registro
    public function updateDelivery(array $data, $delivery_id)
    {
        // Obter os nomes válidos das colunas da tabela
        $validColumns = $this->getTableColumns();

        // Filtrar apenas as colunas válidas do array de dados
        $filteredData = array_intersect_key($data, array_flip($validColumns));

        // Verificar se há colunas válidas após a filtragem
        if (empty($filteredData)) {
            throw new \InvalidArgumentException("Nenhum nome de coluna válido fornecido.");
        }

        $params = array_merge($filteredData, ['delivery_id' => $delivery_id]);

        $placeholders = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($filteredData)));

        $sql = "UPDATE deliveries SET $placeholders WHERE delivery_id = :delivery_id";

        $result = $this->executeQuery($sql, $params);
        
        if (!empty($result)) {
            return reset($result);
        } else {
            return null;
        }

    }

    // Atualiza registro
    public function updateCoordenades($latitude, $longitude, $delivery_id)
    {

        $db = Database::getConnection();

        // Prepare a query
        $sql = "UPDATE deliveries SET current_latitude = :latitude, current_longitude = :longitude WHERE delivery_id = :delivery_id";
        $stmt = $db->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindParam(':latitude', $latitude);
        $stmt->bindParam(':longitude', $longitude);
        $stmt->bindParam(':delivery_id', $delivery_id);

        // Execute a query
        $stmt->execute();

        // Verificar se a query foi executada com sucesso
        return $stmt->rowCount() > 0;
    }


    public function getCoordinates($delivery_id)
    {   
        $db = Database::getConnection();
        
        $sql = "SELECT current_latitude, current_longitude FROM deliveries WHERE delivery_id = :delivery_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':delivery_id', $delivery_id);
        $stmt->execute();

        // Retorna as coordenadas atualizadas como um array associativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }




    public function getTrackingDelivery($user_id, $delivery_id)
    {
        $sql = "
            SELECT 
                deliveries.*, 
                vehicles.id AS vehicle_id, 
                vehicles.brand AS vehicle_brand, 
                vehicles.model AS vehicle_model, 
                vehicles.plate_number AS vehicle_plate_number, 
                vehicles.color AS vehicle_color,
                vehicle_types.id AS vehicle_type_id, 
                vehicle_types.type_name AS vehicle_type_name, 
                vehicle_types.base_rate AS vehicle_base_rate, 
                vehicle_types.rate_per_km AS vehicle_rate_per_km,
                drivers.name AS driver_name,
                delivery_status.status_name AS delivery_status_name,
                delivery_status.status_description AS delivery_status_description,
                delivery_status.icon AS delivery_icon,
                delivery_status.css_class AS delivery_css_class
            FROM deliveries
            JOIN vehicle_types ON deliveries.vehicle_type_id = vehicle_types.id
            LEFT JOIN drivers ON deliveries.driver_id = drivers.id
            LEFT JOIN delivery_status ON deliveries.delivery_status_id = delivery_status.id
            LEFT JOIN vehicles ON deliveries.vehicle_id = vehicles.id
            WHERE deliveries.user_id = :user_id AND deliveries.id = :delivery_id
            ORDER BY deliveries.created_at DESC;
        ";

        $params = [
            'user_id' => $user_id,
            'delivery_id' => $delivery_id,
        ];

        return $this->executeQuery($sql, $params);
    }

   


    

}
