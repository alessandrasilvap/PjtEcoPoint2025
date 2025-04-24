<?php 
include('app/core/protect.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Point</title>
    <link rel="shortcut icon" href="./public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="./public/css/inicial.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="./public/css/quiz.css"><!--Código CSS do quiz dentro do site-->
    <link rel="stylesheet" href="./public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--Link para utilização de ícones Font Awesome-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" /> <!--Google Material Symbols-->
    <link rel="stylesheet" href="globalstyles.css">
</head>

<body>
    <header></header>
    <br>
    <div class="conteudo">
        <nav class="col-2 menu">
            <ul>
                <li><a href="/pjtecopoint/index.php?url=cadastro">CADASTRE-SE</a></li>
                <li><a href="/pjtecopoint/index.php?url=login">ENTRAR</a></li>
            </ul>

        </nav>
        <div class="col-3">
            <p class="chamada">Comece agora! Clique em <strong>CADASTRE-SE</strong> ou <strong>ENTRAR</strong> para acessar nossos recursos.</p>
            <hr>
        </div>
        <br>
        <br>
        <div class="col-s-12">
            <h1>Sobre Nós</h1>
            <p>Sejam bem-vindos ao <strong>Eco Point</strong>, o site criado e pensado para um projeto da faculdade Unisuam para o curso Análise e Desenvolvimento de Sistemas, porém imaginamos que poderá ir além.</p>
            <p>Somos uma equipe apaixonada por sustentabilidade e tecnologia, acreditando que pequenas ações podem gerar grandes transformações. Desde o início, nosso compromisso tem sido... <strong><a href="../html/telalogin.html" class="ler" target="_blank">Ler mais</a></p></strong>
        </div>
        <div class="noticias col 12 col-s-12">
            <br>
            <br>
            <br>
            <div class="item" onclick="alternarNotícias(this)"> <!--OnClick é um evento do JavaScript que esta sendo chamado com o "this"-->
                <img src="./public/imagens/imglink1.png" alt="Imagem da Notícia 1" class="nova-image">
                <div class="titulo">
                    <p>Brasil é o maior gerador de resíduo eletrônico da América do Sul</p>
                </div>
                <a href="https://monitormercantil.com.br/brasil-e-o-maior-gerador-de-residuos-eletronicos-na-america-do-sul/" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink2.png" alt="Imagem da Notícia 2" class="nova-image">
                <div class="titulo">
                    <p>Agenda 2030<br>A Agenda 2030 da ONU é um plano global para atingirmos em 2030 um mundo melhor para todos os povos e nações. (...)</p>
                </div>
                <a href="https://portal.stf.jus.br/hotsites/agenda-2030/" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink3.png" alt="Imagem da Notícia 3" class="nova-image">
                <div class="titulo">Maior parte do lixo eletrônico do Brasil é descartada irregularmente, mas poderia ser reciclada</div>
                <a href="https://g1.globo.com/jornal-nacional/noticia/2023/12/09/maior-parte-do-lixo-eletronico-do-brasil-e-descartada-irregularmente-mas-poderia-ser-reciclada.ghtml" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink4.png" alt="Imagem da Notícia 4" class="nova-image">
                <div class="titulo">Lixo eletrônico chegou a nível recorde; entenda o problema</div>
                <a href="https://www.cnnbrasil.com.br/tecnologia/lixo-eletronico-chegou-a-nivel-recorde-entenda-o-problema/" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink5.png" alt="Imagem da Notícia 5" class="nova-image">
                <div class="titulo">E-waste Monitor 2024: ONU lança relatório atualizado sobre resíduos eletrônico</div>
                <a href="https://circulare.com.br/dados-brasil-e-mundo-the-global-ewaste-monitor-2024/#:~:text=Os%20n%C3%BAmeros%20mostrados%20no%20E,de%20maneira%20adequada%20e%20segura" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink6.png" alt="Imagem da Notícia 6" class="nova-image">
                <div class="titulo">Reciclagem de resíduos: 6 benefícios de ser um reciclador de REEE da Rede Circulare</div>
                <a href="https://circulare.com.br/reciclagem-de-residuos-beneficios-parceiro-circulare/" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink7.png" alt="Imagem da Notícia 7" class="nova-image">
                <div class="titulo">Qual é a legislação no Brasil que trata da gestão do lixo eletrônico?</div>
                <a href="https://sucatadigital.com.br/qual-e-a-legislacao-no-brasil-que-trata-da-gestao-do-lixo-eletronico/" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink8.png" alt="Imagem da Notícia 8" class="nova-image">
                <div class="titulo">Produção mundial de lixo eletrônico é cinco vezes maior do que sua reciclagem, diz ONU</div>
                <a href="https://www.jb.com.br/brasil/meio-ambiente/2024/03/1049208-producao-mundial-de-lixo-eletronico-e-cinco-vezes-maior-do-que-sua-reciclagem-diz-onu.html" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink12.png" alt="Imagem da Notícia 9" class="nova-image">
                <div class="titulo">
                    <p>Samsung Recicla: O Programa de Reciclagem Samsung Recicla oferece descarte gratuito e ecologicamente correto para produtos eletroeletrônicos e eletrodomésticos(...) </p>
                </div>
                <a href="https://www.samsung.com/br/support/programa-reciclagem/?cid=br_paid_digital_google_samsungrecicla_aon_search_2024&gad_source=2&gclid=Cj0KCQjw4Oe4BhCcARIsADQ0csneq__V65LmhbvaRJWnUvUo1DAt35g1MUSJJgx0CUOeR11mx9_T7gwaAlTNEALw_wcB" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink9.png" alt="Link 1" class="nova-image">
                <div class="titulo">
                    <p>O que é sustentabilidade? Clique em "Ler mais" e fique por dentro deste assunto em alta.</p>
                </div>
                <a href="https://m.youtube.com/watch?v=XrCdZy9Mvb0" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink10.png" alt="Link 2" class="nova-image">
                <div class="titulo">Como funciona a reciclagem de lixo eletrônico?</div>
                <a href="https://m.youtube.com/watch?v=9IE6f0s_BuA" class="lermais" target="_blank">Ler mais</a>
            </div>


            <div class="item" onclick="alternarNotícias(this)">
                <img src="./public/imagens/imglink11.png" alt="Link 3" class="nova-image">
                <div class="titulo">Reciclagem: lixo eletrônico e o descarte adequado no Brasil</div>
                <a href="https://www.youtube.com/watch?app=desktop&v=YYWIc-gVoI4" class="lermais" target="_blank">Ler mais</a>
            </div>
        </div>
        <br>
        <br>
        <!--QUIZ-->
        <h2>Quiz Eco Point</h2>
        <p>Teste seu conhecimento sobre Reciclagem eletrônica! Você pode ser tornar um especialista no assunto. Participe do nosso Quiz Eco Point e descubra como você pode fazer a diferença!</p>
        <br>
        <div class="container">
            <div class="questions-container hide"> <!--Hide serve para esconder a class-->
                <span class="question">Pergunta aqui?</span>
                <div class="answers-container">
                    <button class="answer button">Resposta 1</button>
                    <button class="answer button">Resposta 2</button>
                    <button class="answer button">Resposta 3</button>
                    <button class="answer button">Resposta 4</button>
                </div>
            </div>
            <div class="controls-container">
                <button class="start-quiz button">Começar Quiz!</button>
                <button class="next-questin button hide">Próxima pergunta</button>
            </div>
        </div>
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
            <label for="feedback">Feedback do Controle de Acessibilidade:</label>
            <style> </style>
            <textarea id="feedback" rows="4" placeholder="Tem um problema na acessibilidade? Nós conte."></textarea>
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
    <script src="./public/js/acessibfeedback.js"></script> <!--Código JS do painel de acessibilidade e da caixa de feedback-->
    <script src="./public/js/validacaoquiz.js"></script> <!--Código JS da validação do quiz todo-->
    <script src="./public/js/validacaoinicial.js"></script> <!--Código JS da validação do site todo-->

</body>

</html>