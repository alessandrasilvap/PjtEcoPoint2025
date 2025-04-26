<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa - Eco Point</title>
    <link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
    <link rel="stylesheet" href="/ecoPoint/public/css/mapa.css"> <!--Código CSS do site todo-->
    <link rel="stylesheet" href="/ecoPoint/public/css/acesibfeedback.css"> <!--Código CSS do painel de acessibilidade e da caixa de feedback-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--Link para utilização de ícones Font Awesome-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> <!--Inclui o CSS do Leaflet, onde Leaflet é uma biblioteca JavaScript de código aberto que permite a criação de aplicativos de mapeamento virtuais-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"/> <!--Google Material Symbols-->
</head>
<body>
    <header></header>
    <div class="conteudo">
        <nav id="menu">
            <ul class="menu5">
                <a href="<?= BASE_URL ?>/sobre">Sobre Nós</a>
                <a href="<?= BASE_URL ?>/Informacoes">Informações</a>
                <a href="<?= BASE_URL ?>/ongs">Ong's</a>
                <a href="<?= BASE_URL ?>/mapa">Mapa</a>
            </ul>
        </nav>
        <br>
        <br>
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
    
                //Adiciona um marcador na posição especificada e adiciona um popup ao clicar.
                const marker = L.marker([-22.9035, -43.2096]).addTo(map);
                marker.bindPopup('REDE ENTROPIA').openPopup();
    
                const pontos = [
                    { coords: [-22.901118, -43.183435], nome: "RETIPEL" }, //Exemplo de ponto
                    { coords: [-22.904817, -43.176462], nome: "SABOR SAUDE" },  //Outro ponto
                    { coords: [-22.904982, -43.176313], nome: "T.T. BURGUER" },  //Outro ponto
                    { coords: [-22.905054, -43.184149], nome: "SOLETO URUGUAIANA" },  //Outro ponto
                    { coords: [-22.930665, -43.180084], nome: "Colégio EDEM" },  //Outro ponto
                    { coords: [-22.984678, -43.219712], nome: "Loja Ahlma" },  //Outro ponto
                    { coords: [-22.979325, -43.221055], nome: "Clube de Regatas Flamengo" },  //Outro ponto
                    { coords: [-22.983368, -43.218491], nome: "Shopping Rio Design Leblon" },  //Outro ponto
                    { coords: [-22.985545, -43.227639], nome: "T.T. Burguer" },  //Outro ponto
                    { coords: [-22.953818, -43.190190], nome: "Galeria Info Zona Sul" },  //Outro ponto
                    { coords: [-22.921872, -43.176173], nome: "NEX COWORKING" },  //Outro ponto
                    { coords: [-22.951918, -43.184905], nome: "UNIRIO" },  //Outro ponto
                    { coords: [-22.931480, -43.180927], nome: "REDE ASTA" },  //Outro ponto
                    { coords: [-22.886616, -43.264636], nome: "COOPAMA" },  //Outro ponto
                    { coords: [-22.832808, -43.347949], nome: "ACMR" },  //Outro ponto
                    { coords: [-22.869763, -43.275592], nome: "COOPCAL" },  //Outro ponto
                    { coords: [-22.874122, -43.282002], nome: "COOPGALEÃO" },  //Outro ponto
                    { coords: [-22.918575, -43.237834], nome: "Maraca Hostel" },  //Outro ponto
                    { coords: [-22.921548, -43.255970], nome: "One On One Coworking" },  //Outro ponto
                    { coords: [-22.006827, -43.457705], nome: "Condominio Sublime" },  //Outro ponto
                    { coords: [-22.999420, -43.344194], nome: "IJOKER no Shopping Bayside" },  //Outro ponto
                    { coords: [-22.001479, -43.386056], nome: "Shopping Rio Design Barra" },  //Outro ponto
                    { coords: [-22.007394, -43.323952], nome: "ASSOCIAÇÃO BOSQUE MARAPENDI" },  //Outro ponto
                    { coords: [-22.010545, -43.304444], nome: "T.T. BURGUER" },  //Outro ponto
                    { coords: [-22.023706, -43.481743], nome: "ESTACIONAMENTO TERREIRÃO" },  //Outro ponto
                    { coords: [-22.002490, -43.350012], nome: "VEZPA - PARQUE DAS ROSAS" },  //Outro ponto
                    { coords: [-22.003301, -43.321321], nome: "ICAIU - CITTÁ AMÉRICA" },  //Outro ponto
                    { coords: [-25.48813, -49.34549], nome: "Ecoponto Caiuá" },  //Outro ponto
                    { coords: [-25.46293, -49.19528], nome: "Ecoponto Cajuru" },  //Outro ponto
                    { coords: [-25.58104, -49.32730], nome: "Ecoponto Campo de Santana" },  //Outro ponto
                    { coords: [-25.51209, -49.33182], nome: "Ecoponto CIC" },  //Outro ponto
                    { coords: [-25.53202, -49.25127], nome: "Ecoponto Érico Veríssimo" },  //Outro ponto
                    { coords: [-25.55015, -49.25444], nome: "Ecoponto Guaçuí" },  //Outro ponto
                    { coords: [-25.49152, -49.20291], nome: "Ecoponto Icaraí" },  //Outro ponto
                    { coords: [-25.55455, -49.24470], nome: "Ecoponto Jandaia" },  //Outro ponto
                    { coords: [-25.42127, -49.36383], nome: "Ecoponto Metropolitano" },  //Outro ponto
                    { coords: [-25.52940, -49.23031], nome: "Ecoponto Vila Nova" },  //Outro ponto
                    { coords: [-25.50299, -49.22663], nome: "DMT Reciclagem" },  //Outro ponto
                    { coords: [-26.22782, -52.67011], nome: "PREFEITURA DE PATO BRANCO" },  //Outro ponto
                    { coords: [-8.03763, -34.94252], nome: "Reeecicle" },  //Outro ponto
                    { coords: [-23.51544, -46.59045], nome: "Rapidosucata" },  //Outro ponto
                    { coords: [-23.51524, -46.59048], nome: "Rapidosucata" }  //Outro ponto
                ];
                pontos.forEach(ponto => {
                    const marker = L.marker(ponto.coords).addTo(map);
                    marker.bindPopup(ponto.nome).openPopup();
                });
            </script>
            <br>
            <p>Para mais informações sobre os pontos indicados e outros locais de reciclagem eletrônica, entre em contato conosco ou acesse o site da Comlubr.</p>
            <h4 class="comlurb">https://comlurb.prefeitura.rio/servico/coleta-seletiva/onde-descartar-materiais-que-nao-sao-coletados/</h4>
            <h4 class="comlurb">https://www.curitiba.pr.gov.br/servicos/ecopontos-descarte-correto-de-residuos/716</h4>
            <h4 class="comlurb">https://www.seteambiental.com.br/pevs/</h4>
            <br>
            <br>
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
