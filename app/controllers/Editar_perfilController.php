<?php
session_start();
require_once __DIR__ . '/../../DAO/conexao.php';
require_once __DIR__ . '/../../DAO/usuarioDAO.php';


class UsuarioController {
    public function editarPerfil() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
            header("Location: /login/index.php");
            exit();
        }

        $usuarioId = $_SESSION['usuario']['id'];
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->buscarPorId($usuarioId);

        $mensagem = '';

        if (!isset($_SESSION['redirect_after_edit']) && isset($_SERVER['HTTP_REFERER'])) {
            if (strpos($_SERVER['HTTP_REFERER'], 'editar_perfil.php') === false) {
                $_SESSION['redirect_after_edit'] = $_SERVER['HTTP_REFERER'];
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
            $login = trim($_POST['login']);
            $email = trim($_POST['email']);

            $erros = [];

            if (empty($login)) {
                $erros[] = "O nome não pode ser vazio.";
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros[] = "O e-mail informado é inválido.";
            }

            if (count($erros) === 0) {
                $usuarioDAO->atualizarNomeEmail($usuarioId, $login, $email);
                $_SESSION['usuario']['login'] = $login;
                $_SESSION['usuario']['email'] = $email;
                $usuario['login'] = $login;
                $usuario['email'] = $email;

                $redirectTo = $_SESSION['redirect_after_edit'] ?? 'editar_perfil.php';
                unset($_SESSION['redirect_after_edit']);
                header("Location: $redirectTo?success=1");
                exit();
            } else {
                $mensagem = implode("<br>", $erros);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluirConta'])) {
            if (
                empty($_SESSION['csrf_token']) || 
                empty($_POST['csrf_token']) || 
                !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
            ) {
                die("CSRF Token inválido!");
            }

            if ($usuarioDAO->excluirConta($usuarioId)) {
                session_unset();
                session_destroy();
                header('Location: /ecoPoint/app/views/cadastro/index.php');
                exit();
            } else {
                $mensagem = "Erro ao excluir a conta.";
            }
        }

        return ['usuario' => $usuario, 'mensagem' => $mensagem];
    }
}




