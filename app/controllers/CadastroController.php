<?php

require_once __DIR__ . '/../models/usuario.php';  //Carregando o modelo de usuário
require_once __DIR__ . '/../../DAO/usuarioDAO.php';  //Carregando a classe de acesso ao banco

class CadastroController extends Controller {
    public function index() {
        //Exibe o formulário de cadastro
        $this->view('cadastro/index');
    }


    public function salvar() {
        //Verifica se o método de requisição é POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Obtém os dados do formulário
            $dados = [
                'nome' => strip_tags($_POST['nome']),
                'email' => strip_tags($_POST['email']),
                'cpf' => strip_tags($_POST['cpf']),
                'login' => strip_tags($_POST['login']),
                'senha' => strip_tags($_POST['senha']),
                'endereco' => strip_tags($_POST['endereco']),
                'cidade' => strip_tags($_POST['cidade']),
                'bairro' => strip_tags($_POST['bairro']),
                'cep' => strip_tags($_POST['cep']),
                'numero' => strip_tags($_POST['numero']),
                'complemento' => strip_tags($_POST['complemento']),
                'telefone' => strip_tags($_POST['telefone']),
                'nascimento' => strip_tags($_POST['nascimento']),
            ];

            //Validações:
            //Nome (apenas letras e espaços)
            $nome = $dados['nome'];

            if (!preg_match("/^[\p{L}\s]+$/u", $nome)) {
                echo "<script>alert('Nome inválido. Use apenas letras e espaços.'); window.history.back();</script>";
                exit;
            }

            //Nascimento (mínimo 10 anos)
            $dataNascimento = DateTime::createFromFormat('Y-m-d', $dados['nascimento']);
            $hoje = new DateTime();
            $idade = $hoje->diff($dataNascimento)->y;
            if ($idade < 10) {
                echo "<script>alert('Você precisa ter pelo menos 10 anos.'); window.history.back();</script>";
                exit;
            }

            //Login (mínimo 10 caracteres)
            $login = $dados['login'];
            if (strlen($dados['login']) < 6) {
                echo "<script>alert('Login deve ter no mínimo 6 caracteres.'); window.history.back();</script>";
                exit;
            }

            //Senha (mínimo 8 caracteres)
            $senha = $dados['senha'];
            if (strlen($dados['senha']) < 8) {
                echo "<script>alert('Senha deve ter no mínimo 8 caracteres.'); window.history.back();</script>";
                exit;
            }

            //Confirmar senha (deve ser igual à senha)
            if ($_POST['senha'] !== $_POST['confirmasenha']) {
                echo "<script>alert('As senhas não coincidem.'); window.history.back();</script>";
                exit;
            }

            //Número (obrigatório e numérico)
            $numero = $dados['numero'];
            if (!is_numeric($dados['numero'])) {
                echo "<script>alert('Número do endereço deve ser numérico.'); window.history.back();</script>";
                exit;
            }

            //Telefone (10 ou 11 dígitos)
            $telefone = $dados['telefone'];
            $telefoneLimpo = preg_replace('/\D/', '', $dados['telefone']);
            if (!preg_match('/^\d{10,11}$/', $telefoneLimpo)) {
                echo "<script>alert('Telefone inválido. Use DDD + número.'); window.history.back();</script>";
                exit;
            }

            //Email (validação com filter_var)
            $email = $dados['email'];
            if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('E-mail inválido.'); window.history.back();</script>";
                exit;
            }

            //Validação de CPF inválido
            $cpf = $dados['cpf'] ?? '';
            if (!$this->validarCPF($cpf)) {
                echo "<script>alert('CPF inválido.'); window.history.back();</script>";
                exit;
            }

            //Criação do objeto UsuarioDAO para verificar duplicidade
            $usuarioDAO = new UsuarioDAO();

            //Verificação de CPF duplicado
            $usuarioExistente = $usuarioDAO->buscarPorCPF($cpf);
            if ($usuarioExistente) {
                echo "<script>alert('Este CPF já cadastrado.'); window.history.back();</script>";
                exit;
            }

            //Criação de objeto Usuario
            $usuario = new Usuario();
            $usuario->setDados($dados);
            
            //Tenta salvar o novo usuário
            if ($usuarioDAO->inserir($usuario)) {
                echo "<script>alert('Cadastro finalizado!');window.location.href='/ecoPoint/login';</script>";
                exit;
            } else {
                echo "Erro ao cadastrar o usuário. Tente novamente!";
            }   
        }
    }


    private function validarDados($dados) {
        foreach ($dados as $campo => $valor) {
            if (empty($valor)) {
                return "Campo {$campo} não pode ser vazio!";
            }
        }

        foreach ($_POST as $campos => $valor) {
            $campo = strip_tags($valor);
        }
        return true;
    }


    private function validarCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            $soma = 0;
            for ($c = 0; $c < $t; $c++) {
                $soma += $cpf[$c] * (($t + 1) - $c);
            }
            $digito = (10 * $soma) % 11;
            $digito = ($digito == 10) ? 0 : $digito;
            if ($cpf[$t] != $digito) {
                return false;
            }
        }
        return true;
    }
}

?> 
