document.addEventListener("DOMContentLoaded", function() {
  const userSearchForm = document.getElementById("user-search-form");
  const tabelaUsuarios = document.getElementById("tabelaUsuarios");

  // Função para exibir usuários na tabela
  function displayUsers(users) {
    const tbody = tabelaUsuarios.querySelector("tbody");
    tbody.innerHTML = ""; // Limpa a tabela antes de preenchê-la novamente

    users.forEach(user => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${user.name}</td>
        <td><button class="delete-btn" data-id="${user.id}">Excluir</button></td>
      `;
      tbody.appendChild(tr);
    });
  }

  // Evento de envio do formulário de pesquisa de usuário
  userSearchForm.addEventListener("submit", function(event) {
    event.preventDefault();
    const inputPesquisa = document.getElementById("inputPesquisa").value.toLowerCase(); // Convertendo para minúsculas para comparar

    // Simulação de busca de usuários (substituir essa parada pela lógica real de busca no banco de dados)
    const users = [
      { id: 1, name: "João da Silva" },
      { id: 2, name: "Maria Pereira" },
      { id: 3, name: "José da Silva Pereira" },
      { id: 4, name: "Marilia da Silva" }
    ];

    // Filtrando os usuários com base na substring inserida no campo de pesquisa
    const usersFiltrados = users.filter(user => user.name.toLowerCase().includes(inputPesquisa));

    // Exibe os usuários encontrados na tabela
    displayUsers(usersFiltrados);
  });

  // Evento de clique em um botão de exclusão
  document.addEventListener("click", function(event) {
    if (event.target.classList.contains("delete-btn")) {
      const userId = parseInt(event.target.getAttribute("data-id"));
      // Exibir modal de confirmação
      const modal = document.getElementById("modal");
      modal.style.display = "block";
      // Evento de clique no botão de confirmação
      document.getElementById("confirm-btn").addEventListener("click", function() {
        // Simulação de exclusão de usuário (substituir isso pela lógica real de exclusão no banco de dados)
        console.log("Excluindo usuário com ID:", userId);
        modal.style.display = "none";
      });
      // Evento de clique no botão de cancelamento
      document.getElementById("cancel-btn").addEventListener("click", function() {
        modal.style.display = "none";
      });
    }
  });
});


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
