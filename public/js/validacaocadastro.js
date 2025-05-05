


function formatarCPF(input) {
    let cpf = input.value.replace(/\D/g, '');

    if (cpf.length > 11) cpf = cpf.slice(0, 11);

    if (cpf.length > 9) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4");
    } else if (cpf.length > 6) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3");
    } else if (cpf.length > 3) {
        cpf = cpf.replace(/(\d{3})(\d{1,3})/, "$1.$2");
    }

    input.value = cpf;
}

function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false;
    }

    let soma = 0;

    // Primeiro dígito verificador
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let dv1 = 11 - (soma % 11);
    if (dv1 >= 10) dv1 = 0;
    if (dv1 !== parseInt(cpf.charAt(9))) {
        return false;
    }

    // Segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    let dv2 = 11 - (soma % 11);
    if (dv2 >= 10) dv2 = 0;
    if (dv2 !== parseInt(cpf.charAt(10))) {
        return false;
    }

    return true;
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
});

//Formato (XX) XXXXX-XXXX do TELEFONE
function formatarTEL(input){
    let tel = input.value.replace(/\D/g, ''); //Remove caracteres não numéricos

    if (tel.length > 11) { //Verifica se o TEL tem 11 dígitos
        tel = tel.slice(0, 11);
    }
    if (tel.length === 11) { //Adiciona os parenteses e o hífen
        tel = `(${tel.slice(0, 2)}) ${tel.slice(2, 7)}-${tel.slice(7)}`;
    } else if (tel.length === 10) {
        tel = `(${tel.slice(0, 2)}) ${tel.slice(2, 6)}-${tel.slice(6)}`;
    }
    input.value = tel;
}

function validarEmail(email) {
    const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(email);
}

function validarIdade(dataNascimento) {
    const data = new Date(dataNascimento);
    const hoje = new Date();
    const idade = hoje.getFullYear() - data.getFullYear();
    const mes = hoje.getMonth() - data.getMonth();

    if (mes < 0 || (mes === 0 && hoje.getDate() < data.getDate())) {
        return idade - 1 >= 10;
    }

    return idade >= 10;
}

function validarcadastro(event) {
     event.preventDefault();
    console.log('Função validarcadastro chamada!');

    const nomecompleto = document.getElementById('nomecompleto').value.trim();
    const datanascimento = document.getElementById('datanascimento').value;
    const usuario = document.getElementById('campousuario').value.trim();
    const senha = document.getElementById('camposenha').value;
    const confirmasenha = document.getElementById('confirmasenha').value;
    const cep = document.getElementById('cep').value.trim();
    const num = document.getElementById('num').value.trim();
    const tel = document.getElementById('tel').value.trim();
    const cpf = document.getElementById('cpf').value.trim();
    const email = document.getElementById('inserirEmail').value.trim();

    if (!nomecompleto || !datanascimento || !usuario || !senha || !confirmasenha || !cep || !num || !tel || !cpf || !email) {
        alert('[ERRO] Todos os campos são obrigatórios!');
        return false;
    }

    if (!validarIdade(datanascimento)) {
        alert('[ERRO] Você deve ter pelo menos 10 anos para continuar.');
        return false;
    }

    if (senha !== confirmasenha) {
        alert('[ERRO] As senhas não coincidem.');
        return false;
    }

    if (!validarCPF(cpf)) {
        alert('[ERRO] CPF inválido!');
        return false;
    }

    if (!validarEmail(email)) {
        alert('[ERRO] E-mail inválido!');
        return false;
    }

    document.getElementById("formCadastro").submit();
}

document.addEventListener("DOMContentLoaded", function() {
    //Agora o script só será executado após o carregamento do DOM
    const formCadastro = document.getElementById("formCadastro");

    if (formCadastro) {
        formCadastro.addEventListener("submit", validarcadastro);
    }
});