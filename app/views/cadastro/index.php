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
    <header class="elementos-topo">
        <h1>Cadastre-se</h1>
        <p>Entre em um mundo mais verde</p>
    </header>
    <div class="bolinha topo">
    </div>
    <main>
        <section id="container">
            
            <form action="/ecoPoint/cadastro/salvar" method="POST" id="formCadastro" name="formulariocadastro">
                <h2 class="titulos">Informações pessoais</h2>
                <section id="informacoes-pessoais">

                    <div class="campo">
                        <label for="nomecompleto"> Nome completo </label>
                        <input type="text" placeholder="Nome Completo:" id="nomecompleto" name="nome" minlength="15" maxlength="80" size="50">
                    </div>
            
                    <div class="campo">
                        <label for="datanascimento"> Data de nascimento </label>
                        <input type="date" id="datanascimento" name="nascimento" size="50" onchange="validarIdade(this.value)">
                    </div> <!--Foi adicionado o evento 'onchange' ao input de data para chamar a função, pois o evento ocorre quando a parte textual de uma caixa de combinação é alterado-->

                    <div class="campo">
                        <label for="inserirEmail"> Email </label>
                        <input type="email" id="inserirEmail" name="email" placeholder="exemplo@provedor.com" size="50" oninput="validarEmail(this)">
                    </div>
                    <div class="campo">
                        <label for="cpf"> CPF </label>
                        <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" size="50" oninput="formatarCPF(this)">
                    </div>

                </section>
                <h2 class="titulos">Informações complementares</h2>
                <section id="informacoes-complementares">
                
                    <div class="campo">
                        <label for="cep"> CEP </label>
                        <input type="text" id="cep" name="cep" placeholder="00000-000" required oninput="formatarCEP(this)">
                    </div> <!--Reandonly faz com que o campo esteja habilidado, mas não pode ser editado-->
                    <div class="campo">
                        <button type="button" id="buscar">Buscar</button>
                    </div>

                    <div class="campo">
                        <label for="endereco"> Endereço </label>
                        <input type="text" id="rua" name="endereco"  placeholder="Endereço:" size="50" readonly>
                    </div>

                    <div class="campo">
                        <label for="bairro"> Bairro </label>
                        <input type="text" id="bairro" name="bairro" placeholder="Bairro:" size="50" readonly>
                    </div>
            
                    <div class="campo">
                        <label for="cidade"> Cidade </label>
                        <input type="text" id="cidade" name="cidade" placeholder="Cidade:" size="50" readonly>
                    </div>
            
                    <div class="campo">
                        <label for="num"> Número </label>
                        <input type="text" id="num" name="numero" placeholder="Número:" size="50"> 
                    </div>

                    <div class="campo">
                        <label for="complemento"> Complemento </label>
                        <input type="text" id="complemento" name="complemento" placeholder="Complemento:" size="50">
                    </div>
            
                    <div class="campo">
                        <label for="tel"> Telefone </label>
                        <input type="text" id="tel" name="telefone" placeholder="(00) 00000-0000" size="50" oninput="formatarTEL(this)">
                    </div>
                </section>
                <h2 class="titulos">Informações de acesso</h2>
                <section id="informacoes-acesso">
                    
                    <div class="campo">
                        <label for="campousuario"> Nome de usuario </label>
                        <input type="text" id="campousuario" name="login" placeholder="Crie seu usuário" maxlength="6" size="50">
                    </div>
            
                    <div class="campo">
                        <label for="confirmasenha"> Confirme a senha </label>
                        <input type="password" id="confirmasenha" name="confirmasenha" placeholder="Confirme sua senha " maxlength="8" size="50">
                    </div>

                    <div class="campo">
                        <label for="camposenha"> Senha </label>
                        <input type="password" id="camposenha" name="senha" placeholder="Crie sua senha" maxlength="8" size="50">
                    </div>
                </section>
                <section id="botoes">
                    <button type="submit">Cadastrar</button>
                    <button type="button" onclick="window.location.href='<?= BASE_URL ?>/home'"> Voltar </button>
                    <button type="reset" id="botaolimpar">Limpar</button>
                </section>
            </form>
        </section>
    </main>
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
