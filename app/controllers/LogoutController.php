<?php

class LogoutController extends Controller {
    public function index() {
        //Inicia a sessão (caso ainda não tenha sido iniciada)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        //Destroi a sessão (desfazendo o login)
        session_destroy();

        //Redireciona para a tela de login
        header('Location: /ecoPoint/login');
        exit();
    }
}

?>