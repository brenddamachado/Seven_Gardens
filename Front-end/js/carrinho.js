var contadorCarrinho = 0;
var totalCarrinho = 0;
var itensCarrinho = [];

function adicionarAoCarrinho(idProduto, nomeProduto, precoProduto, imagemProduto) {
  itensCarrinho.push({ id: idProduto, nome: nomeProduto, preco: precoProduto, imagem: imagemProduto });

  contadorCarrinho++;
  totalCarrinho += parseFloat(precoProduto);
  document.getElementById('cart-counter').textContent = contadorCarrinho;

  exibirItensCarrinho(); // Atualiza o modal quando um item é adicionado
}



function removerProduto(index) {
  totalCarrinho -= itensCarrinho[index].preco;
  itensCarrinho.splice(index, 1);

  contadorCarrinho--;
  document.getElementById('cart-counter').textContent = contadorCarrinho;

  exibirItensCarrinho(); // Atualiza o modal quando um item é removido
}

function exibirItensCarrinho() {
  var modalContent = document.getElementById('itensCarrinho');
  modalContent.innerHTML = ''; // Limpar conteúdo anterior

  // Iterar sobre os itens do carrinho
  itensCarrinho.forEach(function (item, index) {
    var itemHTML = `
      <div class="item-carrinho">
        <img class="imagem-produto" src="${item.imagem}" alt="${item.nome}">
        <div class="descricao-produto">
          <p class="nome-produto">${item.nome}</p>
          <p class="preco-produto">Preço: R$ ${item.preco}</p>
        </div>
        <button class="excluir-produto-btn" onclick="removerProduto(${index})">Remover</button>
      </div>`;
    modalContent.insertAdjacentHTML('beforeend', itemHTML);
  });

  // Exibir o total do carrinho
  document.getElementById('total-carrinho').textContent = `Total: R$ ${totalCarrinho.toFixed(2)}`;
}

function exibirModalCarrinho() {
  exibirItensCarrinho();
  var modal = document.getElementById('modalCarrinho');
  modal.style.display = 'block';
}

// Ajuste para fechar o modal corretamente
document.querySelector('.modal-carrinho .close').onclick = function () {
  var modal = document.getElementById('modalCarrinho');
  modal.style.display = 'none';
}

window.onclick = function (event) {
  var modal = document.getElementById('modalCarrinho');
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
