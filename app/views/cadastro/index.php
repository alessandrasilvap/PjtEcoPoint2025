<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Eco Point</title>
    <link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="/ecoPoint/public/css/cadastro.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols para o painel de acessibilidade e da caixa de feedback-->
</head>
<body>
    <header></header>
    <div class="conteudo">
    <h2>Cadastra-se</h2>
    <form action="/ecoPoint/cadastro/salvar" method="POST" id="formCadastro" name="formulariocadastro" onsubmit="validarcadastro(event)">
        <section class="cadastro">
            <div id="caixaesquerda">
                <h3>ENTRE NO MUNDO MAIS VERDE.</h3>
                <input type="text" placeholder="Nome Completo:" id="nomecompleto" name="nome" minlength="15" maxlength="80" size="50">
                <br>
                <strong><p>Data de nascimento:</p></strong>
                <input type="date" id="datanascimento" name="nascimento" size="50" onchange="validarIdade(this.value)"> <!--Foi adicionado o evento 'onchange' ao input de data para chamar a função, pois o evento ocorre quando a parte textual de uma caixa de combinação é alterado-->
                <br>
                <br>
                <input type="text" id="campousuario" name="login" placeholder="Crie seu usuário:" maxlength="10" size="50">
                <br>
                <br>
                <input type="password" id="camposenha" name="senha" placeholder="Crie sua senha:" maxlength="8" size="50">
                <br>
                <br>
                <input type="password" id="confirmasenha" name="confirmasenha" placeholder="Confirme sua senha:" maxlength="8" size="50">
                <br>
                <br>
                <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" maxlength="14" size="50">
            </div>
            <div id="caixadireita">
                <h4>Informações Complementares:</h4>
                <strong><p>Cep:</p></strong>
                <input type="text" id="cep" name="cep" placeholder="00000-000" required oninput="formatarCEP(this)"> <button type="button" id="buscar">Buscar</button>
                <input type="text" id="rua" name="endereco"  placeholder="Endereço:" size="50" readonly> <!--Reandonly faz com que o campo esteja habilidado, mas não pode ser editado-->
                <br>
                <br>
                <input type="text" id="bairro" name="bairro" placeholder="Bairro:" size="50" readonly>
                <br>
                <br> 
                <input type="text" id="cidade" name="cidade" placeholder="Cidade:" size="50" readonly>
                <br>
                <br>
                <input type="text" id="num" name="numero" placeholder="Número:" size="50"> <input type="text" id="complemento" name="complemento" placeholder="Complemento:" size="50">
                <br>
                <br>
                <strong><p>Telefone:</p></strong>
                <input type="text" id="tel" name="telefone" placeholder="(00) 00000-0000" size="50" oninput="formatarTEL(this)">
                <br>
                <br>
                <input type="email" id="inserirEmail" name="email" placeholder="exemplo@provedor.com" size="50" oninput="validarEmail(this)">
                <br>
                <br>
            </div>
        </section>
        <section id="botoes">
            <button type="submit">CADASTRAR</button>
            <button type="button"><a href="home">VOLTAR</a></button> 
            <button type="reset" id="botaolimpar">LIMPAR</button>
        </section>
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
    <script src="/ecoPoint/public/js/validacaocadastro.js"></script> <!--Código JS da validação do site todo-->
    <script src="/ecoPoint/public/js/acessibfeedback.js"></script> <!--Código JS do painel de acessibilidade e da caixa de feedback-->
</body>
</html>