<?php

class AdminController extends Controller {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO(); //Ou passar a conexão/DAO via injeção de dependência
    }

    public function gerenciarUsuarios() {
        $usuarios = $this->usuarioDAO->listarTodos(); //Crie um método no DAO para isso
        $this->view('crud/crud', ['usuarios' => $usuarios]);
    }

    public function criarUsuario() {
        //Lógica para adicionar (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['criar'])) {
            $login = $_POST['login'];
            $email = $_POST['email'];
            //Adicionar validações aqui
            $this->usuarioDAO->criar($login, $email); //Crie um método criar no DAO
            header("Location: " . BASE_URL . "/admin/gerenciarUsuarios");
            exit;
        }
        //Pode haver uma view para o formulário de criação se for separado
    }

    public function editarUsuario($id) {
        //Lógica para exibir formulário de edição (GET)
        if (isset($_GET['editar'])) {
            $usuario = $this->usuarioDAO->buscarPorId($id); //Crie um método buscarPorId no DAO
            if (!$usuario) {
                //Tratar erro: usuário não encontrado
                echo "<script>alert('Usuário não encontrado.'); window.location.href='...'</script>";
                exit;
            }
            $this->view('crud/crud', ['usuarioParaEdicao' => $usuario, 'usuarios' => $this->usuarioDAO->listarTodos()]); // Passar dados para a view
        }
        //Lógica para atualizar (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
            $id = $_POST['id'];
            $login = $_POST['login'];
            $email = $_POST['email'];
            //Adicionar validações aqui
            $this->usuarioDAO->atualizar($id, $login, $email); //Crie um método atualizar no DAO
            header("Location: " . BASE_URL . "/admin/gerenciarUsuarios");
            exit;
        }
    }

    public function excluirUsuario($id) {
        //Lógica para excluir (GET ou POST)
        if (isset($_GET['excluir'])) {
            $this->usuarioDAO->excluir($id); //Crie um método excluir no DAO
            header("Location: " . BASE_URL . "/admin/gerenciarUsuarios");
            exit;
        }
    }
}
