<?php

require_once __DIR__ . '/../DAO/UsuarioDAO.php'; // Ajuste o caminho conforme sua estrutura
require_once __DIR__ . '/../core/Controller.php'; // Ajuste o caminho conforme sua estrutura


class AdminController extends Controller {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO(Conexao::getConexao());
    }

    
    /*
    Exibe a página de gerenciamento de usuários com a lista completa.
    Esta será a ação principal para exibir a view do CRUD.
     */
    public function index() {
        $this->gerenciarUsuarios(); //Redireciona para o método que já faz a lógica de listar
    }

    
    public function gerenciarUsuarios($feedbackMessage = null, $feedbackMessageType = 'success') {
        $usuarios = $this->usuarioDAO->listarTodos(); //Chama o método do DAO

        //Passa os dados e a mensagem de feedback para a view
        $this->view('crud/index', [
            'usuarios' => $usuarios,
            'feedbackMessage' => $feedbackMessage,
            'feedbackMessageType' => $feedbackMessageType
        ]);
    }

    
    //Processa a requisição para criar um novo usuário.
    public function criarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $email = $_POST['email'] ?? '';

            //Validações de Dados
            if (empty($login) || empty($email)) {
                $this->gerenciarUsuarios('Login e E-mail são obrigatórios!', 'error');
                return;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->gerenciarUsuarios('Formato de e-mail inválido!', 'error');
                return;
            }

            $existingUser = $this->usuarioDAO->buscarPorLoginOuEmail($login, $email, $id ?? null); //Passe $id em atualização
            if ($existingUser) {
                $this->gerenciarUsuarios('Login ou E-mail já estão em uso!', 'error');
                return;
            }

            try {
                $this->usuarioDAO->criar($login, $email); //Chama o método do DAO
                header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Usuário '$login' criado com sucesso!") . "&type=success");
                exit;
            } catch (Exception $e) {
                //Tratar erro, por exemplo, duplicidade de login/email ou erro de DB
                $this->gerenciarUsuarios('Erro ao criar usuário: ' . $e->getMessage(), 'error');
                return;
            }
        }
        //Se a requisição não for POST para criar, redireciona para a página de gerenciamento
        header("Location: " . BASE_URL . "/admin/gerenciarUsuarios");
        exit;
    }

    
    /*
    Exibe o formulário de edição pré-preenchido ou processa a atualização.
    @param int|null $id O ID do usuário a ser editado, vindo da rota.
     */
    public function editarUsuario($id = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id !== null) {
            $usuario = $this->usuarioDAO->buscarPorId($id); //Chama o método do DAO

            if (!$usuario) {
                header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Usuário não encontrado!") . "&type=error");
                exit;
            }
            //Passa o usuário para edição e a lista completa para a view
            $this->view('crud/index', [
                'usuarioParaEdicao' => $usuario,
                'usuarios' => $this->usuarioDAO->listarTodos() //Mantém a lista visível
            ]);
        } else {
            //Se não for GET com ID válido, redireciona de volta para a lista
            header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Requisição de edição inválida.") . "&type=error");
            exit;
        }
    }

    
    //Processa a requisição para atualizar um usuário.
    public function atualizarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
            $id = $_POST['id'] ?? null;
            $login = $_POST['login'] ?? '';
            $email = $_POST['email'] ?? '';

            //Validações de Dados
            if (empty($id) || empty($login) || empty($email)) {
                $this->gerenciarUsuarios('Dados incompletos para atualização!', 'error');
                return;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->gerenciarUsuarios('Formato de e-mail inválido!', 'error');
                return;
            }
            //Lembre-se de validar a unicidade do login/email, excluindo o próprio usuário da verificação

            $existingUser = $this->usuarioDAO->buscarPorLoginOuEmail($login, $email, $id ?? null); //Passe $id em atualização
            if ($existingUser) {
                $this->gerenciarUsuarios('Login ou E-mail já estão em uso!', 'error');
                return;
            }

            try {
                $this->usuarioDAO->atualizar($id, $login, $email); //Chama o método do DAO
                header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Usuário ID $id atualizado com sucesso!") . "&type=success");
                exit;
            } catch (Exception $e) {
                $this->gerenciarUsuarios('Erro ao atualizar usuário: ' . $e->getMessage(), 'error');
                return;
            }
        }
        //Se a requisição não for POST para atualizar, redireciona para a página de gerenciamento
        header("Location: " . BASE_URL . "/admin/gerenciarUsuarios");
        exit;
    }


    /*
     Processa a requisição para excluir um usuário.
     @param int|null $id O ID do usuário a ser excluído, vindo da rota.
     */
    public function excluirUsuario($id = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $id !== null) { //Pode ser alterado para POST para maior segurança
            try {
                //Antes de excluir, você pode verificar se o usuário existe
                $usuario = $this->usuarioDAO->buscarPorId($id);
                if (!$usuario) {
                    header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Usuário não encontrado para exclusão!") . "&type=error");
                    exit;
                }

                $this->usuarioDAO->excluir($id); //Chama o método do DAO
                header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Usuário ID $id excluído com sucesso!") . "&type=success");
                exit;
            } catch (Exception $e) {
                header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Erro ao excluir usuário: " . $e->getMessage()) . "&type=error");
                exit;
            }
        } else {
            header("Location: " . BASE_URL . "/admin/gerenciarUsuarios?message=" . urlencode("Requisição de exclusão inválida.") . "&type=error");
            exit;
        }
    }
}

?>
