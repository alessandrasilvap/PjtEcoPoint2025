document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    recuperarSenha();
});



function recuperarSenha() {
    var email = document.getElementById('email').value;


    if (email === '') {
        alert('[ERRO] Por favor, preencha ambos os campos de e-mail.');
        return;
    }

    fetch('/ecoPoint/senha/enviarEmail', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `email=${encodeURIComponent(email)}`
    })
    .then(response => response.text())
    .then(data => {
        console.log('Resposta do servidor:', data);
        alert('Se o e-mail existir, instruções foram enviadas.');
    })
    .catch(error => {
        console.error('Erro ao enviar requisição:', error);
        alert('Erro ao processar o pedido.');
    });
}