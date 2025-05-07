<?php

class AuthMiddleware {
    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //Verifica se a sessão do usuário está ativa
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
            header('Location: /ecoPoint/login');
            exit();
        }
    }
}

?>