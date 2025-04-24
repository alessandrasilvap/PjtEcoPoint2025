<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Eco Point</title>
    <link rel="shortcut icon" href="./public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="./public/css/cadastro.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="./public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" /> <!--Google Material Symbols para o painel de acessibilidade e da caixa de feedback-->
</head>

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

<body>
    <div class="conteudo">
        <h2>Cadastra-se</h2>
        <form name="formulariocadastro" method="POST" action="" onsubmit="validarcadastro(event)">
            <section class="cadastro">
                <div id="caixaesquerda">
                    <h3>ENTRE NO MUNDO MAIS VERDE.</h3>
                    <input type="text" placeholder="Nome Completo:" id="nomecompleto" name="nomecompleto" minlength="15" maxlength="80" size="50">
                    <br>
                    <strong>
                        <p>Data de nascimento:</p>
                    </strong>
                    <input type="date" id="datanascimento" name="datanascimento" size="50" onchange="validarIdade(this.value)">
                    <br>
                    <strong>
                        <p>Sexo:</p>
                    </strong>
                    <select id="genero" name="genero">
                        <option value="1">Selecione</option>
                        <option value="2">Feminino</option>
                        <option value="3">Masculino</option>
                        <option value="4">Outro</option>
                    </select>
                    <br>
                    <input type="text" id="campousuario" placeholder="Crie seu usuário:" maxlength="6" size="50" name="campousuario">
                    <br>
                    <input type="password" id="camposenha" placeholder="Crie sua senha:" maxlength="8" size="50" name="camposenha">
                    <br>
                    <input type="password" id="confirmasenha" placeholder="Confirme sua senha:" maxlength="8" size="50" name="confirmasenha">
                    <br>
                    <input type="text" id="cpf" placeholder="Digite seu CPF" size="50" name="cpf" oninput="formatarCPF(this)">
                </div>
                <div id="caixadireita">
                    <h4>Informações Complementares:</h4>
                    <strong>
                        <p>Cep:</p>
                    </strong>
                    <input type="text" id="cep" placeholder="00000-000" required oninput="formatarCEP(this)" name="cep">
                    <button type="button" id="buscar">Buscar</button>
                    <input type="text" placeholder="Endereço:" size="50" id="rua" readonly name="rua">
                    <br>
                    <input type="text" placeholder="Bairro:" size="50" id="bairro" readonly name="bairro">
                    <br>
                    <input type="text" placeholder="Cidade:" size="50" id="cidade" readonly name="cidade">
                    <br>
                    <input type="text" placeholder="Estado" size="50" id="estado" readonly name="estado">
                    <br>
                    <input type="text" placeholder="Número:" size="50" id="num" name="num">
                    <input type="text" placeholder="Complemento:" size="50" id="complemento" name="complemento">
                    <br>
                    <strong>
                        <p>Telefone:</p>
                    </strong>
                    <input type="text" id="tel" placeholder="(00) 00000-0000" size="50" oninput="formatarTEL(this)" name="tel">
                    <br>
                    <input type="email" id="inserirEmail" placeholder="exemplo@provedor.com" size="50" oninput="validarEmail(this)" name="inserirEmail">
                    <br>
                </div>
            </section>
            <section id="botoes">
                <button type="submit">CADASTRAR</button>
                <button type="button"><a href="../html/telalogin.html">VOLTAR</a></button>
                <button type="reset" id="botaolimpar">LIMPAR</button>
            </section>
    </div>
    </form>
    <script src="public/js/validacaocadastro.js">
        console.log('Javascript conectado!');
    </script>
</body>

</html>