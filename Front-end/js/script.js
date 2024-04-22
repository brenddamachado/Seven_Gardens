

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
/*
// INÍCIO do Carrinho de compras
document.addEventListener("DOMContentLoaded", function() {
  const modal = document.getElementById("modalCarrinho");
  const btnAbrirModal = document.getElementById("carrinho-count");
  const spanFechar = document.getElementsByClassName("close")[0];

  btnAbrirModal.onclick = function() {
    modal.style.display = "block";
  }

  spanFechar.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  // Adiciona evento de clique aos botões "Comprar"
  const botoesComprar = document.querySelectorAll(".buy-btn");
  botoesComprar.forEach(function(botao) {
    botao.addEventListener("click", function() {
      const produto = botao.parentNode.querySelector(".name").innerText;
      const preco = parseFloat(botao.parentNode.querySelector(".price").innerText.replace('R$ ', ''));
      const imagem = botao.dataset.img; // Captura o caminho da imagem do atributo data-img
      adicionarProdutoAoCarrinho(produto, preco, imagem);
    });
  });

  // Função para adicionar produto ao carrinho
  function adicionarProdutoAoCarrinho(produto, preco, imagem) {
    const carrinho = document.getElementById("itensCarrinho");
    const novoItem = document.createElement('div');
    novoItem.classList.add('item-carrinho');
    novoItem.innerHTML = `
      <div class="item-info">
        <div class="product-image">
          <img src="${imagem}" alt="${produto}" width="50" height="50">
        </div>
        <p>${produto} - R$ ${preco.toFixed(2)}</p>
        <button class="remover-item btn-remover">Remover</button>
      </div>`;
    carrinho.appendChild(novoItem);
    atualizarTotalCarrinho();
    atualizarContadorCarrinho();
  }

  // Adiciona evento de clique aos botões "Remover"
  document.addEventListener("click", function(event) {
    if (event.target && event.target.classList.contains("remover-item")) {
      event.target.parentNode.remove();
      atualizarTotalCarrinho();
      atualizarContadorCarrinho();
    }
  });

  // Função para atualizar o total do carrinho
  function atualizarTotalCarrinho() {
    const itensCarrinho = document.querySelectorAll(".item-carrinho");
    let total = 0;

    if (itensCarrinho.length > 0) {
      itensCarrinho.forEach(function(item) {
        const precoElement = item.querySelector("p");
        if (precoElement) {
          const precoTexto = precoElement.innerText.split(" - ")[1].replace('R$ ', '');
          const preco = parseFloat(precoTexto);
          total += preco;
        }
      });
    }

    const totalCarrinhoElement = document.getElementById("total-carrinho");
    totalCarrinhoElement.innerHTML = '<br /><br /><strong>TOTAL R$ ' + total.toFixed(2) + '</strong>';
  }

  // Função para atualizar o contador do carrinho
  function atualizarContadorCarrinho() {
    const carrinho = document.getElementById("itensCarrinho");
    const contadorCarrinho = document.getElementById("carrinho-count");
    const numeroItens = carrinho.children.length;
    contadorCarrinho.innerText = numeroItens;
  }
});
// Adiciona evento de clique ao botão de finalizar compra
const finalizarCompraBtn = document.getElementById("finalizar-compra-btn");
finalizarCompraBtn.addEventListener("click", function() {
  if (usuarioLogado()) {
    // Redireciona para a página de finalização de compra
    window.location.href = "pagina-finalizacao-compra.html";
  } else {
    // Redireciona para a página de login
    window.location.href = "pagina-login.html";
  }
});

// Função para verificar se o usuário está logado (simulada)
function usuarioLogado() {
  // Aqui pode implementar a lógica real para verificar se o usuário está logado
  // Retorne true se estiver logado, false caso contrário
  return true; // Exemplo: usuário sempre está logado
}
// Fim do Carrinho de compras

});*/

// DARK MODE
document.addEventListener("DOMContentLoaded", function () {
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
    });

  // Alternar para o modo escuro
  document
    .getElementById("dark-mode-toggle")
    .addEventListener("click", function () {
      document.body.classList.add("dark-mode");
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

hamburger.addEventListener('click', function() {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener('click', function() {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});





