<?php

class Usuario {
    private $nome;
    private $email;
    private $cpf;
    private $login;
    private $senha;
    private $endereco;
    private $cidade;
    private $bairro;
    private $cep;
    private $numero;
    private $complemento;
    private $telefone;
    private $nascimento;

    public function __construct($dados = []) {
        if (!empty($dados)) {
            $this->setDados($dados);
        }
    }

    
    public function setDados($dados) {
        $this->nome = $dados['nome'];
        $this->email = $dados['email'];
        $this->cpf = $dados['cpf'];
        $this->login = $dados['login'];
        $this->senha = $dados['senha'];
        $this->endereco = $dados['endereco'];
        $this->cidade = $dados['cidade'];
        $this->bairro = $dados['bairro'];
        $this->cep = $dados['cep'];
        $this->numero = $dados['numero'];
        $this->complemento = $dados['complemento'];
        $this->telefone = $dados['telefone'];
        $this->nascimento = $dados['nascimento'];
    }

    //Getters
    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
    public function getCpf() { return $this->cpf; }
    public function getLogin() { return $this->login; }
    public function getSenha() { return $this->senha; }
    public function getEndereco() { return $this->endereco; }
    public function getCidade() { return $this->cidade; }
    public function getBairro() { return $this->bairro; }
    public function getCep() { return $this->cep; }
    public function getNumero() { return $this->numero; }
    public function getComplemento() { return $this->complemento; }
    public function getTelefone() { return $this->telefone; }
    public function getNascimento() { return $this->nascimento; }

    //Inserir no banco de dados
    public function inserir($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO usuario 
            (nome, email, cpf, login, senha, endereco, cidade, bairro, cep, numero, complemento, telefone, nascimento) 
            VALUES 
            (:nome, :email, :cpf, :login, :senha, :endereco, :cidade, :bairro, :cep, :numero, :complemento, :telefone, :nascimento)");

            $stmt->bindValue(':nome', $this->getNome());
            $stmt->bindValue(':email', $this->getEmail());
            $stmt->bindValue(':cpf', $this->getCpf());
            $stmt->bindValue(':login', $this->getLogin());
            $stmt->bindValue(':senha', $this->getSenha());
            $stmt->bindValue(':endereco', $this->getEndereco());
            $stmt->bindValue(':cidade', $this->getCidade());
            $stmt->bindValue(':bairro', $this->getBairro());
            $stmt->bindValue(':cep', $this->getCep());
            $stmt->bindValue(':numero', $this->getNumero());
            $stmt->bindValue(':complemento', $this->getComplemento());
            $stmt->bindValue(':telefone', $this->getTelefone());
            $stmt->bindValue(':nascimento', $this->getNascimento());

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir usuário: " . $e->getMessage());
        }
    }


    public function buscarPorEmail($email) {
        $pdo = Conexao::getConexao();
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>