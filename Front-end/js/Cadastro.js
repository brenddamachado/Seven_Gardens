
let btn = document.querySelector('#verSenha');
let btn2 = document.querySelector('#verConfirme');

let labelNome = document.querySelector('#labelNome');
let nome = document.querySelector('#nome');
let validenome = false;

let labelSenha = document.querySelector('#labelSenha');
let senha = document.querySelector('#senha');
let validesenha = false;

let labelConfirmacao = document.querySelector('#labelConfirmacao');
let senha2 = document.querySelector('#senhaC');
let validesenha2 = false;


let labelTel = document.querySelector('#labelTel');
let tel = document.querySelector('#tel');

let login = document.querySelector('#login');
let labelLogin = document.querySelector('#labelLogin');
let validelogin = false;

let labelCpf = document.querySelector('#labelCpf');
let validecpf = false;

const cepInput = $("#cep");
const labelCep = $("#labelCep");
let validecep = false;

const labelCidade = $("#labelCidade");
const cidadeInput = $("#cid");

const ruaInput = $("#rua");
const labelRua = $("#labelRua");

const bairroInput = $("#bairro");
const labelBairro = $("#labelBairro");

const emailInput = document.getElementById('email');
const labelEmail = document.getElementById('labelEmail');
let valideemail = false;

const n = document.getElementById('n');
const celular = document.getElementById('numero');
const telefone = document.getElementById('tel');
const cpf = document.getElementById('cpf');

const mensagemNome = document.getElementById('mensagem')
const mensagemCPF = document.getElementById('mensagemCPF');
const mensagemCep = document.getElementById('mensagemCep');


nome.addEventListener('input', () => {
  // Remove caracteres que não são letras ou espaços
  nome.value = nome.value.replace(/[^a-zA-Z\s]/g, '');

  if (nome.value.length >= 15 && nome.value.length < 60) {
   mensagem.innerHTML= ""
    validenome = true;
  } else {
    mensagem.innerHTML= "insira no mínimo 15 caracteres"

    validenome = false;
  }
});


senha.addEventListener('input', () => {
  senha.value = senha.value.replace(/[^a-zA-Z]/g, ''); // Remove caracteres não alfabéticos

  if (senha.value.length < 8) {
    mensagem.innerHTML= ' *Insira no mínimo 8 caracteres';
    validesenha = false;
  } else {
    mensagem.innerHTML= ""
    validesenha = true;
  }
});

senha2.addEventListener('input', () => {
  senha2.value = senha2.value.replace(/[^a-zA-Z]/g, ''); // Remove caracteres não alfabéticos

  if (senha.value !== senha2.value) {
  
    mensagem.innerHTML=  'Confirmação de Senha: *As senhas não conferem';
    validesenha2 = false;
  } else {
    mensagem.innerHTML= ""
    validesenha2 = true;
  }
});




function validarCPF(cpf) {
  // Verificar se o CPF tem 11 dígitos
  if (cpf.length !== 11) {
    return false;
  }

  // Verificar se todos os dígitos são iguais (CPF inválido)
  if (/^(\d)\1{10}$/.test(cpf)) {
    return false;
  }

  // Calcula o primeiro dígito verificador
  let sum = 0;
  for (let i = 0; i < 9; i++) {
    sum += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let mod = sum % 11;
  let digit1 = mod < 2 ? 0 : 11 - mod;

  // Calcula o segundo dígito verificador
  sum = 0;
  for (let i = 0; i < 10; i++) {
    sum += parseInt(cpf.charAt(i)) * (11 - i);
  }
  mod = sum % 11;
  let digit2 = mod < 2 ? 0 : 11 - mod;

  // Verifica se os dígitos verificadores são válidos
  if (parseInt(cpf.charAt(9)) !== digit1 || parseInt(cpf.charAt(10)) !== digit2) {
    return false;
  }

  // Se todas as verificações passaram, o CPF é válido, então formatamos
  return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

cpf.addEventListener('input', () => {
  // Remove todos os caracteres não numéricos
  cpf.value = cpf.value.replace(/\D/g, '');

  const isCPFValid = validarCPF(cpf.value);

  if (isCPFValid) {
    mensagemCPF.innerHTML = ""; // Limpa a mensagem se o CPF for válido
    cpf.value = isCPFValid; // Define o valor da entrada como o CPF formatado
    validecpf = true;
  } else {
    mensagemCPF.innerHTML = 'CPF inválido';
    validecpf = false;
  }
});


$(document).ready(function() {

  //celular
  $("#numero").mask("(99) 99999-9999");
});




emailInput.addEventListener('input', function() {
  const email = emailInput.value;
  validarEmail(email);
});
function validarEmail(email) {
  // Expressão regular para validar o formato do e-mail
  var regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

  if (regex.test(email)) {
    mensagem.innerHTML=""
    valideemail = true;

  } else {
    mensagem.innerHTML='inválido';
    valideemail = false;

  }
}

cepInput.on("input", function () {
  let cep = cepInput.val().replace(/\D/g, "").slice(0, 8);
  cepInput.val(cep);

  cidadeInput.val("");
  ruaInput.val("");
  bairroInput.val("");

  labelRua.css("color", ""); // Remover a cor da rua
  labelCidade.css("color", ""); // Remover a cor da cidade
  labelBairro.css("color", ""); // Remover a cor do bairro

  if (cep.length === 0) {
    labelCep.css("color", ""); // Remover a cor
    labelCep.html("Cep:");
  } else {
    validarCep(cep);
  }
});

function validarCep(cep) {
  var regex = /^[0-9]{8}$/;

  if (regex.test(cep)) {
   
   mensagemCep.innerHTML('Cep:');
    validecep = true;
  } else {
   
 mensagemCep.innerHTML('Cep: *inválido');
    validecep = false;
  }

  const url = `https://viacep.com.br/ws/${cep}/json/`;

  if (cep.length === 8) {
    fetch(url)
      .then((response) => {
        if (!response.ok) {
          labelCep.css("color", "maroon");
          throw new Error('Não foi possível obter os dados do CEP.');
        }
        return response.json();
      })
      .then((data) => {
        if (data.erro) {
          labelCep.css("color", "maroon");
          labelCep.html('CEP não encontrado');
          validecep = false;
        } else {
          labelCep.css("color", "black");
          labelRua.css("color", "black");
          labelCidade.css("color", "black");
          labelBairro.css("color", "black");
          validecep = true;
        }

        cidadeInput.val(data.localidade);
        ruaInput.val(data.logradouro);
        bairroInput.val(data.bairro);
      })
      .catch((error) => {
        console.error(error);
        validecep = false;
      });
  }
}




function cadastrar() {
  // Validações dos campos

  if (validenome && validesenha && validesenha2 && validecep && validecpf && valideemail && validemae && validelogin) {
    let listaUser = JSON.parse(localStorage.getItem('listaUser') || '[]');

    listaUser.push({
      nome: nome.value,
      login: login.value,
      email: emailInput.value,
      senha: senha.value
    });

    localStorage.setItem('listaUser', JSON.stringify(listaUser));

    // Limpar os campos
    nome.value = '';
    login.value = '';
    emailInput.value = '';
    senha.value = '';
    senha2.value = '';  
    cepInput.val('');  // Limpar o campo do CEP usando jQuery
    n.value = '';
    celular.value = '';
    telefone.value = '';
    cpf.value = '';
    mae.value = '';
    nasc.value = '';
   
    

    // Abrir a página após o cadastro
    setTimeout(() => {
      window.open("https://projetotelecall.rianefm.repl.co/html/Login.html", "_blank");
    }, 3000)

    document.getElementById('mensagem').innerHTML = 'Cadastro realizado com sucesso!';

    return false; // Impede o envio do formulário, já que a página será redirecionada
  } else {
    document.getElementById('mensagem').innerHTML = 'Preencha o formulário corretamente.';
    return false; // Impede o envio do formulário em caso de erro
  }
}


btn.addEventListener('click', () => {
  let inputSenha = document.querySelector('#senha')
  if (inputSenha.getAttribute('type') == 'password') {
    inputSenha.setAttribute('type', 'text')
  } else {
    inputSenha.setAttribute('type', 'password')
  }
})

btn2.addEventListener('click', () => {
  let inputSenha = document.querySelector('#senha2')
  if (inputSenha.getAttribute('type') == 'password') {
    inputSenha.setAttribute('type', 'text')
  } else {
    inputSenha.setAttribute('type', 'password')
  }
});




login.addEventListener('input', function () {
  let inputValue = login.value;

  // Remova espaços em branco do início e do final do valor
  inputValue = inputValue.trim();

  // Remova todos os números do valor
  inputValue = inputValue.replace(/\d/g, '');

  login.value = inputValue; // Define o valor do campo sem os números

  if (inputValue.length === 0) {
    mensagem.innerHTML=""
    validelogin = false; // Define como inválido, se necessário
  } else if (inputValue.length === 6) {
    mensagem.innerHTML=""
    validelogin = true;
  } else {
    mensagem.innerHTML="Digite exatamente 6 letras."

    validelogin = false;
  }
});
