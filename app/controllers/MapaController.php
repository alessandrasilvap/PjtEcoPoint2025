<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class MapaController extends Controller {
    public function __construct() {
        AuthMiddleware::check(); // Verifica se o usuário está logado
    }

    public function index() {
        $this->view('mapa/index'); // Mostra a view da tela de mapa
    }
}

?>
