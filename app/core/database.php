<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "ecopoint";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados brutos antes do hash
    $senha = $_POST['camposenha'];
    $confirmaSenha = $_POST['confirmasenha'];


    // Sanitizando os dados
    $nomecompleto = $conn->real_escape_string($_POST['nomecompleto']);
    $datanascimento = $conn->real_escape_string($_POST['datanascimento']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $campousuario = $conn->real_escape_string($_POST['campousuario']);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $cep = $conn->real_escape_string($_POST['cep']);
    $endereco = $conn->real_escape_string($_POST['rua']);
    $bairro = $conn->real_escape_string($_POST['bairro']);
    $cidade = $conn->real_escape_string($_POST['cidade']);
    $estado = $conn->real_escape_string($_POST['estado']);
    $num = $conn->real_escape_string($_POST['num']);
    $complemento = $conn->real_escape_string($_POST['complemento']);
    $telefone = $conn->real_escape_string($_POST['tel']);
    $email = $conn->real_escape_string($_POST['inserirEmail']);

    // Gerar hash seguro da senha
    $camposenhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Query SQL
    $sql = "INSERT INTO usuario (nome, email, cpf, login, senha, endereco, cidade, bairro, estado, telefone, data_nascimento, cep, numero, complemento) 
            VALUES ('$nomecompleto', '$email', '$cpf', '$campousuario', '$camposenhaHash', '$endereco', '$cidade', '$bairro', '$estado', '$telefone', '$datanascimento', '$cep', '$num', '$complemento')";

    // Execução
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }

    $conn->close();
}
?>