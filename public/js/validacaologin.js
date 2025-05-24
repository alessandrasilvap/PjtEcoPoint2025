document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); //Evita o envio padrão do formulário

    if (!validarLogin()) {
        return; //Se a validação falhar, não envia
    }

    const usuario = document.getElementById('usuario').value.trim();
    const senha = document.getElementById('senha').value.trim();

    const formData = new FormData();
    formData.append('login', usuario);
    formData.append('senha', senha);

    fetch('/ecoPoint/login/autenticar', {
        method: 'POST',
        body: formData
    })
    .then(resposta => resposta.json())
    .then(data => {
        if (data.sucesso) {
            window.location.href = '/ecoPoint/sobre'; //Redireciona para a próxima página
        } else {
            mostrarErro(data.erro); //Exibe erro de login incorreto
        }
    })
    .catch(() => {
        mostrarErro('Erro ao tentar fazer login. Tente novamente.');
    });
});



function validarLogin() {
    const usuario = document.getElementById('usuario').value.trim();
    const senha = document.getElementById('senha').value.trim();

    if (usuario === "" && senha === "") {
        mostrarErro("Por favor, preencha o usuário e a senha.");
        return false;
    }

    if (usuario === "") {
        mostrarErro("Por favor, preencha o campo de usuário.");
        return false;
    }

    if (senha === "") {
        mostrarErro("Por favor, preencha o campo de senha.");
        return false;
    }

    esconderErro(); //Tudo certo, esconde mensagens
    return true;
}



function mostrarErro(mensagem) {
    const divErro = document.getElementById('mensagemErro');
    divErro.textContent = mensagem;
    divErro.style.display = "block";

    setTimeout(() => {
        divErro.style.display = "none";
    }, 4000);
}



function esconderErro() {
    const divErro = document.getElementById('mensagemErro');
    divErro.style.display = "none";
}