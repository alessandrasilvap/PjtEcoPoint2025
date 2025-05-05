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
    <header></header>
    <div class="conteudo">
        <nav id="menu">
            <ul class="menu2">
                <a href="<?= BASE_URL ?>/sobre">Sobre Nós</a>
                <a href="<?= BASE_URL ?>/Informacoes">Informações</a>
                <a href="<?= BASE_URL ?>/ongs">Ong's</a>
                <a href="<?= BASE_URL ?>/mapa">Mapa</a>
            </ul>
        </nav>
        <br>
        <br>
        <section>
            <nav class="sessoes">
                <ul class="user">
                    <li class="usuario" id="btnPerfil">👤 <?= $_SESSION['usuario']['nome']; ?></li>
                    <br>
                    <li class="usuario"><a href="/ecoPoint/logout" class="sair">🔓 Logout</a></li>
                </ul>
            </nav>

            <h1>Sobre Nós</h1>
            <p>Sejam bem-vindos ao <strong>Eco Point</strong>, o site criado e pensado para um projeto da faculdade Unisuam para o curso Análise e Desenvolvimento de Sistemas, porém imaginamos que poderá ir além.</p> 
            
            <img src="/ecoPoint/public/imagens/fotosobrenos1.jpg" alt="Primeira imagem ilustrativa do site Unsplash">
    
            <p>Somos uma equipe apaixonada por sustentabilidade e tecnologia, acreditando que pequenas ações podem gerar grandes transformações. Desde o início, nosso compromisso tem sido criar soluções inovadoras que impactem positivamente nossa comunidade.</p>
            <p>Acreditamos que a participação ativa da comunidade é fundamental para o sucesso de qualquer iniciativa. Por isso, promovemos um ambiente aberto, onde todos podem contribuir e participar do processo (nossos contatos estão no fim da página).</p>
            <p>A Eco Point foi criada com a necessidade urgente de enfrentar o crescente problema dos resíduos eletrônicos e de promover um futuro mais sustentável.</p>
            <p>No mundo atual, a tecnologia evolui rapidamente, mas essa evolução traz consigo um desafio crescente: o descarte inadequado de resíduos eletrônicos. Com o aumento do consumo de dispositivos, a quantidade de lixo eletrônico gerada anualmente atinge níveis alarmantes. Cientes dessa realidade, nós decidimos agir.</p>
            <p>Desde alguns meses, trabalhamos para conscientizar a comunidade sobre a importância da reciclagem de equipamentos eletrônicos, como celulares, computadores e eletrodomésticos. Garantindo que materiais valiosos sejam reaproveitados e que substâncias tóxicas sejam descartadas de maneira segura.</p>
            <p>Acreditamos que a educação é fundamental. Com uma missão clara de promover a reciclagem e o reaproveitamento de materiais, buscamos transformar a forma como as pessoas pensam e lidam com os produtos tecnológicos que já não utilizam mais. Por isso, oferecemos palestras e campanhas informativas para engajar a população e promover práticas sustentáveis. Além disso, colaboramos com empresas e organizações locais para criar pontos de coleta e facilitar o descarte adequado de eletrônicos.</p>
            <p>Estamos comprometidos em construir um futuro mais verde e saudável para todos.</p>
    
            <img src="/ecoPoint/public/imagens/fotosobrenos.jpg" alt="Imagem ilustrativa do site Unsplash">
            <p><strong>Nosso projeto tem como foco três pilares principais:</strong></p>
            <p>- Conscientização: Acreditamos que a educação é a chave para a mudança. Realizamos palestras e campanhas de sensibilização para informar a população sobre os impactos ambientais do lixo eletrônico e a importância da reciclagem. Queremos empoderar indivíduos e comunidades a tomarem decisões mais sustentáveis.</p>
            <p>- Coleta e Reciclagem: Colaboramos com empresas e instituições para estabelecer pontos de coleta de eletrônicos, facilitando o descarte correto.</p>
            <p>- Inovação e Pesquisa: Estamos sempre em busca de novas tecnologias e métodos que possam aprimorar nossos processos de reciclagem. Investimos em pesquisa para entender melhor o ciclo de vida dos produtos eletrônicos e como podemos maximizar o reaproveitamento de seus componentes.</p>
            <p><strong>Nosso Compromisso</strong></p>
            <p>No Eco Point, estamos comprometidos não apenas em reduzir o impacto ambiental dos resíduos eletrônicos, mas também em promover uma cultura de responsabilidade e cuidado com o planeta. Acreditamos que cada pequeno gesto conta e que, juntos, podemos fazer uma grande diferença.</p>
            <p>Participe Conosco!</p>
        </section>
        <br>
        <br>
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
</body>
</html>