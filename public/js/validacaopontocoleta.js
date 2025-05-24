document.addEventListener("DOMContentLoaded", function() {
    //Agora o script só será executado após o carregamento do DOM
    const formColeta = document.getElementById("formColeta");

    if (formColeta) {
        formColeta.addEventListener("submit", validarPontocoleta);
    }
});



function validarPontocoleta(event) {
    event.preventDefault(); //Impede o envio do formulário caso o formulário esteja errado

    var nome = document.getElementById('nome').value;
    var cep = document.getElementById('cep').value;
    var num = document.getElementById('num').value;

    //Verifica se todos os campos obrigatórios foram preenchidos
    if (nome === '' || cep === '' || num === '') {
        alert('[ERRO] Os campos são obrigatórios, por favor não deixe de preencher.');
        return false;
    }

    //Envia o formulário
    formColeta.submit(); //Chama submit do formulário
}



//Formato XXXXX-XXX do CEP
function formatarCEP(input) {
    let cep = input.value.replace(/\D/g, ''); //Remove caracteres não numéricos

    if (cep.length > 8) { //Verifica se o CEP tem 8 dígitos
        cep = cep.slice(0, 8);
    }
    if (cep.length > 5) { //Adiciona o hífen
        cep = cep.slice(0, 5) + '-' + cep.slice(5); //'.slice' é usado para extrair uma parte de uma string ou de um array e retorná-la como uma nova string
    }
    input.value = cep;
}



document.getElementById('buscar').addEventListener('click', function() {

    const cep = document.getElementById('cep').value;

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(response => response.json())
    .then(data => {
        if (data.erro) {
            alert('CEP não encontrado.');
            return;
        }
        document.querySelector('input#rua').value = data.logradouro;
        document.querySelector('input#bairro').value = data.bairro;
        document.querySelector('input#cidade').value = data.localidade;
        document.querySelector('input#estado').value = data.estado;
    })

    .catch(error => {
        alert('Erro ao buscar o CEP.');
        console.error('Erro:', error);
    });
});



document.getElementById('buscar').addEventListener('click', function() {
document.getElementById('rua').textContent = '';
document.getElementById('bairro').textContent = '';
document.getElementById('cidade').textContent = '';
document.getElementById('estado').textContent = '';
});