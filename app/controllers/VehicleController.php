<?php

namespace App\Controllers;

use App\Models\Vehicle;
use App\Models\DAO\VehicleDAO;
use App\Models\VehicleType;
use App\Models\DAO\VehicleTypeDAO;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class VehicleController
{   

    public function renderVehicles()
    {   
        // Verificar se o usuário já está autenticado
        if (!isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/login');
        }

        // Verificar se o motorista já está autenticado
        if (isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/dashboard');
        }

        $driver_id = (int) $_SESSION['driver_id'];

        $VehiclesDAO = new VehicleDAO();
        $vehicles = $VehiclesDAO->getByConditions("driver_id  = $driver_id");

        $VehicleTypeDAO = new VehicleTypeDAO();
        $typeVehicles = $VehicleTypeDAO->getAll();
        
        $title = "Meus veículos | Entrega aí";
        $data = [
            'title' => $title,
            'vehicles' => $vehicles,
            'typeVehicles' => $typeVehicles,
            'menuDinamic' => '/veiculos'
        ];

        View::render('drivers/vehicles', $data, 'default');
        
    }

    public function addVehicle()
    {   
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('motorista/veiculos');
        }

        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['vehicle_type_id', 'plate_number', 'brand', 'model', 'color', 'manufacture_year', 'details'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('motorista/veiculos');
        }

        $driver_id = (int) $_SESSION['driver_id'];

        // Instância e atribuição dos atributos
        $vehicle = new Vehicle();
        $vehicle->setVehicle_type_id($_POST['vehicle_type_id']);
        $vehicle->setDriver_id($driver_id);
        $vehicle->setPlate_number($_POST['plate_number']);
        $vehicle->setBrand($_POST['brand']);
        $vehicle->setModel($_POST['model']);
        $vehicle->setColor($_POST['color']);
        $vehicle->setManufacture_year($_POST['manufacture_year']);
        $vehicle->setDetails($_POST['details']);
            
        $vehicleDAO = new VehicleDAO();

        $insertedVehicleId = $vehicleDAO->insert($vehicle);

        if ($insertedVehicleId > 0) {
            $_SESSION['msg'] = Message::success("Veículo cadastrado com sucesso!");
            Helpers::redirect('motorista/veiculos');
        } else {
            $_SESSION['msg'] = Message::error("Erro ao cadastrar o veículo. Tente novamente!");
            Helpers::redirect('motorista/veiculos');
        }  
    }

    //Atualizar veículo
    public function updateVehicle()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('motorista/veiculos');
        }

        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['plate_number', 'brand', 'model', 'color', 'manufacture_year', 'details'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('motorista/veiculos');
        }

        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $driver_id = isset($_SESSION['driver_id']) ? (int)$_SESSION['driver_id'] : null;

        $vehicle = new Vehicle();
        $vehicle->setDriver_id($driver_id);
        $vehicle->setPlate_number($_POST['plate_number']);
        $vehicle->setBrand($_POST['brand']);
        $vehicle->setModel($_POST['model']);
        $vehicle->setColor($_POST['color']);
        $vehicle->setManufacture_year($_POST['manufacture_year']);
        $vehicle->setDetails($_POST['details']);

        $vehicleDAO = new VehicleDAO();

        // Verifica se o veículo pertence ao motorista
        $isDriverVehicle = $vehicleDAO->getByConditions("driver_id = $driver_id AND id = $id");

        if($isDriverVehicle){

            $updatedVehicle = $vehicleDAO->update($vehicle, "id = {$id}");

            if ($updatedVehicle) {
                $_SESSION['msg'] = Message::success("Veículo atualizado com sucesso!");
                Helpers::redirect('motorista/veiculos');
            } else {
                $_SESSION['msg'] = Message::error("Erro ao atualizar o veículo. Tente novamente!");
                Helpers::redirect('motorista/veiculos');
            }

        } else {
            $_SESSION['msg'] = Message::error("Erro ao atualizar o veículo. Tente novamente!");
            Helpers::redirect('motorista/veiculos');
        }
    
    }

    // Deletar o veículo
    public function deleteVehicle()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('');
        }

        // Verifica se existe o ID e se ele é um inteiro
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $driver_id = isset($_SESSION['driver_id']) ? (int)$_SESSION['driver_id'] : null;

        if ($id) {
            
            $vehicleDAO = new VehicleDAO();
            $vehicle = $vehicleDAO->getById($id);

            // Verifica se o veículo pertence ao motorista
            $isDriverVehicle = $vehicleDAO->getByConditions("driver_id = $driver_id AND id = $id");

            if($isDriverVehicle){

                if ($vehicle) {
                
                    $deleted = $vehicleDAO->delete($id);

                    $_SESSION['msg'] = Message::success("Veículo excluído com sucesso!");
                    Helpers::redirect('motorista/veiculos');

                } else {
                    $_SESSION['msg'] = Message::warning("Erro ao tentar excluir seu veículo. Tente novamente.");
                    Helpers::redirect('motorista/veiculos');
                }

            } else {
                $_SESSION['msg'] = Message::warning("Erro ao tentar excluir seu veículo. Tente novamente.");
                Helpers::redirect('motorista/veiculos');
            }
        
        } else {
            $_SESSION['msg'] = Message::error("Erro ao tentar excluir seu veículo. Operação não permitida.");
            Helpers::redirect('motorista/veiculos');
        }

    }

}
