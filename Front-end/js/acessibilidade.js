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
        "header, body, .social-icons p, .social-icons i, .dropdown .dropdown-content a, .menu_btn a, .prod_dropdown, li a, button, input, .pesquisa-container input, .dentro_icon a";
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
  
  