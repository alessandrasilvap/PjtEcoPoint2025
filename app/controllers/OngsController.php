<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class OngsController extends Controller {
    public function __construct() {
        AuthMiddleware::check();
    }

    
    public function index() {
        $this->view('ongs/index');
    }
}

?>