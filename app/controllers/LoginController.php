<?php

require_once __DIR__ . '/../../DAO/usuarioDAO.php';

class LoginController extends Controller {
    public function index() {
        $this->view('login/index'); // Carrega a página de login
    }

        public function autenticar() {
        //Pega os dados enviados via POST
        $login = trim(strip_tags($_POST['login'] ?? ''));
        $senha = $_POST['senha'] ?? '';


        // Validação inicial
        if (empty($login) || empty($senha)) {
            echo json_encode([
                'sucesso' => false,
                'erro' => 'Login e senha são obrigatórios.'
            ]);
            return;
        }

        // Consulta o banco
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->buscarPorLogin($login);

        // Verifica o usuário e a senha
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email']
            ];

            // Sucesso: retorna JSON indicando login válido
            echo json_encode([
                'sucesso' => true
            ]);
        } else {
            // Erro de login: retorna JSON com mensagem
            echo json_encode([
                'sucesso' => false,
                'erro' => 'Usuário ou senha incorretos.'
            ]);
        }
    }
}