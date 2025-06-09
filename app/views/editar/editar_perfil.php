<?php
require_once '../../controllers/Editar_perfilController.php';

$controller = new UsuarioController();
$data = $controller->editarPerfil();

$usuario = $data['usuario'];
$mensagem = $data['mensagem'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/ecoPoint/public/css/editarPerfil.css">
</head>
<body>
<h2>Editar Perfil</h2>
<form method="POST">
    <label for="login">Nome:</label><br>
    <input type="text" id="login" name="login" value="<?= htmlspecialchars($usuario['login'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required><br><br>
<div class="button-group">
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







