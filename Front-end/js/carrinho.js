console.log("Carrinho.js carregado");

let itensCarrinho = [];
let totalCarrinho = 0;

function salvarCarrinho() {
  localStorage.setItem('itensCarrinho', JSON.stringify(itensCarrinho));
  localStorage.setItem('totalCarrinho', totalCarrinho.toString());
}

function carregarCarrinho() {
  console.log("Carregando carrinho do localStorage");
  const itens = localStorage.getItem('itensCarrinho');
  const total = localStorage.getItem('totalCarrinho');
  if (itens && total) {
    itensCarrinho = JSON.parse(itens);
    totalCarrinho = parseFloat(total);
    const cartCounter = document.getElementById('cart-counter');
    if (cartCounter) {
      cartCounter.textContent = itensCarrinho.length;
    }
    console.log("Carrinho carregado do localStorage:", itensCarrinho, totalCarrinho);
  } else {
    console.log("Nenhum carrinho encontrado no localStorage");
  }
}

document.addEventListener('DOMContentLoaded', carregarCarrinho);

function adicionarAoCarrinho(id, nome, preco, imagem) {
  const baseUrl = window.location.origin + '/Seven_Gardens'; // Obtém a URL base do site com o caminho correto
  const itemExistente = itensCarrinho.find(item => item.id === id);
  if (itemExistente) {
    itemExistente.quantidade += 1;
  } else {
    const imagePath = baseUrl + '/' + imagem; // Constrói o caminho completo da imagem
    itensCarrinho.push({ id, nome, preco, imagem: imagePath, quantidade: 1 });
  }
  totalCarrinho += preco;
  const cartCounter = document.getElementById('cart-counter');
  if (cartCounter) {
    cartCounter.textContent = itensCarrinho.length;
  }
  salvarCarrinho();

  // Animação do botão
  console.log(`Adicionando animação ao botão de ID: ${id}`);
  const botaoComprar = document.querySelector(`button[data-id='${id}']`);
  if (botaoComprar) {
    botaoComprar.classList.add('clicked');
    setTimeout(() => {
      botaoComprar.classList.remove('clicked');
    }, 500); // Duração da animação em milissegundos
  } else {
    console.log(`Botão não encontrado para ID: ${id}`);
  }
}

function incrementarQuantidade(index) {
  itensCarrinho[index].quantidade += 1;
  totalCarrinho += itensCarrinho[index].preco;
  exibirItensCarrinho();
  salvarCarrinho();
}

function decrementarQuantidade(index) {
  if (itensCarrinho[index].quantidade > 1) {
    itensCarrinho[index].quantidade -= 1;
    totalCarrinho -= itensCarrinho[index].preco;
  } else {
    removerProduto(index);
  }
  exibirItensCarrinho();
  salvarCarrinho();
}

function removerProduto(index) {
  const item = itensCarrinho[index];
  totalCarrinho -= item.preco * item.quantidade;
  itensCarrinho.splice(index, 1);
  const cartCounter = document.getElementById('cart-counter');
  if (cartCounter) {
    cartCounter.textContent = itensCarrinho.length;
  }
  exibirItensCarrinho();
  salvarCarrinho();
}

function exibirItensCarrinho() {
  const modalContent = document.getElementById('itensCarrinho');
  if (modalContent) {
    modalContent.innerHTML = '';
    itensCarrinho.forEach((item, index) => {
      const itemHTML = `
        <div class="item-carrinho">
          <img class="imagem-produto" src="${item.imagem}" alt="${item.nome}">
          <div class="descricao-produto">
            <p class="nome-produto">${item.nome}</p>
            <p class="preco-produto">Preço: R$ ${item.preco}</p>
            <p class="quantidade-produto">Quantidade: 
              <button class="quantidade-btn" onclick="decrementarQuantidade(${index})">-</button>
              ${item.quantidade}
              <button class="quantidade-btn" onclick="incrementarQuantidade(${index})">+</button>
            </p>
          </div>
          <button class="excluir-produto-btn" onclick="removerProduto(${index})">Remover</button>
        </div>`;
      modalContent.insertAdjacentHTML('beforeend', itemHTML);
    });
  }
  const totalCarrinhoElem = document.getElementById('total-carrinho');
  if (totalCarrinhoElem) {
    totalCarrinhoElem.textContent = `Total: R$ ${totalCarrinho.toFixed(2)}`;
  }
}

function exibirModalCarrinho() {
  exibirItensCarrinho();
  const modalCarrinho = document.getElementById('modalCarrinho');
  if (modalCarrinho) {
    modalCarrinho.style.display = 'block';
  }
}

const closeModalBtn = document.getElementsByClassName('close')[0];
if (closeModalBtn) {
  closeModalBtn.onclick = function () {
    const modalCarrinho = document.getElementById('modalCarrinho');
    if (modalCarrinho) {
      modalCarrinho.style.display = 'none';
    }
  }
}

window.onclick = function (event) {
  const modal = document.getElementById('modalCarrinho');
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}
