<?php

require_once(__DIR__ . '/conexao.php');

class Quiz {
    private $conn;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }


    public function buscarPerguntasQuiz($limite = 5) { //Adicione um parâmetro para o limite
        //Seleciona IDs de perguntas aleatórias
        $sqlPerguntas = "SELECT id FROM perguntas ORDER BY RAND() LIMIT :limite";
        $stmtPerguntas = $this->conexao->prepare($sqlPerguntas);
        $stmtPerguntas->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmtPerguntas->execute();
        $idsPerguntas = $stmtPerguntas->fetchAll(PDO::FETCH_COLUMN); //Pega apenas os IDs

        if (empty($idsPerguntas)) {
            return []; //Nenhuma pergunta encontrada
        }

        //Converte o array de IDs para uma string para usar na cláusula IN
        $idsString = implode(',', array_fill(0, count($idsPerguntas), '?'));

        //Agora, seleciona as perguntas completas e suas alternativas usando os IDs selecionados
        $sql = "SELECT p.id AS pergunta_id, p.texto AS pergunta_texto,
                       a.id AS alternativa_id, a.texto AS alternativa_texto, a.correta
                FROM perguntas p
                JOIN alternativas a ON p.id = a.pergunta_id
                WHERE p.id IN ({$idsString})
                ORDER BY FIELD(p.id, " . implode(',', $idsPerguntas) . ")"; //Mantém a ordem original das perguntas selecionadas randomicamente

        $stmt = $this->conexao->prepare($sql);

        //Bind dos parâmetros dos IDs (para segurança, mesmo sendo INT)
        foreach ($idsPerguntas as $k => $id) {
            $stmt->bindValue(($k+1), $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $perguntasFormatadas = [];
        foreach ($resultados as $row) {
            $perguntaId = $row['pergunta_id'];

            if (!isset($perguntasFormatadas[$perguntaId])) {
                $perguntasFormatadas[$perguntaId] = [
                    'question' => $row['pergunta_texto'],
                    'answers' => []
                ];
            }
            $perguntasFormatadas[$perguntaId]['answers'][] = [
                'text' => $row['alternativa_texto'],
                'correct' => (bool)$row['correta'] //Converte 0/1 para false/true
            ];
        }
        //Reindexar o array para que fique como um array numérico, não associativo por ID
        return array_values($perguntasFormatadas);
    }
}

?>
