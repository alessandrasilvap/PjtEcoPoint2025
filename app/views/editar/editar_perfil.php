<?php
session_start();
require_once __DIR__ . '/../../../DAO/conexao.php';
require_once __DIR__ . '/../../../DAO/usuarioDAO.php';

// Gera token CSRF se não existir
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

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
    // -------------------------------------------------------

    //validação PHP:

    $login = trim($_POST['login']);
    $email = trim($_POST['email']);

    $erros = [];

    // Validações básicas
    if (empty($login)) {
        $erros[] = "O nome não pode ser vazio.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O e-mail informado é inválido.";
    }

    // Se houver erros, não salva
    if (count($erros) === 0) {
        $usuarioDAO->atualizarNomeEmail($usuarioId, $login, $email);
        $mensagem = "Dados atualizados com sucesso!";
    } else {
        $mensagem = implode("<br>", $erros);
    }
}

// ----------------------------------------------------

// Processa a exclusão da conta
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

        // Ajuste para caminho correto do login
        header('Location: /ecoPoint/app/views/cadastro/index.php');
        exit();
    } else {
        echo "Erro ao excluir a conta.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right,rgb(0, 255, 98),rgb(2, 121, 0)); /* Verde para azul */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #fff;
       flex-direction: column;       /* ESSENCIAL: empilha o título e form */
    justify-content: center;      /* centraliza verticalmente */
    align-items: center;          /* centraliza horizontalmente */
    color: #fff;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    backdrop-filter: blur(10px);
    color: #fff;
    width: 350px;
    align-items: center; /* Centraliza conteúdo horizontalmente */

  
}

label {
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    margin-bottom: 15px;
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    outline: none;
}

input[type="text"]::placeholder,
input[type="email"]::placeholder {
    color: #e0e0e0;
}



button {
    align-items: center; /* Centraliza conteúdo horizontalmente */
    padding: 12px 20px;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
 

   
}

button.atualizar {
    background: linear-gradient(135deg,rgba(126, 255, 242, 0.78) 0%, #66a6ff 100%);
    color: white;
}

button.atualizar:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(102, 166, 255, 0.5);
}

button.btn-danger {
    background: linear-gradient(135deg, #ff6a6a 0%, #ff3d3d 100%);
    color: white;
}

button.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 61, 61, 0.5);
}




</style>
<body>
<h2>Editar Perfil</h2>
<form method="POST" enctype="">

    <label for="login">Nome:</label><br>
    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($usuario['login']); ?>" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br><br>
<div class=".button-group">
    <button class="atualizar" type="submit" name="atualizar">Atualizar</button>
    <button type="button" id="btnExcluir" class="btn btn-danger"><i class="bi bi-trash-fill"></i> Excluir Conta</button>
</div>
</form>
 <script src="/ecoPoint/public/js/editarPerfil.js"></script>
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btnExcluir').addEventListener('click', function() {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Essa ação é irreversível!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formExcluir').submit();
        }
    });
});
</script>

<form id="formExcluir" method="POST" action="" style="display:none;">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="hidden" name="excluirConta" value="1">
</form>
</body>
</html>







