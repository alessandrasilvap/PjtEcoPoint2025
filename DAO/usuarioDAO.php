<?php
require_once 'conexao.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao(); //Função de conexão com o banco
    }

    public function inserir(Usuario $usuario) {
        $sql = "INSERT INTO usuario (nome, email, cpf, login, senha, endereco, cidade, bairro, cep, numero, complemento, telefone, nascimento)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //Preparar a declaração SQL
        $stmt = $this->conn->prepare($sql);

        //Hash da senha
        $senhaHash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        //Executar o comando
        return $stmt->execute([
            $usuario->getNome(), 
            $usuario->getEmail(), 
            $usuario->getCpf(), 
            $usuario->getLogin(),
            $senhaHash, 
            $usuario->getEndereco(), 
            $usuario->getCidade(), 
            $usuario->getBairro(), 
            $usuario->getCep(), 
            $usuario->getNumero(), 
            $usuario->getComplemento(), 
            $usuario->getTelefone(), 
            $usuario->getNascimento()
        ]);
    }

    public function buscarPorLogin($login) {
        $sql = "SELECT * FROM usuario WHERE login = :login";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); //Retorna os dados do usuário
    }
    
}

?>
