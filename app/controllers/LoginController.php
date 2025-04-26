<?php

require_once __DIR__ . '/../../DAO/UsuarioDAO.php';  //Carregando a classe de acesso ao banco

class LoginController extends Controller {
    public function index() {
        $this->view('login/index'); //Carregar a página de login
    }

    public function autenticar() {
        //Pega as informações do login
        $login = $_POST['login'] ?? ''; //O login do campo no formulário
        $senha = $_POST['senha'] ?? ''; //A senha do campo no formulário

        //Verifica se o login e a senha foram preenchidos
        if (empty($login) || empty($senha)) {
            $_SESSION['erro'] = 'Login e senha são obrigatórios!';
            header('Location: /ecoPoint/login'); //Redireciona de volta para o login
            exit;
        }

        //Aqui estamos instanciando a classe UsuarioDAO
        $usuarioDAO = new UsuarioDAO();

        //Chama o método para buscar o usuário pelo login
        $usuario = $usuarioDAO->buscarPorLogin($login);

        //Verifica se o usuário foi encontrado e se a senha confere
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            //Inicia a sessão e armazena os dados do usuário
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email']
            ];

            //Redireciona para a página desejada
            header('Location: /ecoPoint/sobre'); 
            exit;
        } else {
            //Caso login ou senha estejam errados
            $_SESSION['erro'] = 'Usuário ou senha incorretos!';
            header('Location: /ecoPoint/login'); //Redireciona de volta para o login
            exit;
        }
    }
}

?>
