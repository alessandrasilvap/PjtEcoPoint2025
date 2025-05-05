<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Carrega as classes essenciais
require_once 'config/config.php';
require_once 'app/core/App.php';
require_once 'app/core/Controller.php';

//Cria o objeto da aplicação e inicia o roteamento
$app = new App();
?>