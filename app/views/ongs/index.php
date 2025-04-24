<?php 
include('app/core/protect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ong's - Eco Point</title>
    <link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="/ecoPoint/public/css/ongs.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--Link para utilização de ícones Font Awesome-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols-->
</head>
<body>
    <header></header>
    <div id="user-info" style="position: absolute; top: 16em; right: 10px; display: none;">
        <span id="nomenatela"></span>
        <span id="arrow" onclick="toggleMenu()">▼</span>
        <!--O dropdown aparecerá ao clicar na setinha, permitindo que o usuário saia da sessão-->
        <div id="dropdown" style="display: none;">
            <div id="logout" onclick="logout()">Sair</div>
        </div>
    </div>
    <div class="conteudo">
        <nav id="menu">
            <ul class="menu4">
                <a href="./telasobrenos.html">Sobre Nós</a>
                <a href="./telainformacoes.html">Informações</a>
                <a href="#Ong's">Ong's</a>
                <a href="./telamapa.html">Mapa</a>
            </ul>
        </nav>
        <br>
        <br>
        <section>
            <h1>ONG's</h1>
            <p>As ONGs de reciclagem eletrônica desempenham um papel importante na sustentabilidade, promovendo a coleta e o reaproveitamento de equipamentos eletrônicos. Elas trabalham para reduzir o impacto ambiental, conscientizar a população e facilitar o descarte correto de produtos eletrônicos, muitas vezes oferecendo oficinas, campanhas educativas e programas de reaproveitamento.</p>
            <br>
            <p>Algumas ONGs conhecidas nesse campo incluem:</p> <img class="imagree" src="../imagens/canvain.png" alt="Recicle">
            <ol>
                <li><strong>Recicla Sampa</strong> - Focada na coleta e reciclagem de eletrônicos em São Paulo.</li>
                <li><strong>E-Lixo</strong> - Realiza a coleta de equipamentos eletrônicos para reaproveitamento e reciclagem.</li>
                <li><strong>Instituto Jogue Limpo</strong> - Promove ações de educação ambiental e reciclagem de eletrônicos.</li>
                <li><strong>Eco Point</strong> - Com certeza! Nosso projeto realiza a coleta em diversas regiões do Rio de Janeiro. Entre em contato para obter mais informações sobre como participar.⁠</li>
            </ol>
            <p>Essas organizações muitas vezes colaboram com empresas e governos para desenvolver iniciativas que incentivem a reciclagem e o descarte responsável.</p>
        </section>
        <br>
        <br>
        <footer>
            <div class="footer-container">
                <div>
                    <h3 class="integrantes">Integrantes</h3>
                    <ul class="lista">
                        <li class="nome">Alessandra Cristina da Silva Pereira</li>
                        <li class="nome">Caio Lucas Sales Ferreira</li>
                        <li class="nome">Eric Luiz Xavier de Araujo</li>
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
                            <span>ecopointverde@gmail.com.br</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
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
    <script src="/ecoPoint/public/js/acessibfeedback.js"></script> <!--Código JS do painel de acessibilidade e da caixa de feedback-->
    <script src="/ecoPoint/public/js/menulateral.js"></script> <!--Código JS do menu de autenticação do usuário-->
</body>
</html>
