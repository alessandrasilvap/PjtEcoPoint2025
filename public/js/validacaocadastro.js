document.addEventListener("DOMContentLoaded", function() {
    //Agora o script só será executado após o carregamento do DOM
    const formCadastro = document.getElementById("formCadastro");

    if (formCadastro) {
        formCadastro.addEventListener("submit", validarcadastro);
    }
});

function validarcadastro(event) {
    event.preventDefault(); //Impede o envio do formulário caso o formulário esteja errado

    var nomecompleto = document.getElementById('nomecompleto').value;
    var datanascimento = document.getElementById('datanascimento').value;
    var usuario = document.getElementById('campousuario').value;
    var senha = document.getElementById('camposenha').value;
    var confirmasenha = document.getElementById('confirmasenha').value; //Agora está definida corretamente
    var cep = document.getElementById('cep').value;
    var num = document.getElementById('num').value;
    var tel = document.getElementById('tel').value;
    var cpf = document.getElementById('cpf').value;
    var Inseriremail = document.getElementById('inserirEmail').value;

    //Verifica se todos os campos obrigatórios foram preenchidos
    if (nomecompleto === '' || datanascimento === '' || senha === '' || usuario === '' || cep === '' || num === '' || tel === '' || cpf === '' || Inseriremail === '') {
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



//Validando o CPF com o digito verificador
function validarCPF(cpf) {
    /*O código implementa o algorito de validação de CPF definido pela Receita Federal
    O calculo do primeiro dígito verificar(dv1):
    -Multiplica os primeiros 9 dígitos do CPF por pesos decrescente de 10 a 2;
    -Calcula o resto da divisão da soma pelo número 11;
    -Se o resto for 10 ou 11, o dv1 é 0; caso contrário, é o próprio resto.
    O calculo do segundo dígito verificador(dv2):
    -Multiplica os primeiros 9 dígitos do CPF por pesos decrescente de 11 a 2, incluindo o dv1;
    -Calcula o resto da divisão da soma pelo número 11;
    -Se o resto for 10 ou 11, o dv2 é 0; caso contrário, é o próprio resto.
    O código verifica se os 2 dígitos verificadores calculados correspondem aos 2 últimos dígitos do CPF informado, Se correspondem, o CPF é considerado válido.*/

    soma = 0;
    soma += cpf[0] * 10;
    soma += cpf[1] * 9;
    soma += cpf[2] * 8;
    soma += cpf[3] * 7;
    soma += cpf[4] * 6;
    soma += cpf[5] * 5;
    soma += cpf[6] * 4;
    soma += cpf[7] * 3;
    soma += cpf[8] * 2;
    soma = (soma * 10) % 11;
    if (soma == 10 || soma == 11) soma = 0;
    if (soma != cpf[9]) {
      alert('[ERRO] CPF inválido!');
      return false;
    }

    soma = 0;
    soma += cpf[0] * 11;
    soma += cpf[1] * 10;
    soma += cpf[2] * 9;
    soma += cpf[3] * 8;
    soma += cpf[4] * 7;
    soma += cpf[5] * 6;
    soma += cpf[6] * 5;
    soma += cpf[7] * 4;
    soma += cpf[8] * 3;
    soma += cpf[9] * 2;
    soma = (soma * 10) % 11;
    if (soma == 10 || soma == 11) soma = 0;
    if (soma != cpf[10]) {
      alert('[ERRO] CPF inválido!');
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
