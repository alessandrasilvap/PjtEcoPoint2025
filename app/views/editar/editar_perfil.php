<?php
require_once __DIR__ . '/../../../DAO/conexao.php';
require_once __DIR__ . '/../../../DAO/usuarioDAO.php';

// Verifica se o usuário está logado, caso contrário, redireciona para a página de login

session_start(); // Inicia a sessão

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    // Redireciona para a página de login se não estiver logado
    header("Location: /login/index.php");
    exit();
}

$usuarioId = $_SESSION['usuario']['id'];

// Inclui o arquivo do DAO

require_once __DIR__ . '/../../../DAO/usuarioDAO.php';


// Instancia o DAO
$usuarioDAO = new UsuarioDAO();

// Buscar os dados do usuário logado
$usuario = $usuarioDAO->buscarPorId($usuarioId);

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {
    // Pega os dados do formulário
    $login = $_POST['login'];
    $email = $_POST['email'];

    // Atualiza os dados no banco
    $usuarioDAO->atualizarNomeEmail($usuarioId, $login, $email);

    // Mensagem de sucesso
    echo "Dados atualizados com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>
<body>
    <h2>Editar Perfil</h2>
    <form action="editar_perfil.php" method="POST">
        <label for="login">Nome:</label>
        <input type="text" name="login" id="login" value="<?php echo $usuario['login']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $usuario['email']; ?>" required>

        <button type="submit" name="atualizar">Atualizar</button>
    </form>
</body>
</html>



