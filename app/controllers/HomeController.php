<?php

require_once __DIR__ . '/../../DAO/quizDAO.php';
require_once __DIR__ . '/../../DAO/conexao.php';

class HomeController extends Controller {
    public function index() {
        //Carrega perguntas do banco
        $pdo = Conexao::getConexao();
        $quizModel = new Quiz();
        $perguntas = $quizModel->buscarPerguntasQuiz(7);

        //Carrega a view com as perguntas
        $this->view('home/index', ['perguntas' => $perguntas]);
    }
}

?>
