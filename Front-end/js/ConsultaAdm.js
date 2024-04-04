document.addEventListener("DOMContentLoaded", function() {
  var produtos = document.getElementById("produtos");
  var categorias = document.querySelector(".categorias");
  var listaCategorias = document.querySelectorAll(".categoria");

  // Quando o mouse entra nos produtos ou nas categorias, mantenha as categorias visíveis
  produtos.addEventListener("mouseenter", function() {
    categorias.style.display = "block";
  });

  categorias.addEventListener("mouseenter", function() {
    categorias.style.display = "block";
  });

  // Quando o mouse sai dos produtos ou das categorias, esconda as categorias
  produtos.addEventListener("mouseleave", function() {
    categorias.style.display = "none";
  });

  categorias.addEventListener("mouseleave", function() {
    categorias.style.display = "none";
  });

  // Adicione o evento de clique para selecionar uma categoria
  listaCategorias.forEach(function(categoria) {
    categoria.addEventListener("click", function() {
      // Remova a classe 'selecionada' de todas as categorias
      listaCategorias.forEach(function(c) {
        c.classList.remove("selecionada");
      });
      // Adicione a classe 'selecionada' apenas à categoria clicada
      categoria.classList.add("selecionada");
    });
  });
});
