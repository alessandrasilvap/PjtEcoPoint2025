<?php

class Controller {
    public function view($view, $dados = []) {
        extract($dados);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }


    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}

?>