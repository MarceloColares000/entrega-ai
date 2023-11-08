<?php

namespace App\Functions;

class Layout
{
    // Função para renderizar um layout com conteúdo
    public static function render($content, $layout = 'default')
    {
        // Caminho para o arquivo do layout
        $layoutPath = "app/views/_layouts/{$layout}.php";

        // Verifica se o arquivo do layout existe
        if (!file_exists($layoutPath)) {
            // Se o layout não for encontrado, lança uma exceção
            throw new \Exception("Layout '{$layout}' not found.");
        }

        // Renderiza o layout
        require $layoutPath;
    }
}
