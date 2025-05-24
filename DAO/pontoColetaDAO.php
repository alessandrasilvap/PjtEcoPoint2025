<?php

class PontoColeta {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao(); //Função de conexão com o banco
    }


    public function cadastrar($dados) {
        $sql = "INSERT INTO pontos_coleta (usuario_id, nome, observacao, cep, endereco, numero, complemento, bairro, cidade, estado)
                VALUES (:usuario_id, :nome, :observacao, :cep, :endereco, :numero, :complemento, :bairro, :cidade, :estado)";
                
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $dados['usuario_id'],
            ':nome' => $dados['nome'],
            ':observacao' => $dados['observacao'],
            ':cep' => $dados['cep'],
            ':endereco' => $dados['endereco'],
            ':numero' => $dados['numero'],
            ':complemento' => $dados['complemento'],
            ':bairro' => $dados['bairro'],
            ':estado' => $dados['estado'],
            ':cidade' => $dados['cidade']
        ]);
    }


    public function verificarDuplicidade($dados) {
        $sql = "SELECT COUNT(*) FROM pontos_coleta 
                WHERE nome = :nome AND cep = :cep AND numero = :numero";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome'],
            ':cep' => $dados['cep'],
            ':numero' => $dados['numero']
        ]);
    
        return $stmt->fetchColumn() > 0;
    }
}

?>