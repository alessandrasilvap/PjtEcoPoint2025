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

    //Métodos setters e getters para cada propriedade (Nome, Email, etc.)

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

    //Getter Methods
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

}

?>
