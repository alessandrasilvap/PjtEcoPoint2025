<?php  include_once  'app/core/conexao.php'; ?>

<?php 

if (isset($_POST['login']) and isset($_POST['senha'])) {

    $login = $mysqli->real_escape_string($_POST['login']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die('Falha na execução do código SQL:' . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
        
        $usuario = $sql_query->fetch_assoc();
        // echo "Você foi logado!";

        if(!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['id'] = $usuario['id'];
        header('Location: app/views/login/index.php');

        } else {
        echo "Email ou senha incorretos!";
        }

}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Eco Point</title>
    <link rel="shortcut icon" href="./public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="./public/css/login.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="./public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols-->
</head>
<body>
    <div class="conteudo">
        <form name="formulariologin" action="#" method="post" autocomplete="off" target="_blank" novalidate>
            <div id="comeco">
                <h1>Login</h1>
                <input type="text" id="usuario" name="login" placeholder="Usuário:" maxlength="6" size="31">
                <br>
                <br>
                <input type="password" id="senha" name="senha" placeholder="Senha:" maxlength="8" size="31">
                <br>
                <br>
                <button class="botaoverde" type="submit" id="entrar">ENTRAR</button>
                <br>
                <br>
                <button><a href="telacadastro.html" class="botaoverde">CADASTRE-SE</a></button>
                <br>
                <p><a href="telaesquecisenha.html" target="_blank">Esqueci minha senha</a></p>
                <p><a href="telainicial.html">Voltar à tela inicial</a></p>
                <br>
            </div>
        </form>
    </div>
    <!--Menu de Acessibilidade-->
    <div id="menu-acessibilidade" class="menu-acessibilidade">
        <div class="btnAbre" onclick="toggleAcessMenu()">
        <span class="material-symbols-outlined">accessible_forward</span>
        </div>
        <div id="painel-acessibilidade" class="painel-acessibilidade">
            <button id="increaseFont">Aumentar Fonte</button>
            <button id="decreaseFont">Diminuir Fonte</button>
            <button onclick="mudarContraste()">Alterar Contraste</button>
            <button onclick="lerConteudo()">Ler Conteúdo</button>
            <button onclick="pararLeitura()">Parar Leitura</button>
            <br>
            <label for="feedback">Feedback de acessibilidade:</label>
            <textarea id="feedback" rows="4" placeholder="Tem um problema de acessibilidade? Nós de um Feedback"></textarea>
            <button onclick="enviarFeedbackAceb()">Enviar Feedback</button>
        </div>
    </div>
    <!--Menu de Feedback-->
    <div id="menu-feedback" class="menu-feedback">
        <div class="btnFeedback" onclick="toggleFeedbackMenu()">
        <span class="material-symbols-outlined">feedback</span>
        </div>
        <div id="painel-feedback" class="painel-feedback">
            <h3>Deixe seu Feedback</h3>
            <p>Nosso site visa a mudança, nada melhor do que você nós ajudar de pertinho.
            Abaixo escreva um feedback sobre nosso site e sua experiência dentro dele.
            Não se esqueça, pode fazer isso quando e quantas vezes quiser!!</p>
            <textarea id="feedback-text" rows="5" placeholder="Digite aqui seu feedback..."></textarea>
            <button onclick="enviarFeedback()">Enviar Feedback</button>
        </div>
    </div>
    <script src="/ecoPoint/public/js/validacaologin.js"></script> <!--Código JS da validação do site todo-->
    <script src="/ecoPoint/public/js/acessibfeedback.js"></script> <!--Código JS do painel de acessibilidade e da caixa de feedback-->
</body>
</html>
