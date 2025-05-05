<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações - Eco Point</title>
    <link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="/ecoPoint/public/css/informacoes.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/menu.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--Link para utilização de ícones Font Awesome-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols para o painel de acessibilidade e da caixa de feedback-->
</head>
<body>
    <header>
        <img src="./public/imagens/logo-ecopoint-white.png" alt="logo do ecopoint" id="logo">
        <nav id="menu">
            <div id="borda-menu">
                <a href="<?= BASE_URL ?>/sobre" class="link ">Sobre Nós</a>
                <a href="<?= BASE_URL ?>/Informacoes" class="link selecionado">Informações</a>
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
    <main class="conteudo">

        <section>
            <h1>Informações</h1>
            <p>A reciclagem eletrônica, ou e-waste recycling, é o processo de reaproveitamento de dispositivos eletrônicos que chegaram ao fim de sua vida útil. Esse tipo de reciclagem é importante por várias razões:</p>
            <img class="informacao" src="/ecoPoint/public/imagens/info.png" alt="site: https://www.iberdrola.com/sustentabilidade/que-e-lixo-eletronico">
            <ol id="listas">
                <li>Redução de Resíduos: A eletrônica é uma das categorias de resíduos que mais cresce, e a reciclagem ajuda a reduzir o volume que vai para aterros sanitários.</li>
                <li>Recuperação de Materiais: Dispositivos eletrônicos contêm metais preciosos, além de outros materiais recicláveis. A recuperação desses materiais diminui a necessidade de mineração e a extração de recursos naturais.</li>
                <li>Proteção Ambiental: Muitos produtos eletrônicos contêm substâncias tóxica como chumbo, mercúrio e cádmio. O descarte inadequado pode levar à contaminação do solo e da água, prejudicando o meio ambiente e a saúde humana.</li>
                <li>Economia Circular: A reciclagem eletrônica contribui para a economia circular, onde os materiais são continuamente reutilizados e reciclados, reduzindo o consumo de recursos novos.</li>
            </ol>
            <img class="imagem" src="/ecoPoint/public/imagens/fotoinfop.jpg" alt="Ilustrando a quantidade absurda de lixo eletrônico">
            <h2><strong>Como Funciona a Reciclagem Eletrônica</strong></h2>
            <ol id="listas">
                <li>Coleta: Dispositivos eletrônicos são coletados em pontos de coleta, lojas que aceitam devolução ou programas de coleta comunitária.</li>
                <li>Desmontagem: Os produtos são desmontados manualmente ou mecanicamente para separar os diferentes componentes.</li>
                <li>Processamento: Os materiais separados são processados para recuperar metais e outros recursos.</li>
                <li>Reutilização: Componentes que ainda estão em boas condições podem ser reutilizados em novos dispositivos ou vendidos como peças sobressalentes.</li>
            </ol>
            
            <img class="imagree" src="/ecoPoint/public/imagens/canvain.png" alt="Recicle"> <h2><strong>Dicas para Descarte</strong></h2>
            <ul id="listas">
                <li>Nunca jogue eletrônicos no lixo comum.</li>
                <li>Apague seus dados.</li>
                <li>Pesquise programas locais.</li>
            </ul>
            <h2><strong>Processos de Reciclagem Eletrônica</strong></h2>
            <h3>Coleta e Transporte:</h3>
            <ul id="listas">
                <li>Pontos de Coleta: Muitas cidades oferecem locais específicos para a entrega de eletrônicos usados.</li>
                <li>Eventos de Coleta: Muitas comunidades organizam dias de coleta para facilitar o descarte responsável de e-lixo. Após a coleta, os eletrônicos são triados. Dispositivos que podem ser reparados ou reutilizados são separados dos que precisam ser reciclados.</li>
            </ul>
            <h3>Benefícios da Reciclagem Eletrônica:</h3>
            <ul id="listas">
                <li>Sustentabilidade: Reduz o impacto ambiental ao minimizar a quantidade de lixo que vai para os aterros e ao promover a reutilização de materiais.</li>
                <li>Economia de Recursos: A reciclagem de eletrônicos pode economizar grandes quantidades de recursos naturais, como água e energia, que seriam necessários para produzir novos materiais.</li>
                <li>Criação de Empregos: O setor de reciclagem eletrônica gera empregos em diversas áreas, desde a coleta até o processamento e a venda de materiais reciclados.</li>
                <li>Redução de Emissões de Gases de Efeito Estufa: Ao reutilizar materiais em vez de produzir novos, as emissões associadas à produção de eletrônicos podem ser significativamente reduzidas.</li>
            </ul>
            <h3>Desafios da Reciclagem Eletrônica:</h3>
            <ul id="listas">
                <li>Descarte Ilegal.</li>
                <li>Falta de Consciência.</li>
                <li>Tecnologia em Evolução Rápida.</li>
                <li>Substâncias Perigosas.</li>
            </ul>
            <h3>Iniciativas e Regulamentações:</h3>
            <p>Leis de E-Waste: Muitos países implementaram legislações para regular o descarte de eletrônicos. Por exemplo, a Diretiva de Resíduos de Equipamentos Elétricos e Eletrônicos (WEEE) na União Europeia estabelece normas rigorosas para a reciclagem.</p>
            <ul id="listas">
                <li>Programas de Recompensa: Algumas empresas oferecem incentivos para consumidores que devolvem eletrônicos usados, promovendo a reciclagem.</li>
                <li>Iniciativas de Educação: Organizações e governos estão desenvolvendo campanhas para educar o público sobre a importância da reciclagem eletrônica e como fazê-la corretamente.</li>
            </ul>
            <p>Já no Brasil, também ixistem iniciativas como: </p>
            <ul id="listas">
                <li>Política Nacional de Resíduos Sólidos (PNRS): É uma lei federal brasileira (Lei nº 12.305/2010) que estabelece diretrizes para a gestão de resíduos sólidos no país. Ela tem como objetivos reduzir a geração de resíduos, promover a reutilização e reciclagem, e minimizar o descarte inadequado. A PNRS é baseada em princípios como responsabilidade compartilhada, prevenção, redução, reutilização, reciclagem e disposição final ambientalmente adequada. Ela também estabelece diretrizes para planejamento e gestão integrada, participação popular, educação ambiental, inclusão social e desenvolvimento sustentável.</li>
                <li>Associação Brasileira de Reciclagem de Eletroeletrônicos e Eletrodomésticos (ABREE): É uma organização sem fins lucrativos que visa promover a reciclagem responsável de resíduos eletrônicos no Brasil. Fundada em 2011, a ABRE reúne empresas, governos e organizações da sociedade civil para desenvolver soluções para o problema do lixo eletrônico.</li>
            </ul>
            <h3>Dúvidas Frequentes</h3>
            <p>Recigem por flutuação: O processo em questão envolve a separação de materiais utilizando líquidos de diferentes densidades.</p>
            <p>Pirometálurgia: É um processo de reciclagem que utiliza calor e pressão para extrair metais de resíduos eletrônicos.</p>
            <P>Protocolo de Basileia: É um acordo internacional que visa reduzir a produção de resíduos perigosos, incluindo resíduos eletrônicos.</P>
            <p>Relação de países e seus lixos eletrônicos: ISLÂNDIA e SUÉCIA são os países que mais reciclam lixos eletrônicos; ÁUSTRIA e ALEMANHA são os países com menor quantidade de resíduos eletrônicos; CHINA e EUA são os países com maior quantidade resíduos eletrônicos.</p>
            <br>
            <p>A reciclagem eletrônica é essencial para a sustentabilidade e a proteção do meio ambiente. Ao reciclar dispositivos eletrônicos, você ajuda a preservar recursos, reduzir a poluição e contribuir para um futuro mais sustentável.</p>
            <img class="imagre" src="/ecoPoint/public/imagens/canvain.png" alt="Recicle">
        </section>
        <br>
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