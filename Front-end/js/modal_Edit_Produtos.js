// Função para modal de editar e excluir produtos Master
document.querySelectorAll('.editar-btn').forEach(button => {
  button.addEventListener('click', function () {
    const editarId = document.getElementById('editarId');
    const editarNome = document.getElementById('editarNome');
    const editarPreco = document.getElementById('editarPreco');
    const editarDescricao = document.getElementById('editarDescricao');
    const editarCategoria = document.getElementById('editarCategoria');
    const editarSubcategoria = document.getElementById('editarSubcategoria');
    const modalEditar = document.getElementById('modalEditar');
    if (editarId && editarNome && editarPreco && editarDescricao && editarCategoria && editarSubcategoria && modalEditar) {
      editarId.value = this.getAttribute('data-id');
      editarNome.value = this.getAttribute('data-nome');
      editarPreco.value = this.getAttribute('data-preco');
      editarDescricao.value = this.getAttribute('data-descricao');
      editarCategoria.value = this.getAttribute('data-categoria');
      editarSubcategoria.value = this.getAttribute('data-subcategoria');
      modalEditar.style.display = 'block';
    }
  });
});

// Função para abrir o modal de exclusão com o id do produto
document.querySelectorAll('.excluir-btn').forEach(button => {
  button.addEventListener('click', function () {
    const excluirId = document.getElementById('excluirId');
    const modalExcluir = document.getElementById('modalExcluir');
    if (excluirId && modalExcluir) {
      excluirId.value = this.getAttribute('data-id');
      modalExcluir.style.display = 'block';
    }
  });
});

// Fechar o modal de edição quando o usuário clicar no "X"
const closeEditarBtn = document.querySelector('.close-editar');
if (closeEditarBtn) {
  closeEditarBtn.addEventListener('click', function () {
    const modalEditar = document.getElementById('modalEditar');
    if (modalEditar) {
      modalEditar.style.display = 'none';
    }
  });
}

// Fechar o modal de exclusão quando o usuário clicar no "X"
const closeExcluirBtn = document.querySelector('.close-excluir');
if (closeExcluirBtn) {
  closeExcluirBtn.addEventListener('click', function () {
    const modalExcluir = document.getElementById('modalExcluir');
    if (modalExcluir) {
      modalExcluir.style.display = 'none';
    }
  });
}

// Fechar o modal de exclusão quando o usuário clicar no botão "Cancelar"
const cancelBtn = document.querySelector('.cancel-btn');
if (cancelBtn) {
  cancelBtn.addEventListener('click', function () {
    const modalExcluir = document.getElementById('modalExcluir');
    if (modalExcluir) {
      modalExcluir.style.display = 'none';
    }
  });
}


// Fechar os modais quando o usuário clicar fora do modal
window.addEventListener('click', function (event) {
  const modalEditar = document.querySelector('.modal-editar');
  const modalExcluir = document.querySelector('.modal-excluir');
  if (event.target === modalEditar) {
    modalEditar.style.display = 'none';
  }
  if (event.target === modalExcluir) {
    modalExcluir.style.display = 'none';
  }
});

function atualizarContadorCarrinho() {
  const cartCounter = document.getElementById('cart-counter');
  if (cartCounter) {
    cartCounter.textContent = itensCarrinho.length;
  }
}