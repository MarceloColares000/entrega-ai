<?php

namespace App\Functions;

class View
{
    // Função para renderizar a view com um layout
    public static function render($viewPath, $data = [], $layout = 'default')
    {
        // Obtém o conteúdo da view
        $content = self::getContent($viewPath, $data);

        // Define o título da página
        $title = isset($data['title']) ? htmlspecialchars($data['title'], ENT_QUOTES, 'UTF-8') : 'Entrega aí | Serviço de entregas rápidas';

        // Verifica se o arquivo de layout customizado existe
        $layoutFile = 'app/views/_layouts/' . $layout . '.php';
        if (!file_exists($layoutFile)) {
            // Se o layout customizado não existir, usa o layout padrão
            $layout = 'default';
        }

        // Renderiza o layout
        ob_start();
        require 'app/views/_layouts/' . $layout . '.php';
        ob_end_flush();
    }

    // Função para obter o conteúdo da view
    private static function getContent($viewPath, $data)
    {
        // Extrai os dados do array associativo para variáveis individuais
        extract($data);

        // Inicia o buffer de saída
        ob_start();

        // Carrega a view a partir do caminho especificado
        require 'app/views/' . $viewPath . '.php';

        // Retorna o conteúdo do buffer de saída e limpa o buffer
        return ob_get_clean();
    }
}

