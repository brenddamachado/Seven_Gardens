// Seletores dos elementos
let btn = document.querySelector("#verSenha");
let btn2 = document.querySelector("#verConfirme");
let nome = document.querySelector("#nome");
let senha = document.querySelector("#senha");
let senha2 = document.querySelector("#senhaC");
let tel = document.querySelector("#tel");
let login = document.querySelector("#login");
let cepInput = $("#cep");
const cidadeInput = $("#cid");
const ruaInput = $("#rua");
const bairroInput = $("#bairro");
const emailInput = document.getElementById("email");
const numero = document.getElementById("num");
const celular = document.getElementById("numero");
const telefone = document.getElementById("tel");
const cpf = document.getElementById("cpf");
const mensagemNome = document.getElementById("mensagemNome");
const mensagemCPF = document.getElementById("mensagemCPF");
const mensagemCep = document.getElementById("mensagemCep");
const mensagemEmail = document.getElementById("mensagemEmail");
const mensagemLogin = document.getElementById("mensagemLogin");
const cadastrar = document.getElementById("cadastrar");
const limpar = document.getElementById("limpar");
const comple = document.getElementById("comple");
const genero = document.querySelector(".genero");
const data = document.getElementById("data");

// Variáveis de validação
let validenome = false;
let validesenha = false;
let validesenha2 = false;
let validelogin = false;
let validecpf = false;
let validecep = false;
let valideemail = false;

nome.addEventListener("input", () => {
  // Remove caracteres que não são letras ou espaços
  nome.value = nome.value.replace(/[^a-zA-Z\s]/g, "");

  if (nome.value.length >= 15 && nome.value.length < 60) {
    mensagemNome.innerHTML = "";
    validenome = true;
  } else {
    mensagemNome.innerHTML = "insira no mínimo 15 caracteres";

    validenome = false;
  }
});

senha.addEventListener("input", () => {
  senha.value = senha.value.replace(/[^a-zA-Z]/g, ""); // Remove caracteres não alfabéticos

  if (senha.value.length < 8) {
    mensagem.innerHTML = " *Insira no mínimo 8 caracteres";
    validesenha = false;
  } else {
    mensagem.innerHTML = "";
    validesenha = true;
  }
});

senha2.addEventListener("input", () => {
  senha2.value = senha2.value.replace(/[^a-zA-Z]/g, ""); // Remove caracteres não alfabéticos

  if (senha.value !== senha2.value) {
    mensagem.innerHTML = "Confirmação de Senha: *As senhas não conferem";
    validesenha2 = false;
  } else {
    mensagem.innerHTML = "";
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
  if (
    parseInt(cpf.charAt(9)) !== digit1 ||
    parseInt(cpf.charAt(10)) !== digit2
  ) {
    return false;
  }

  // Se todas as verificações passaram, o CPF é válido, então formatamos
  return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

cpf.addEventListener("input", () => {
  // Remove todos os caracteres não numéricos
  cpf.value = cpf.value.replace(/\D/g, "");

  const isCPFValid = validarCPF(cpf.value);

  if (isCPFValid) {
    mensagemCPF.innerHTML = ""; // Limpa a mensagem se o CPF for válido
    cpf.value = isCPFValid; // Define o valor da entrada como o CPF formatado
    validecpf = true;
  } else {
    mensagemCPF.innerHTML = "CPF inválido";
    validecpf = false;
  }
});

$(document).ready(function () {
  //celular
  $("#numero").mask("(99) 99999-9999");
});

emailInput.addEventListener("input", function () {
  const email = emailInput.value;
  validarEmail(email);
});
function validarEmail(email) {
  // Expressão regular para validar o formato do e-mail
  var regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

  if (regex.test(email)) {
    mensagemEmail.innerHTML = "";
    valideemail = true;
  } else {
    mensagemEmail.innerHTML = "inválido";
    valideemail = false;
  }
}

function preencherEndereco(cep) {
  const url = `https://viacep.com.br/ws/${cep}/json/`;

  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Não foi possível obter os dados do CEP.");
      }
      return response.json();
    })
    .then((data) => {
      if (data.erro) {
        mensagemCep.innerHTML = "CEP não encontrado";
        return;
      }

      cidadeInput.val(data.localidade);
      ruaInput.val(data.logradouro);
      bairroInput.val(data.bairro);

      // Remover estilos CSS das labels
      $("#labelRua, #labelCidade, #labelBairro").removeAttr("style");

      // Limpar mensagem de erro
      mensagemCep.innerHTML = "";
    })
    .catch((error) => {
      console.error("Erro ao obter dados do CEP:", error);
      mensagemCep.innerHTML = "Erro ao obter dados do CEP";
    });
}

// Evento e função para preencher endereço a partir do CEP
cepInput.on("input", function () {
  let cep = cepInput.val().replace(/\D/g, "").slice(0, 8);
  cepInput.val(cep);

  if (cep.length === 8) {
    preencherEndereco(cep);
  } else {
    mensagemCep.innerHTML = "";
    cidadeInput.val("");
    ruaInput.val("");
    bairroInput.val("");
  }
});

btn.addEventListener("click", () => {
  let inputSenha = document.querySelector("#senha");
  if (inputSenha.getAttribute("type") == "password") {
    inputSenha.setAttribute("type", "text");
  } else {
    inputSenha.setAttribute("type", "password");
  }
});

btn2.addEventListener("click", () => {
  let inputSenha = document.querySelector("#senhaC");
  if (inputSenha.getAttribute("type") == "password") {
    inputSenha.setAttribute("type", "text");
  } else {
    inputSenha.setAttribute("type", "password");
  }
});

login.addEventListener("input", function () {
  let inputValue = login.value;

  // Remova espaços em branco do início e do final do valor
  inputValue = inputValue.trim();

  // Remova todos os números do valor
  inputValue = inputValue.replace(/\d/g, "");

  login.value = inputValue; // Define o valor do campo sem os números

  if (inputValue.length === 0) {
    mensagemLogin.innerHTML = "";
    validelogin = false; // Define como inválido, se necessário
  } else if (inputValue.length === 6) {
    mensagemLogin.innerHTML = "";
    validelogin = true;
  } else {
    mensagemLogin.innerHTML = "Digite exatamente 6 letras.";

    validelogin = false;
  }
});

// Evento de clique para cadastrar
limpar.addEventListener("click", (event) => {
  event.preventDefault(); // Evita o recarregamento da página

  // Limpar os campos de input e os radios
  nome.value = "";
  login.value = "";
  emailInput.value = "";
  senha.value = "";
  senha2.value = "";
  cepInput.val("");
  numero.value = "";
  celular.value = "";
  comple.value = "";
  cpf.value = "";
  cidadeInput.val(""); // Limpa o campo de input cidade
  ruaInput.val("");
  bairroInput.val("");
  // Limpar a seleção dos radios de gênero
  document.querySelectorAll(".genero").forEach((radio) => {
    radio.checked = false;
  });

  data.value = "";

  // Limpar mensagens de validação também, se necessário
  mensagemNome.innerHTML = "";
  mensagemCPF.innerHTML = "";
  mensagemCep.innerHTML = "";
  mensagemEmail.innerHTML = "";
  mensagemLogin.innerHTML = "";
  mensagem.innerHTML = "";
});
