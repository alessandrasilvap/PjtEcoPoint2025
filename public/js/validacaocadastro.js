document.addEventListener("DOMContentLoaded", function() {
    //Agora o script só será executado após o carregamento do DOM
    const formCadastro = document.getElementById("formCadastro");

    if (formCadastro) {
        formCadastro.addEventListener("submit", validarcadastro);
    }
});

function validarcadastro(event) {
    event.preventDefault(); //Impede o envio do formulário caso o formulário esteja errado

    var nomecompleto = document.getElementById('nomecompleto').value;//
    var datanascimento = document.getElementById('datanascimento').value;
    var usuario = document.getElementById('campousuario').value;
    var senha = document.getElementById('camposenha').value;
    var confirmasenha = document.getElementById('confirmasenha').value;
    var cep = document.getElementById('cep').value;
    var num = document.getElementById('num').value;
    var tel = document.getElementById('tel').value;
    var cpf = document.getElementById('cpf').value;
    var Inseriremail = document.getElementById('inserirEmail').value;

    //Verifica se todos os campos obrigatórios foram preenchidos
    if (nomecompleto === '' || datanascimento === '' || confirmasenha === '' || senha === '' || usuario === '' || cep === '' || num === '' || tel === '' || cpf === '' || Inseriremail === '') {
        alert('[ERRO] Os campos são obrigatórios, por favor não deixe de preencher.');
        return false;
    }

    //Verifica se as senhas coincidem
    if (senha !== confirmasenha) {
        alert('[ERRO] As senhas não coincidem.');
        return false;
    }

    //Valida CPF
    if (!validarCPF(cpf)) {
        return false;
    }

    //Envia o formulário
    formCadastro.submit(); //Chama submit do formulário
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



// Máscara ao digitar
document.getElementById('cpf').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número

    // Aplica a máscara 000.000.000-00
    if (value.length > 3 && value.length <= 6)
        value = value.replace(/(\d{3})(\d+)/, '$1.$2');
    else if (value.length > 6 && value.length <= 9)
        value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
    else if (value.length > 9)
        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d+)/, '$1.$2.$3-$4');

    e.target.value = value;
});

// Validação do CPF
function validarCPF(cpfStr) {
    let cpf = cpfStr.replace(/\D/g, ''); // Remove pontos e hífen

    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        alert('CPF inválido!');
        return false;
    }

    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let dv1 = (soma * 10) % 11;
    if (dv1 === 10 || dv1 === 11) dv1 = 0;
    if (dv1 !== parseInt(cpf.charAt(9))) {
        alert('CPF inválido!');
        return false;
    }

    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    let dv2 = (soma * 10) % 11;
    if (dv2 === 10 || dv2 === 11) dv2 = 0;
    if (dv2 !== parseInt(cpf.charAt(10))) {
        alert('CPF inválido!');
        return false;
    }

    return true;
}



//Formato exemplo@email.com do E-mail
function validarEmail(input) {
    var re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return re.test(input);
/*expressão regular  
- ^ : início da string
- [a-zA-Z0-9._%+-]+ : caracteres permitidos antes do @ (letras, números, ., _, %, +, -)
- @ : símbolo @
- [a-zA-Z0-9.-]+ : caracteres permitidos após o @ (letras, números, ., -)
- \. : ponto antes da extensão
- [a-zA-Z]{2,} : extensão do domínio (letras, mínimo 2 caracteres)
- $ : fim da string*/
}



//Restrição de idade
function validarIdade(dataNascimento) {
    var data = new Date(dataNascimento); //A data de nascimento é convertida para um objeto
    var dataAtual = new Date(); //Uma nova instância de Date é criada para obter a data atual
    var anoAtual = dataAtual.getFullYear(); //O ano atual é extraído da data atual usando o método 'getFullYear()'
    var anoNascimento = data.getFullYear();
    
    var idade = anoAtual - anoNascimento; //A idade é calculada subtraindo o ano de nascimento do ano atual.
    
    if (idade < 12) {
      alert("Você deve ter pelo menos 10 anos para continuar.");
      document.getElementById("datanascimento").value = ""; //Limpa o campo
      return false;
    } else {
      return true;
    }
}