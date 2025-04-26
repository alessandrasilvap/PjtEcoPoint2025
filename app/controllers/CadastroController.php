<?php

require_once __DIR__ . '/../models/Usuario.php';  //Carregando o modelo de usuário
require_once __DIR__ . '/../../DAO/UsuarioDAO.php';  //Carregando a classe de acesso ao banco

class CadastroController extends Controller {

    public function index() {
        //Exibe o formulário de cadastro
        $this->view('cadastro/index');
    }

    public function salvar() {
        //Verifica se o método de requisição é POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            //Obtém os dados do formulário
            $dados = [
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'cpf' => $_POST['cpf'],
                'login' => $_POST['login'],
                'senha' => $_POST['senha'],
                'endereco' => $_POST['endereco'],
                'cidade' => $_POST['cidade'],
                'bairro' => $_POST['bairro'],
                'cep' => $_POST['cep'],
                'numero' => $_POST['numero'],
                'complemento' => $_POST['complemento'],
                'telefone' => $_POST['telefone'],
                'nascimento' => $_POST['nascimento']
            ];
            
            //Criação de objeto Usuario
            $usuario = new Usuario();
            $usuario->setDados($dados);
            
            //Criação do objeto UsuarioDAO para salvar no banco
            $usuarioDAO = new UsuarioDAO();
            
            if ($usuarioDAO->inserir($usuario)) {
                //Se o cadastro for bem-sucedido, redireciona para a página de login
                header("Location: /ecoPoint/login");
                exit;
            } else {
                //Caso ocorra algum erro, exibe mensagem
                echo "Erro ao cadastrar o usuário. Tente novamente!";
            }
        }
    }

    //Método para validações, caso necessário
    private function validarDados($dados) {
        //Validação simples de campos vazios
        foreach ($dados as $campo => $valor) {
            if (empty($valor)) {
                return "Campo {$campo} não pode ser vazio!";
            }
        }

        //Validar CPF, Email ou outros, se necessário

        return true;
    }
}

?>
