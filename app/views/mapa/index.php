<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa - Eco Point</title>
    <link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="/ecoPoint/public/css/mapa.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/men.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/navegacao.css">
    <link rel="stylesheet" href="/ecoPoint/public/css/cadastrocoleta.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--Link para utilização de ícones Font Awesome-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> <!--Inclui o CSS do Leaflet, onde Leaflet é uma biblioteca JavaScript de código aberto que permite a criação de aplicativos de mapeamento virtuais-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <header>
         <img src="./public/imagens/logo-ecopoint-white.png" alt="logo do ecopoint" id="logo">
        <nav>
            <div id="borda-menu">
                <a href="<?= BASE_URL ?>/sobre" class="link ">Sobre Nós</a>
                <a href="<?= BASE_URL ?>/Informacoes" class="link ">Informações</a>
                <a href="<?= BASE_URL ?>/ongs" class="link ">Ong's</a>
                <a href="<?= BASE_URL ?>/mapa" class="link selecionado ">Mapa</a>

                <div class="user-dropdown">
                    <a class="user-button">
                        <i class="bi bi-person-fill-check"></i>
                        <?php echo htmlspecialchars($_SESSION['usuario']['login']); ?>
                        <i class="bi bi-caret-down-fill"></i>
                    </a>
                    <div class="user-submenu">
                        <a href="/ecoPoint/app/views/editar/editar_perfil.php"><i class="bi bi-pencil-fill"></i> Editar Perfil</a>
                        <a href="/ecoPoint/logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a>
                        
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="conteudo">
    
        <section id="mapa">
            <h1>Mapa</h1>
            <p>Para aqueles que se interessam mais pelo assunto e desejam fazer a diferença, disponibilizamos um mapa com os locais que recebem ou coletam lixo eletrônico no Rio de Janeiro.</p>
            <div id="map"></div>
            <!--Inclui o JS do Leaflet-->
            <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
            <script>
                //L.map('map') = Inicializa o mapa dentro do div com id map
                //setView([-23.550520, -46.633308], 12) define a posição inicial do mapa (coordenadas de um dos pontos de coleta de lixo eletrônico na zona sul do Rio) e o nível de zoom.
                const map = L.map('map').setView([-22.976012, -43.229052], 8);
    
                //Adiciona uma camada de tile (mapa base), conjuntos de dados geoespaciais disponibilizados gratuitamente
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
                }).addTo(map);

                //Tenta obter a localização atual do usuário
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        position => {
                            const userLat = position.coords.latitude;
                            const userLng = position.coords.longitude;

                            //Centraliza o mapa na posição do usuário
                            map.setView([userLat, userLng], 13);

                            //Adiciona o marcador "Você está aqui"
                            const userMarker = L.marker([userLat, userLng]).addTo(map);
                            userMarker.bindPopup('Você está aqui').openPopup();
                        },
                        error => {
                            console.warn('Não foi possível obter a localização:', error);
                            //Continua com a posição padrão
                        }
                    );
                } else {
                    console.warn('Geolocalização não suportada por este navegador.');
                }
    
                fetch('api/pontosAprovados.php')
                    .then(response => response.json())
                    .then(pontos => {
                        pontos.forEach(ponto => {
                            const marker = L.marker([ponto.latitude, ponto.longitude]).addTo(map);
                            marker.bindPopup(ponto.nome);
                        });
                    })
                    .catch(error => {
                        console.error('Erro ao carregar pontos do mapa:', error);
                    });
            </script>
            <form action="<?= BASE_URL ?>/mapa/cadastrarPonto" method="POST" id="formColeta" name="formulariocoleta" onsubmit="validarPontocoleta(event)">
                <div class="cadastro">
                    <div id="caixa">
                        <h2>Conhece outro ponto de coleta? Adicione aqui!</h2>
                        <h3>Informações do Local</h3>
                        <input type="text" placeholder="Nome do ponto:" id="nome" name="nome" maxlength="80" required>
                        <div class="cep">
                            <input type="text" id="cep" name="cep" placeholder="CEP: 00000-000" required oninput="formatarCEP(this)">
                            <button type="button" id="buscar">Buscar</button>
                        </div>

                        <input type="text" id="rua" name="endereco" placeholder="Endereço:" readonly>
                        <input type="text" id="bairro" name="bairro" placeholder="Bairro:" readonly>
                        <input type="text" id="cidade" name="cidade" placeholder="Cidade:" readonly>
                        <input type="text" id="estado" name="estado" placeholder="Estado:" readonly>

                        <div class="numero-complemento">
                            <input type="text" id="num" name="numero" placeholder="Número:">
                            <input type="text" id="complemento" name="complemento" placeholder="Complemento:">
                        </div>

                        <textarea name="observacao" placeholder="Observação (opcional)" rows="3" cols="40"></textarea>

                        <button type="submit">Cadastrar ponto</button>
                        <div id="mensagem-resultado"></div>
                    </div>
                </div>
            </form>
            <br>
            <p>Para mais informações sobre os pontos indicados e outros locais de reciclagem eletrônica, entre em contato conosco ou acesse o site da Comlubr.</p>
            <p>https://comlurb.prefeitura.rio/servico/coleta-seletiva/onde-descartar-materiais-que-nao-sao-coletados/</p>
            <p>https://www.curitiba.pr.gov.br/servicos/ecopontos-descarte-correto-de-residuos/716</p>
            <p>https://www.seteambiental.com.br/pevs/</p>
            <br>
            <br>
        </section>
        <br>
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
    <script src="/ecoPoint/public/js/validacaopontocoleta.js"></script> <!--Código JS do cadastro de ponto de coleta-->
</body>
</html>