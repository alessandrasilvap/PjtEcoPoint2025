<?php

require_once(__DIR__ . '/conexao.php');

class TokenRecuperacaoDAO {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao(); //Função de conexão com o banco
    }


    public function salvar($usuarioId, $email, $token, $expiracao) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tokens_recuperacao (usuario_id, email, token, expiracao) VALUES (?, ?, ?, ?)");
            $stmt->execute([$usuarioId, $email, $token, $expiracao]);
        } catch (PDOException $e) {
            die("Erro ao salvar o token: " . $e->getMessage());
        }
    }

    
    public function buscarPorToken($token) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tokens_recuperacao WHERE token = ? AND expiracao >= NOW() AND usado = 0");
            $stmt->execute([$token]);
            return $stmt->fetch(PDO::FETCH_ASSOC); //Retorna os dados ou false se não encontrar
        } catch (PDOException $e) {
            die("Erro ao buscar token: " . $e->getMessage());
        }
    }


    public function marcarComoUsado($token) {
        try {
            $stmt = $this->conn->prepare("UPDATE tokens_recuperacao SET usado = 1 WHERE token = ?");
            $stmt->execute([$token]);
        } catch (PDOException $e) {
            die("Erro ao marcar token como usado: " . $e->getMessage());
        }
    }
}

?>