function validaCPF(cpf) {
    cpf = cpf.replace(/\D/g, '');  // Remove tudo o que não é dígito
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;

    let soma = 0, resto;
    for (let i = 1; i <= 9; i++) 
        soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    resto = (soma * 10) % 11;

    if ((resto === 10) || (resto === 11)) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    soma = 0;
    for (let i = 1; i <= 10; i++) 
        soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    resto = (soma * 10) % 11;

    if ((resto === 10) || (resto === 11)) resto = 0;
    return resto === parseInt(cpf.substring(10, 11));
}

function handleSubmit(event) {
    event.preventDefault();  // Impede o envio do formulário
    const input = document.getElementById('input_historico');
    const mensagem = document.getElementById('mensagem_historico');
    const secaoEscondida = document.getElementById('conteudo');
    const cpf = input.value;
    
    if (validaCPF(cpf)) {
 
        secaoEscondida.style.display = 'block'; // Exibe a seção oculta
    } else {
        mensagem.textContent = 'CPF inválido.';
        mensagem.style.color = 'red';
        secaoEscondida.style.display = 'none'; // Mantém a seção oculta
    }
}