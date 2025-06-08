<?php

require_once __DIR__ . '/../models/usuario.php';
require_once __DIR__ . '/../../DAO/usuarioDAO.php';
require_once __DIR__ . '/../../DAO/tokenRecuperacaoDAO.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SenhaController extends Controller {
    public function index() {
        $this->view('senha/index');
    }


    public function enviarEmail() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'];

            //Validação inicial
            if (empty($email)) {
                echo "<script>alert('Preencha todos os campos.'); window.history.back();</script>";
                return;
            }

            //Validação de e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('E-mail inválido.'); window.history.back();</script>";
                return;
            }

            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->buscarPorEmail($email);
            $usuarioId = $usuario['id'];

            if ($usuario) {
                $token = bin2hex(random_bytes(32)); //Gera um token seguro
                $expiracao = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $tokenRecuperacaoDAO = new TokenRecuperacaoDAO();
                $tokenRecuperacaoDAO->salvar($usuarioId, $email, $token, $expiracao);

                $link = "http://localhost/ecoPoint/senha/redefinir?token=$token";
                $mensagem = "
                    <p>Olá!</p>
                    <p>Você solicitou a redefinição da sua senha no <strong>EcoPoint</strong>.</p>
                    <p>Clique no botão abaixo para redefinir:</p>
                    <p><a href=\"$link\" style=\"padding:10px 20px; background:#28a745; color:white; text-decoration:none; border-radius:5px;\">Redefinir Senha</a></p>
                    <p>Se você não solicitou isso, ignore este e-mail.</p>
                    <p>Este link expirará em 1 hora.</p>
                ";

                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'ecopointverde@gmail.com';
                    $mail->Password = 'jkmicwzoqoxamsxl';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('ecopointverde@gmail.com', 'EcoPoint');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = 'Recuperação de Senha - EcoPoint';
                    $mail->Body = $mensagem;

                    $mail->send();
                } catch (Exception $e) {
                    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
                }

            }
            echo "<script>alert('Se o e-mail existir no sistema, você receberá um link.'); window.location.href='/ecoPoint/senha';</script>";
        }
    }


    public function redefinir() {
        $token = $_GET['token'] ?? '';

        //Validação inicial do token na URL
        if (empty($token)) { //Usar empty() para checar se a string está vazia ou não definida
            echo "<script>alert('Token inválido.'); window.location.href='/ecoPoint/senha';</script>";
            exit;
        }

        //Busca a validação do token no banco de dados
        $tokenRecuperacaoDAO = new TokenRecuperacaoDAO();
        $dadosToken = $tokenRecuperacaoDAO->buscarPorToken($token);

        if (!$dadosToken) {
            echo "<script>alert('Token expirado ou inválido.'); window.location.href='/ecoPoint/senha';</script>";
            exit;
        }

        //Validação de expiração e status de uso do token
        $expiracao = new DateTime($dadosToken['expiracao']);
        $now = new DateTime();

        if ($now < $expiracao && !$dadosToken['usado']) {
            //Token válido e não usado → renderiza o formulário de nova senha
            //A view agora só precisa do token para o campo oculto.
            $this->view('senha/redefinir', ['token' => $token]);
        } else {
            //Token expirado ou já usado
            echo "<script>alert('Token expirado ou já utilizado.'); window.location.href='/ecoPoint/senha';</script>";
            exit;
        }
    }
    

    public function salvarNovaSenha() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $novaSenha = $_POST['nova_senha'];
            $confirmaSenha = $_POST['confirma_senha'];
    
            //Verificação inicial
            if (empty($novaSenha) || empty($confirmaSenha)) {
                echo "<script>alert('Preencha todos os campos.'); window.history.back();</script>";
                return;
            }
    
            if ($novaSenha !== $confirmaSenha) {
                echo "<script>alert('As senhas não coincidem.'); window.history.back();</script>";
                return;
            }
    
            $tokenRecuperacaoDAO = new TokenRecuperacaoDAO();
            $dadosToken = $tokenRecuperacaoDAO->buscarPorToken($token);
    
            //Validação do token
            if ($dadosToken && !$dadosToken['usado'] && strtotime($dadosToken['expiracao']) > time()) {
                $usuarioId = $dadosToken['usuario_id'];
    
                //Criptografar a nova senha
                $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);
    
                //Atualizar senha no banco
                $usuarioDAO = new UsuarioDAO();
                $usuarioDAO->atualizarSenha($usuarioId, $senhaCriptografada);
    
                //Marcar o token como usado
                $tokenRecuperacaoDAO->marcarComoUsado($token);
    
                echo "<script>alert('Senha redefinida com sucesso!'); window.location.href='/ecoPoint/login';</script>";
            } else {
                echo "<script>alert('Token inválido ou expirado.'); window.location.href='/ecoPoint/senha';</script>";
            }
        }
    }
}

?>