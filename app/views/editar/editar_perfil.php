<?php
session_start();
require_once __DIR__ . '/../../../DAO/conexao.php';
require_once __DIR__ . '/../../../DAO/usuarioDAO.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    header("Location: /login/index.php");
    exit();
}

$usuarioId = $_SESSION['usuario']['id'];
$usuarioDAO = new UsuarioDAO();
$usuario = $usuarioDAO->buscarPorId($usuarioId);

// Salva a página de onde o usuário veio (para voltar depois)
if (!isset($_SESSION['redirect_after_edit']) && isset($_SERVER['HTTP_REFERER'])) {
    if (strpos($_SERVER['HTTP_REFERER'], 'editar_perfil.php') === false) {
        $_SESSION['redirect_after_edit'] = $_SERVER['HTTP_REFERER'];
    }
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];

    $usuarioDAO->atualizarNomeEmail($usuarioId, $login, $email);


    // Atualiza a variável de sessão
    $_SESSION['usuario']['login'] = $login;
    $_SESSION['usuario']['email'] = $email;

    // Redireciona para a página de origem após atualizar (evita reenvio)
    $redirectTo = isset($_SESSION['redirect_after_edit']) ? $_SESSION['redirect_after_edit'] : 'editar/editar_perfil.php';
    unset($_SESSION['redirect_after_edit']);
    header("Location: $redirectTo?success=1");
    exit();


}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
</head>
 <link rel="stylesheet" href="/ecoPoint/public/css/editarPerfil.css">

<body>

<h2>Editar Perfil</h2>

<form method="POST">
    <label for="login">Nome:</label><br>
    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($usuario['login']); ?>" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br><br>

    <button type="submit" name="atualizar">Atualizar</button>
</form>
<?php if (isset($_POST['success'])): ?>
    <p>Dados atualizados com sucesso!</p>
<?php endif; ?>



</body>
</html>







