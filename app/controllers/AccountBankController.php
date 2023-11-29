<?php

namespace App\Controllers;

use App\Models\AccountBank;
use App\Models\DAO\AccountBankDAO;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class AccountBankController
{   

    public function renderAccountBank()
    {   
        // Verificar se o usuário já está autenticado
        if (isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/dashboard');
        }

        // Verificar se o motorista já está autenticado
        if (!isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/login');
        }

        $driver_id = (int) $_SESSION['driver_id'];

        $accountBankDAO = new AccountBankDAO();
        $accountBankDAO = $accountBankDAO->getByConditions("driver_id  = $driver_id");

        $title = "Minhas contas de pagamento | Entrega aí";
        $data = [
            'title' => $title,
            'accountBankDAO' => $accountBankDAO,
            'menuDinamic' => '/contas'
        ];

        View::render('drivers/account-bank', $data, 'default');
        
    }

    public function addAccountBank()
    {   
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('motorista/conta-bancaria');
        }

        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['account_number', 'account_holder_name', 'bank_name'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('motorista/conta-bancaria');
        }

        $driver_id = (int) $_SESSION['driver_id'];

        // Instância e atribuição dos atributos
        $accountBank = new AccountBank();
        $accountBank->setDriver_Id($driver_id);
        $accountBank->setAccount_number($_POST['account_number']);
        $accountBank->setAccount_holder_name($_POST['account_holder_name']);
        $accountBank->setBank_name($_POST['bank_name']);
            
        $accountBankDAO = new AccountBankDAO();

        $insertedaccountBankId = $accountBankDAO->insert($accountBank);

        if ($insertedaccountBankId > 0) {
            $_SESSION['msg'] = Message::success("Conta cadastrada com sucesso!");
            Helpers::redirect('motorista/conta-bancaria');
        } else {
            $_SESSION['msg'] = Message::error("Erro ao cadastrar conta. Tente novamente!");
            Helpers::redirect('motorista/conta-bancaria');
        }  
    }

    //Atualizar conta bancária
    public function updateAccountBank()
    {   
        
        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['account_number', 'account_holder_name', 'bank_name'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('motorista/conta-bancaria');
        }

        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $driver_id = isset($_SESSION['driver_id']) ? (int)$_SESSION['driver_id'] : null;

        $accountBank = new AccountBank();
        $accountBank->setDriver_Id($driver_id);
        $accountBank->setAccount_number($_POST['account_number']);
        $accountBank->setAccount_holder_name($_POST['account_holder_name']);
        $accountBank->setBank_name($_POST['bank_name']);
            
        $accountBankDAO = new AccountBankDAO();

        // Verifica se a conta pertence ao usuario
        $isDriverAccount = true;

        if($isDriverAccount){

            $updatedAccount = $accountBankDAO->update($accountBank, "id = {$id}");

            if ($updatedAccount) {
                $_SESSION['msg'] = Message::success("Conta bancária atualizada com sucesso!");
                Helpers::redirect('motorista/conta-bancaria');
            } else {
                $_SESSION['msg'] = Message::error("Erro ao atualizar a conta bancária. Tente novamente!");
                Helpers::redirect('motorista/conta-bancaria');
            }

        } else {
            $_SESSION['msg'] = Message::error("Erro ao atualizar a conta bancária. Tente novamente!");
            Helpers::redirect('motorista/conta-bancaria');
        }

    
    }

    // Deletar o cartão
    public function deleteAccountBank()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('');
        }

        // Verifica se existe o ID e se ele é um inteiro
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

        if ($id) {
            
            $cardDAO = new CardDAO();
            $card = $cardDAO->getById($id);

            // Verifica se o cartão pertence ao usuario
            $isUserCard = $cardDAO->getByConditions("user_id = $user_id AND id = $id");

            if($isUserCard){

                if ($card) {
                
                    $deleted = $cardDAO->delete($id);

                    $_SESSION['msg'] = Message::success("Cartão excluído com sucesso!");
                    Helpers::redirect('motorista/conta-bancaria');

                } else {
                    $_SESSION['msg'] = Message::warning("Erro ao tentar excluir seu cartão. Tente novamente.");
                    Helpers::redirect('motorista/conta-bancaria');
                }

            } else {
                $_SESSION['msg'] = Message::error("Erro ao apagar o cartão. Tente novamente!");
                Helpers::redirect('motorista/conta-bancaria');
            }
        
        } else {
            $_SESSION['msg'] = Message::error("Erro ao tentar excluir seu cartão. Operação não permitida.");
            Helpers::redirect('motorista/conta-bancaria');
        }

    }

}
