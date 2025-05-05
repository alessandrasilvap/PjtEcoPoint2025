<?php

require_once(__DIR__ . '/conexao.php');

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao(); //Função de conexão com o banco
    }

    public function inserir(Usuario $usuario) {
        //Usando prepared statements e placeholders (interrogações) para a inserção dos dados
        $sql = "INSERT INTO usuario (nome, email, cpf, login, senha, endereco, cidade, bairro, cep, numero, complemento, telefone, nascimento)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //Preparar a declaração SQL
        $stmt = $this->conn->prepare($sql);

        //Hash da senha
        $senhaHash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        //Executar o comando
        /*Dados são inseridos de forma segura através daqui, onde os valores 
        são passados como parâmetros no execute, o que evita a injeção de SQL*/
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

    /*No método buscarPorLogin($login), usando prepared statements 
    corretamente com o bindParam, o que já evita SQL Injection. Garantindo
    que o valor do login não seja executado diretamente no SQL*/
    public function buscarPorLogin($login) {
        $sql = "SELECT * FROM usuario WHERE login = :login";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); //Retorna os dados do usuário
    }

    public function buscarPorCPF($cpf) {
        $sql = "SELECT * FROM usuario WHERE cpf = :cpf";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorEmail($email) {
        try {
            $sql = "SELECT * FROM usuario WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao buscar usuário por e-mail: " . $e->getMessage());
        }
    }    

    public function atualizarSenha($usuarioId, $novaSenhaHash) {
        try {
            $sql = "UPDATE usuario SET senha = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$novaSenhaHash, $usuarioId]);
        } catch (PDOException $e) {
            die("Erro ao atualizar a senha: " . $e->getMessage());
        }
    }
}

?>