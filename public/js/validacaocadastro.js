/*Essa função faz com que cada usuário tenha um id único ao se cadastrar, não vou saber
explicar com detalhes*/
// function generate_uuidv4() {
//     return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g,
//     function(c) {
//        var uuid = Math.random() * 16 | 0, v = c == 'x' ? uuid : (uuid & 0x3 | 0x8);
//        return uuid.toString(16);
//     });
// }

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
        alert('[ERRO] CPF inválido!');
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
        alert('[ERRO] CPF inválido!');
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
        alert('[ERRO] CPF inválido!');
        return false;
    }

    return true;
}

function formatarCEP(input) {
    let valor = input.value.replace(/\D/g, ''); // remove tudo que não for dígito

    if (valor.length > 8) {
        valor = valor.substring(0, 8); // limita a 8 dígitos
    }

    if (valor.length > 5) {
        valor = valor.replace(/^(\d{5})(\d{1,3})/, '$1-$2'); // formata com o traço
    }

    input.value = valor;
}


document.getElementById('buscar').addEventListener('click', function() {
    const cep = document.getElementById('cep').value;

    // Limpa os campos antes da busca
    document.getElementById('rua').value = '';
    document.getElementById('bairro').value = '';
    document.getElementById('cidade').value = '';
    document.getElementById('estado').value = '';

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(response => response.json())
    .then(data => {
        if (data.erro) {
            alert('CEP não encontrado.');
            return;
        }
        document.getElementById('rua').value = data.logradouro;
        document.getElementById('bairro').value = data.bairro;
        document.getElementById('cidade').value = data.localidade;
        document.getElementById('estado').value = data.uf;
    })
    .catch(error => {
        alert('Erro ao buscar o CEP.');
        console.error('Erro:', error);
    });
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
        tel = `(${tel.slice(0, 2)}) ${tel.slice(2, 6)}-${tele.slice(6)}`;
    }
    input.value = tel;
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
      document.getElementById("dataNascimento").value = ""; // Limpa o campo
      return false;
    } else {
      return true;
    }
}

//Validando todos os campos para serem preenchidos
function validarcadastro(event) {
    
    var nomecompleto = document.getElementById('nomecompleto').value;
    var datanascimento = document.getElementById('datanascimento').value;
    var genero = document.getElementById('genero').value;
    var usuario = document.getElementById('campousuario').value;
    var senha = document.getElementById('camposenha').value;
    var confirmasenha = document.getElementById('confirmasenha').value;
    var cep = document.getElementById('cep').value;
    var num = document.getElementById('num').value;
    var tel = document.getElementById('tel').value;
    var cpf = document.getElementById('cpf').value;
    var Inseriremail = document.getElementById('inserirEmail').value;


    //Impedindo que o formulário seja enviado com campos em branco
    if (nomecompleto === '' || datanascimento === '' || genero === '' || senha === '' || confirmasenha === '' || usuario === '' || cep === '' || num === '' || tel === '' || cpf === '' || Inseriremail === ''){
        alert('[ERRO] Os campos são obrigatórios, por favor não deixe de preencher.')
        event.preventDefault()
        return false;
    }

    //Validando se as duas senhas estão iguais
    if (senha !== confirmasenha){
        alert('[ERRO] As senhas não coincidem.')
        event.preventDefault()
        return false;
    }

    //Não deixa passar a validação do CPF
    if (!validarCPF(cpf)) {
        alert('[ERRO] CPF inválido.')
        event.preventDefault()
        return false;
    }

    if (!validarEmail(Inseriremail)) {
        alert('[ERRO] E-mail inválido.');
        event.preventDefault()
        return false;
    }
    
    alert("Dados cadastrados com sucesso!");
    return true;
    
}








