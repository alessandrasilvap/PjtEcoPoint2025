<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Eco Point</title>
    <link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="/ecoPoint/public/css/sobrenos.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/menu.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--Link para utilização de ícones Font Awesome-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols-->
</head>
<body>
    <header>
        <img src="./public/imagens/logo-ecopoint-white.png" alt="logo do ecopoint" id="logo">
        <nav id="menu">
            <div id="borda-menu">
                <a href="<?= BASE_URL ?>/sobre" class="link selecionado">Sobre Nós</a>
                <a href="<?= BASE_URL ?>/Informacoes" class="link">Informações</a>
                <a href="<?= BASE_URL ?>/ongs" class="link">Ong's</a>
                <a href="<?= BASE_URL ?>/mapa" class="link">Mapa</a>
            </div>
        </nav>
        <nav class="sessoes">
            <ul class="user">
                <li class="usuario" id="btnPerfil"><img src="./public/imagens/user-icon.png" alt="" id="user-icon"> <?= $_SESSION['usuario']['login']; ?></li>
                <li class="usuario"><a href="/ecoPoint/logout" class="sair">🔓 Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        
        <h1 id="titulo">Sobre Nós</h1>
        <section id="elementos">

            <section id="container-img">
                <img src="./public/imagens/reciclagem-simbolo2.png" alt="">
            </section>
            <section id="container-sobrenos">
                <h2>Bem-vindos ao Eco Point!</h2>
                <p>Este projeto nasceu na Unisuam, no curso de Análise e Desenvolvimento de Sistemas, com a missão de ir além do ambiente acadêmico.</p>
                <p>Somos movidos pela sustentabilidade e pela tecnologia, acreditando que pequenas ações podem gerar grandes mudanças. Nosso foco é conscientizar sobre o descarte correto de resíduos eletrônicos, como celulares, computadores e eletrodomésticos, promovendo a reciclagem e o reaproveitamento de materiais.</p>
                <p>Criamos este site para facilitar o acesso a pontos de coleta e estimular práticas mais responsáveis com o meio ambiente. Também realizamos campanhas e parcerias para informar e engajar a comunidade.</p>
                <p>Juntos, podemos construir um futuro mais verde e saudável.</p>
            </section>

        </section>

        <img src="/ecoPoint/public/imagens/fotosobrenos.jpg" alt="Imagem ilustrativa do site Unsplash">

        <h2>Nossos Pilares</h2>

        <p>O Eco Point se baseia em três pilares principais:</p>

        <p><strong>Conscientização:</strong> Promovemos palestras e campanhas educativas para informar sobre os impactos do lixo eletrônico e incentivar práticas sustentáveis.</p>

        <p><strong>Coleta e Reciclagem:</strong> Estabelecemos pontos de coleta em parceria com empresas e instituições, facilitando o descarte correto de eletrônicos.</p>

        <p><strong>Inovação e Pesquisa:</strong> Buscamos constantemente novas soluções para aprimorar a reciclagem e o reaproveitamento de componentes eletrônicos.</p>

        <h2>Nosso Compromisso</h2>

        <p>Estamos empenhados em reduzir o impacto ambiental e fortalecer a cultura da responsabilidade ecológica. Acreditamos que cada atitude conta — e que juntos podemos transformar o mundo.</p>

        <p>Participe com a gente!</p>
    </main>
        
    <footer>
        <div class="footer-container">
            <div>
                <h3 class="integrantes">Integrantes</h3>
                <ul class="lista">
                    <li class="nome">Alessandra Cristina da Silva Pereira</li>
                    <li class="nome">Bryan Caristiati Costa</li>
                    <li class="nome">Eric Luiz Xavier de Araujo</li>
                    <li class="nome">Daniel Jesus Dias Alves</li>
                    <li class="nome">Gabriel Araújo de Oliveira</li>
                </ul>
            </div>
            <div class="contatos">
                <h3 class="contatos">Contatos</h3>
                <div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>(21) 96444-3878</span>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-instagram"></i>
                        <span>@ecopoint_recicle</span> 
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>ecopointverde@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

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
    <script src="/ecoPoint/public/js/acessibfeedback.js"></script> <!--Código JS do painel de acessibilidade e da caixa de feedback-->
</body>
</html>
