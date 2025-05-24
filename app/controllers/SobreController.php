<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';


class SobreController extends Controller {
    public function __construct() {
        AuthMiddleware::check();
    }

    
    public function index() {
        $this->view('sobre/index');
    }
}

?>