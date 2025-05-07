<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Point - Login</title>
    <link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="/ecoPoint/public/css/login.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols-->
</head>
<body>

    
        <section id="logo">
            <img src="./public/imagens/logo-ecopoint-dark.png" alt="imagem da logo aqui" class="imagem-logo">
            <p class="texto-logo">Conecte-se para fazer a diferença</p>
        </section>
    <div id="conteudo">
        <form action="/ecoPoint/login/autenticar" method="POST" autocomplete="off" target="_blank" novalidate class="form">
            <?php if (isset($_SESSION['erro_login'])): ?>
            <div id="mensagemErro" style="color: white; background-color: #d9534f; padding: 10px; border-radius: 5px; margin-top: 15px; text-align: center;">
            <?= $_SESSION['erro_login'] ?>
            </div>
            <?php unset($_SESSION['erro_login']); ?>
            <?php else: ?>
            <div id="mensagemErro" style="display: none; color: white; background-color: #d9534f; padding: 10px; border-radius: 5px; margin-top: 15px; text-align: center;"></div>
            <?php endif; ?>
            

            <label for="usuario" hidden>Login</label>
            <input type="text" id="usuario" name="login" placeholder="Usuário" maxlength="6" size="31">

            <label for="senha" hidden>Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Senha" maxlength="8" size="31">
            
            <button type="submit" id="botao-entrar" name="entrar">
                Entrar
            </button>
            <button type="button"  id="botao-criar-conta" name="criarConta" onclick="window.location.href='<?= BASE_URL ?>/cadastro'">
                Criar uma conta
            </button>
            
            <p><a href="<?= BASE_URL ?>/senha" target="_blank">Esqueci minha senha</a></p>
            <p><a href="<?= BASE_URL ?>/home">Voltar à tela inicial</a></p>
    
        </form>

        <div id="mensagemErro" style="display: none; color: white; background-color: #d9534f; padding: 10px; border-radius: 5px; margin-top: 15px; text-align: center;">
        <!-- A mensagem será preenchida via JavaScript -->
        </div>

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