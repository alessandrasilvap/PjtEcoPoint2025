<?php

require_once __DIR__ . '/../../../DAO/conexao.php';

//Create
if (isset($_POST['criar'])) {
    $login = $_POST['login'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuario (login, email) VALUES (?, ?)";
    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->execute([$login, $email]);
    header("Location: crud.php");
    exit;
}

//Update
if (isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $email = $_POST['email'];

    $sql = "UPDATE usuario SET login = ?, email = ? WHERE id = ?";
    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->execute([$login, $email, $id]);
    header("Location: crud.php");
    exit;
}

//Delete
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $sql = "DELETE FROM usuario WHERE id = ?";
    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->execute([$id]);
    header("Location: crud.php");
    exit;
}

//Read
$sql = "SELECT * FROM usuario ORDER BY id DESC";
$stmt = Conexao::getConexao()->query($sql);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Usuários</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            padding: 20px; 
            background-color: #f0f0f0; 
        }


        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }


        th, td {
            border: 1px solid #ccc; 
            padding: 10px; 
            text-align: left; 
        }


        form { 
            margin-bottom: 20px; 
            background: #fff; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px #ccc; 
        }

        
        h2 { 
            margin-top: 40px; 
        }

        
        input[type="text"], input[type="email"] { 
            width: 100%; 
            padding: 8px; 
            margin-bottom: 10px; 
        }


        input[type="submit"] { 
            padding: 10px 20px; 
            background: green; 
            color: white; 
            border: none; 
            border-radius: 5px; 
        }


        a { 
            color: red; 
            text-decoration: none; 
        }

    </style>
</head>
<body>
    <h1>Gerenciar Usuários</h1>
    <!--Formulário de criação-->
    <h2>Adicionar novo usuário</h2>
    <form method="POST">
        <input type="text" name="login" placeholder="Login" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="submit" name="criar" value="Cadastrar">
    </form>
    
    <!--Lista de usuários-->
    <h2>Lista de usuários</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        
        <?php 

            foreach ($usuarios as $user):
                
        ?>
                
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['login'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <a href="crud.php?editar=<?= $user['id'] ?>">Editar</a> | 
                    <a href="crud.php?excluir=<?= $user['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>

        <?php 
                
            endforeach;

        ?>

    </table>
    <!-- Formulário de edição (se acionado)-->
    <?php 

        if (isset($_GET['editar'])):
            $id = $_GET['editar'];
            $sql = "SELECT * FROM usuario WHERE id = ?";
            $stmt = Conexao::getConexao()->prepare($sql);
            $stmt->execute([$id]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
    ?>

    <h2>Editar Usuário</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
        <input type="text" name="login" value="<?= $usuario['login'] ?>" required>
        <input type="email" name="email" value="<?= $usuario['email'] ?>" required>
        <input type="submit" name="atualizar" value="Atualizar">
    </form>

    <?php 

        endif;

    ?>

</body>
</html>
