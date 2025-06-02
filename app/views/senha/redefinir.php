<style>
    .form-container {
        max-width: 400px;
        margin: 60px auto;
        background-color: #f5f5f5;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }


    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2e7d32;
    }


    .form-container label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
        color: #333;
    }


    .form-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }


    .form-container button {
        width: 100%;
        padding: 12px;
        background-color: #388e3c;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    
    .form-container button:hover {
        background-color: #2e7d32;
    }
</style>
<link rel="shortcut icon" href="/ecoPoint/public/imagens/icone.ico" type="image/x-icon"> <!--Ícones do site-->
<div class="form-container">
    <h2>Redefinir Senha</h2>
    <form action="/ecoPoint/senha/salvarNovaSenha" method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" minlength="6" maxlength="10" required>

        <label for="confirma_senha">Confirme a Nova Senha:</label>
        <input type="password" id="confirma_senha" name="confirma_senha" minlength="6" maxlength="10" required>

        <button type="submit">Redefinir Senha</button>
    </form>
</div>
