let itensCarrinho = [];
let totalCarrinho = 0;

function adicionarAoCarrinho(id, nome, preco, imagem) {
  const itemExistente = itensCarrinho.find(item => item.id === id);
  if (itemExistente) {
    itemExistente.quantidade += 1;
  } else {
    itensCarrinho.push({ id, nome, preco, imagem, quantidade: 1 });
  }
  totalCarrinho += preco;
  document.getElementById('cart-counter').textContent = itensCarrinho.length;
}

function removerProduto(index) {
  const item = itensCarrinho[index];
  totalCarrinho -= item.preco * item.quantidade;
  itensCarrinho.splice(index, 1);
  document.getElementById('cart-counter').textContent = itensCarrinho.length;
  exibirItensCarrinho();
}

function exibirItensCarrinho() {
  const modalContent = document.getElementById('itensCarrinho');
  modalContent.innerHTML = '';
  itensCarrinho.forEach((item, index) => {
    const itemHTML = `
      <div class="item-carrinho">
        <img class="imagem-produto" src="${item.imagem}" alt="${item.nome}">
        <div class="descricao-produto">
          <p class="nome-produto">${item.nome}</p>
          <p class="preco-produto">Preço: R$ ${item.preco}</p>
          <p class="quantidade-produto">Quantidade: ${item.quantidade}</p>
        </div>
        <button class="excluir-produto-btn" onclick="removerProduto(${index})">Remover</button>
      </div>`;
    modalContent.insertAdjacentHTML('beforeend', itemHTML);
  });
  document.getElementById('total-carrinho').textContent = `Total: R$ ${totalCarrinho.toFixed(2)}`;
}

function exibirModalCarrinho() {
  exibirItensCarrinho();
  document.getElementById('modalCarrinho').style.display = 'block';
}

document.getElementsByClassName('close')[0].onclick = function () {
  document.getElementById('modalCarrinho').style.display = 'none';
}

window.onclick = function (event) {
  const modal = document.getElementById('modalCarrinho');
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}


// Função para modal de editar e excluir produtos Master

document.querySelectorAll('.editar-btn').forEach(button => {
  button.addEventListener('click', function () {
    document.getElementById('editarId').value = this.getAttribute('data-id');
    document.getElementById('editarNome').value = this.getAttribute('data-nome');
    document.getElementById('editarPreco').value = this.getAttribute('data-preco');
    document.getElementById('editarDescricao').value = this.getAttribute('data-descricao');
    document.getElementById('editarCategoria').value = this.getAttribute('data-categoria');
    document.getElementById('editarSubcategoria').value = this.getAttribute('data-subcategoria');
    document.getElementById('modalEditar').style.display = 'block';
  });
});

// Função para abrir o modal de exclusão com o id do produto
document.querySelectorAll('.excluir-btn').forEach(button => {
  button.addEventListener('click', function () {
    document.getElementById('excluirId').value = this.getAttribute('data-id');
    document.getElementById('modalExcluir').style.display = 'block';
  });
});

// Fechar o modal de edição quando o usuário clicar no "X"
document.querySelector('.close-editar').addEventListener('click', function () {
  document.getElementById('modalEditar').style.display = 'none';
});

// Fechar o modal de exclusão quando o usuário clicar no "X"
document.querySelector('.close-excluir').addEventListener('click', function () {
  document.getElementById('modalExcluir').style.display = 'none';
});

// Fechar o modal de exclusão quando o usuário clicar no botão "Cancelar"
document.querySelector('.cancel-btn').addEventListener('click', function () {
  document.getElementById('modalExcluir').style.display = 'none';
});

// Fechar os modais quando o usuário clicar fora do modal
window.addEventListener('click', function (event) {
  if (event.target.classList.contains('modal-editar')) {
    event.target.style.display = 'none';
  }
  if (event.target.classList.contains('modal-excluir')) {
    event.target.style.display = 'none';
  }
});

function atualizarContadorCarrinho() {
  document.getElementById('cart-counter').textContent = contadorCarrinho;
}
