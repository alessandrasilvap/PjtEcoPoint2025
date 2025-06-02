<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Usuários</title>
    <link rel="stylesheet" href="/ecoPoint/public/css/crud.css">
</head>
<body>
    <h1>Gerenciar Usuários</h1>

    <h2>Adicionar novo usuário</h2>
    <form method="POST" action="<?= BASE_URL ?>/admin/criarUsuario">
        <input type="text" name="login" placeholder="Login" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="submit" name="criar" value="Cadastrar">
    </form>

    <h2>Lista de usuários</h2>
    <table>
        <tbody>
            <?php 

                foreach ($usuarios as $user): 
                    
            ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/admin/editarUsuario/<?= htmlspecialchars($user['id']) ?>">Editar</a> |
                        <a href="<?= BASE_URL ?>/admin/excluirUsuario/<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php 
                
                endforeach; 

            ?>
        </tbody>
    </table>

    <?php 

        if (isset($usuarioParaEdicao)): 
            
    ?>
    <h2>Editar Usuário</h2>
    <form method="POST" action="<?= BASE_URL ?>/admin/editarUsuario/<?= htmlspecialchars($usuarioParaEdicao['id']) ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuarioParaEdicao['id']) ?>">
        <input type="text" name="login" value="<?= htmlspecialchars($usuarioParaEdicao['login']) ?>" required>
        <input type="email" name="email" value="<?= htmlspecialchars($usuarioParaEdicao['email']) ?>" required>
        <input type="submit" name="atualizar" value="Atualizar">
    </form>
    <?php 
            
        endif; 
    ?>
</body>
</html>
