<?php

require_once __DIR__ . '/../models/usuario.php';  //Carregando o modelo de usuário
require_once __DIR__ . '/../../DAO/usuarioDAO.php';  //Carregando a classe de acesso ao banco
require_once __DIR__ . '/../../DAO/pontoColetaDAO.php';  //Carregando a classe de acesso ao banco
require_once __DIR__ . '/../middleware/AuthMiddleware.php';

class MapaController extends Controller {
    public function __construct() {
        AuthMiddleware::check(); //Verifica se o usuário está logado
    }


    public function index() {
        $this->view('mapa/index'); //Mostra a view da tela de mapa
    }


    public function cadastrarPonto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $observacao = $_POST['observacao'] ?? '';
            $cep = $_POST['cep'] ?? '';
            $endereco = $_POST['endereco'] ?? '';
            $numero = $_POST['numero'] ?? '';
            $complemento = $_POST['complemento'] ?? '';
            $bairro = $_POST['bairro'] ?? '';
            $cidade = $_POST['cidade'] ?? '';
            $estado = $_POST['estado'] ?? '';
            $usuario_id = $_SESSION['usuario_id'] ?? null;

            //Validação básica
            if (!$nome || !$cep || !$endereco || !$numero || !$bairro || !$cidade || !$estado) {
                echo "Preencha todos os campos obrigatórios.";
                return;
            }

            //Monta endereço completo
            $enderecoCompleto = "$endereco, $numero, $bairro, $cidade, $estado";

            //Chama função para obter coordenadas
            $coordenadas = $this->obterCoordenadas($enderecoCompleto);
            $latitude = $coordenadas['lat'] ?? null;
            $longitude = $coordenadas['lon'] ?? null;

            
            $usuario_id = $_SESSION['usuario']['id'];

            //Insere no banco
            $pdo = Conexao::getConexao();
            $stmt = $pdo->prepare("INSERT INTO pontos_coleta 
                (usuario_id, nome, observacao, cep, endereco, numero, complemento, bairro, cidade, estado, situacao, latitude, longitude) 
                VALUES (:usuario_id, :nome, :observacao, :cep, :endereco, :numero, :complemento, :bairro, :cidade, :estado, 'pendente', :latitude, :longitude)");

            $stmt->bindValue(':usuario_id', $usuario_id);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':observacao', $observacao);
            $stmt->bindValue(':cep', $cep);
            $stmt->bindValue(':endereco', $endereco);
            $stmt->bindValue(':numero', $numero);
            $stmt->bindValue(':complemento', $complemento);
            $stmt->bindValue(':bairro', $bairro);
            $stmt->bindValue(':cidade', $cidade);
            $stmt->bindValue(':estado', $estado);
            $stmt->bindValue(':latitude', $latitude);
            $stmt->bindValue(':longitude', $longitude);

            if ($stmt->execute()) {
                echo "<script>alert('Ponto de coleta enviado para análise. Obrigada pela ajuda! Está bem ligado na reciclagem eletrônica, ao saber de outros pontos volte quando quiser.'); window.history.back();</script>";
                return;
            } else {
                $erro = $stmt->errorInfo();
                echo "<script>alert('Erro ao cadastrar ponto de coleta: ' . $erro[2]); window.history.back();</script>";
                return;
            }
        }
    }

    
    //API para conseguir latitude e longitude
    private function obterCoordenadas($endereco) {
        $url = "https://nominatim.openstreetmap.org/search?" . http_build_query([
            'q' => $endereco,
            'format' => 'json',
            'limit' => 1
        ]);

        $opts = [
            "http" => [
                "header" => "User-Agent: EcoPoint/1.0"
            ]
        ];
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);

        if ($response) {
            $data = json_decode($response, true);
            if (!empty($data[0])) {
                return [
                    'lat' => $data[0]['lat'],
                    'lon' => $data[0]['lon']
                ];
            }
        }

        if (!$latitude || !$longitude) {
            echo "Erro ao obter coordenadas.";
            return;
        }
        return null;
    }
}

?>