document.querySelector('form').addEventListener('submit', function(event) {
    if (!validarlogin()) { //Verifica se a validação falhou
        event.preventDefault(); //Previne o envio do formulário
    }
});

function validarlogin() {
    var usuario = document.getElementById('usuario').value;
    var senha = document.getElementById('senha').value;

    if (usuario === "" || senha === "") {
        alert('[ERRO] Usuário ou senha não preenchidos.');
        return false; //Impede o envio do formulário se a validação falhar
    }
    return true; //Permite o envio se a validação passar
}
