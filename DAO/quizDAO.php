<?php

require_once(__DIR__ . '/conexao.php');

class Quiz {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao(); //Função de conexão com o banco
    }


    public function getPerguntasComAlternativas() {
        $sql = "SELECT p.id AS pergunta_id, p.texto AS pergunta_texto, 
                       a.id AS alternativa_id, a.texto AS alternativa_texto, a.correta
                FROM perguntas p
                JOIN alternativas a ON p.id = a.pergunta_id
                ORDER BY RAND()
                LIMIT 12";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $perguntas = [];

        foreach ($dados as $linha) {
            $id = $linha['pergunta_id'];
            if (!isset($perguntas[$id])) {
                $perguntas[$id] = [
                    'question' => $linha['pergunta_texto'],
                    'answers' => []
                ];
            }
            $perguntas[$id]['answers'][] = [
                'text' => $linha['alternativa_texto'],
                'correct' => $linha['correta'] ? true : false
            ];
        }
        return array_values($perguntas);
    }
}

?>