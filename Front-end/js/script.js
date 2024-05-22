
// Início do Carrossel
let slideIndex = 0; // Índice do slide atual

// Função para avançar para o próximo slide
function nextSlide() {
  showSlides(slideIndex += 1);
}

// Função para retroceder para o slide anterior
function prevSlide() {
  showSlides(slideIndex -= 1);
}

// Função para mostrar o slide atual
function showSlides(n) {
  const slides = document.getElementsByClassName("carousel-item");
  // Se chegarmos ao último slide, voltamos ao primeiro
  if (n >= slides.length) {
    slideIndex = 0;
  }
  // Se estivermos no slide anterior ao primeiro, voltamos ao último
  if (n < 0) {
    slideIndex = slides.length - 1;
  }
  // Ocultar todos os slides
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  // Mostrar o slide atual
  slides[slideIndex].style.display = "block";
}

// Avançar automaticamente para o próximo slide a cada 5 segundos
setInterval(nextSlide, 5000);

// Fim do Carrossel

// DARK MODE 
document.addEventListener("DOMContentLoaded", function () {
  // Verificar se o usuário já selecionou um modo de cor anteriormente
  const savedMode = localStorage.getItem("mode");

  // Se houver um modo salvo, aplicá-lo
  if (savedMode) {
    document.body.classList.add(savedMode);
  }

  // Alternar a visibilidade das opções de acessibilidade
  document
    .getElementById("accessibility-icon")
    .addEventListener("click", function () {
      var otherThings = document.getElementById("other-things");
      otherThings.style.display =
        otherThings.style.display === "none" ? "flex" : "none";
    });

  // Alternar para o modo claro
  document
    .getElementById("light-mode-toggle")
    .addEventListener("click", function () {
      document.body.classList.remove("dark-mode");
      localStorage.setItem("mode", "light-mode"); // Salvar o modo de cor selecionado
    });

  // Alternar para o modo escuro
  document
    .getElementById("dark-mode-toggle")
    .addEventListener("click", function () {
      document.body.classList.add("dark-mode");
      localStorage.setItem("mode", "dark-mode"); // Salvar o modo de cor selecionado
    });

  // Função para ajustar o tamanho da fonte de elementos específicos
  function adjustFontSizeForElements(factor) {
    const selectors =
      "header, body, .social-icons p, .social-icons i, .dropdown .dropdown-content a, .menu_btn a, .prod_dropdown, li a, button, input, .pesquisa-container input";
    document.querySelectorAll(selectors).forEach((element) => {
      // Verifica se o elemento tem um estilo de fonte definido inline; se não, usa o estilo computado
      const fontSizeValue = element.style.fontSize
        ? element.style.fontSize
        : window.getComputedStyle(element, null).getPropertyValue("font-size");
      const currentFontSize = parseFloat(fontSizeValue);
      element.style.fontSize = `${currentFontSize + factor}px`;
    });
  }

  // Evento para aumentar o tamanho da fonte de elementos específicos
  document
    .getElementById("increase-font")
    .addEventListener("click", function () {
      adjustFontSizeForElements(2); // Aumenta o tamanho da fonte em 2px
    });

  // Evento para diminuir o tamanho da fonte de elementos específicos
  document
    .getElementById("decrease-font")
    .addEventListener("click", function () {
      adjustFontSizeForElements(-2); // Diminui o tamanho da fonte em 2px
    });
});

// FINAL DO DARK MODE

//hamburguer menu
let hamburger = document.getElementById('hamburguer');
let mobileMenu = document.getElementById('mobile');
let closeButton = document.querySelector('.close-btn');

hamburger.addEventListener('click', function () {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener('click', function () {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});



//modal addicionar produto no carrinho

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

document.getElementsByClassName('close')[0].onclick = function () {
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