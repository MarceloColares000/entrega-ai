<?php

namespace App\Controllers;

use App\Models\Card;
use App\Models\DAO\CardDAO;
use App\Functions\Database;
use App\Functions\View;
use App\Functions\Message;
use App\Functions\Layout;
use App\Functions\Helpers;

class CardController
{   

    public function renderCard()
    {   
        // Verificar se o usuário já está autenticado
        if (!isset($_SESSION['user_id'])) 
        {
            Helpers::redirect('usuario/login');
        }

        // Verificar se o motorista já está autenticado
        if (isset($_SESSION['driver_id'])) 
        {
            Helpers::redirect('motorista/dashboard');
        }

        $user_id = (int) $_SESSION['user_id'];

        $cardsDAO = new CardDAO();
        $cards = $cardsDAO->getByConditions("user_id  = $user_id");

        $title = "Meus cartões | Entrega aí";
        $data = [
            'title' => $title,
            'cards' => $cards,
            'menuDinamic' => '/cartoes'
        ];

        View::render('users/card', $data, 'default');
        
    }

    public function addCard()
    {   
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/cartoes');
        }

        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['card_number', 'cardholder_name', 'expiration_date', 'cvv'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('usuario/cartoes');
        }

        $user_id = (int) $_SESSION['user_id'];

        // Instância e atribuição dos atributos
        $card = new Card();
        $card->setUser_Id($user_id);
        $card->setCard_number($_POST['card_number']);
        $card->setCardholder_name($_POST['cardholder_name']);
        $card->setExpiration_date($_POST['expiration_date']);
        $card->setCvv($_POST['cvv']);
            
        $cardDAO = new CardDAO();

        $insertedCardId = $cardDAO->insert($card);

        if ($insertedCardId > 0) {
            $_SESSION['msg'] = Message::success("Cartão cadastrado com sucesso!");
            Helpers::redirect('usuario/cartoes');
        } else {
            $_SESSION['msg'] = Message::error("Erro ao cadastrar o cartão. Tente novamente!");
            Helpers::redirect('usuario/cartoes');
        }  
    }

    //Atualizar cartão
    public function updateCard()
    {   
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helpers::redirect('usuario/cartoes');
        }

        // Verifica se os campos obrigatórios estão preenchidos
        $requiredFields = ['card_number', 'cardholder_name', 'expiration_date', 'cvv'];

        if (!Helpers::checkEmptyFields($requiredFields)) {
            $_SESSION['msg'] = Message::error("Preencha todos os campos!");
            Helpers::redirect('usuario/cartoes');
        }

        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $user_id = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

        $card = new Card();
        $card->setCard_number($_POST['card_number']);
        $card->setCardholder_name($_POST['cardholder_name']);
        $card->setExpiration_date($_POST['expiration_date']);
        $card->setCvv($_POST['cvv']);

        $cardDAO = new CardDAO();

        // Verifica se o cartão pertence ao usuario
        $isUserCard = $cardDAO->getByConditions("user_id = $user_id AND id = $id");

        if($isUserCard){

            $updatedCard = $cardDAO->update($card, "id = {$id}");

            if ($updatedCard) {
                $_SESSION['msg'] = Message::success("Cartão atualizado com sucesso!");
                Helpers::redirect('usuario/cartoes');
            } else {
                $_SESSION['msg'] = Message::error("Erro ao atualizar o cartão. Tente novamente!");
                Helpers::redirect('usuario/cartoes');
            }

        } else {
            $_SESSION['msg'] = Message::error("Erro ao atualizar o cartão. Tente novamente!");
            Helpers::redirect('usuario/cartoes');
        }

    
    }

    // Deletar o cartão
    public function deleteCard()
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
                    Helpers::redirect('usuario/cartoes');

                } else {
                    $_SESSION['msg'] = Message::warning("Erro ao tentar excluir seu cartão. Tente novamente.");
                    Helpers::redirect('usuario/cartoes');
                }

            } else {
                $_SESSION['msg'] = Message::error("Erro ao apagar o cartão. Tente novamente!");
                Helpers::redirect('usuario/cartoes');
            }
        
        } else {
            $_SESSION['msg'] = Message::error("Erro ao tentar excluir seu cartão. Operação não permitida.");
            Helpers::redirect('usuario/cartoes');
        }

    }

}
