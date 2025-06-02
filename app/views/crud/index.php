<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Usuários</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/crud.css">
</head>
<body>
    <h1>Gerenciar Usuários</h1>

    <?php

    // Exibe mensagens de feedback, se houver
    if (isset($feedbackMessage)):
        echo '<div class="feedback-message ' . htmlspecialchars($feedbackMessageType) . '">' . htmlspecialchars($feedbackMessage) . '</div>';
    endif;

    ?>

    <h2>Adicionar novo usuário</h2>
    <form method="POST" action="<?= BASE_URL ?>/admin/criarUsuario">
        <input type="text" name="login" placeholder="Login" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="submit" name="criar" value="Cadastrar">
    </form>

    <h2>Lista de usuários</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Verifica se a variável $usuarios foi passada pelo controlador
            if (empty($usuarios)):
                echo '<tr><td colspan="4">Nenhum usuário cadastrado.</td></tr>';
            else:
                foreach ($usuarios as $user):
                    
            ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/admin/editarUsuario/<?= htmlspecialchars($user['id']) ?>">Editar</a> |
                        <a href="<?= BASE_URL ?>/admin/excluirUsuario/<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Tem certeza que deseja excluir o usuário <?= htmlspecialchars($user['login']) ?>?')">Excluir</a>
                    </td>
                </tr>
            <?php
                    
                endforeach;
            endif;

            ?>
        </tbody>
    </table>

    <?php

        // O formulário de edição só é exibido se um usuário for passado para edição
        if (isset($usuarioParaEdicao)):
            
    ?>
    <h2>Editar Usuário: <?= htmlspecialchars($usuarioParaEdicao['login']) ?></h2>
    <form method="POST" action="<?= BASE_URL ?>/admin/atualizarUsuario">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuarioParaEdicao['id']) ?>">
        <input type="text" name="login" value="<?= htmlspecialchars($usuarioParaEdicao['login']) ?>" required>
        <input type="email" name="email" value="<?= htmlspecialchars($usuarioParaEdicao['email']) ?>" required>
        <input type="submit" name="atualizar" value="Atualizar">
        <a href="<?= BASE_URL ?>/admin/gerenciarUsuarios" class="button-cancel">Cancelar Edição</a>
    </form>
    <?php
            
        endif;

    ?>
</body>
</html>
