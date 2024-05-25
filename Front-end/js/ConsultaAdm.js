document.addEventListener("DOMContentLoaded", function() {
  const userSearchForm = document.getElementById("user-search-form");
  const tabelaUsuarios = document.getElementById("tabelaUsuarios");

  if (userSearchForm && tabelaUsuarios) {
    // Função para exibir usuários na tabela
    function displayUsers(users) {
      const tbody = tabelaUsuarios.querySelector("tbody");
      tbody.innerHTML = ""; // Limpa a tabela antes de preenchê-la novamente

      users.forEach(user => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${user.nome_completo}</td>
          <td><button class="delete-btn" data-id="${user.id}">Excluir</button></td>
        `;
        tbody.appendChild(tr);
      });
    }

    // Função para lidar com a exclusão de usuários
    function deleteUser(userId) {
      // Envia a requisição AJAX para o servidor
      fetch('../../Back-end/processo_consulta_adm.php', {
        method: 'POST',
        body: new FormData(),
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro na resposta do servidor');
        }
        return response.json();
      })
      .then(data => {
        if (data && data.success) {
          alert(data.message);
          // Recarrega a lista de usuários após a exclusão bem-sucedida
          // Você pode chamar novamente a função de pesquisa aqui, se necessário
        } else {
          console.error('Erro na exclusão:', data && data.message ? data.message : 'Resposta inválida do servidor');
        }
      })
      .catch(error => {
        console.error('Erro na requisição:', error);
      });
    }

    // Evento de envio do formulário de pesquisa de usuário
    userSearchForm.addEventListener("submit", function(event) {
      event.preventDefault();
      const formData = new FormData(userSearchForm);

      // Envia a requisição AJAX para o servidor
      fetch('../../Back-end/processo_consulta_adm.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro na resposta do servidor');
        }
        return response.json();
      })
      .then(data => {
        if (data && data.success) {
          displayUsers(data.users);
        } else {
          console.error('Erro na busca:', data && data.message ? data.message : 'Resposta inválida do servidor');
        }
      })
      .catch(error => {
        console.error('Erro na requisição:', error);
      });
    });

    // Evento de clique nos botões de exclusão de usuário
    tabelaUsuarios.addEventListener("click", function(event) {
      if (event.target.classList.contains("delete-btn")) {
        const userId = event.target.dataset.id;
        if (confirm("Deseja realmente excluir este usuário?")) {
          deleteUser(userId);
        }
      }
    });

  } else {
    console.error('Elementos não encontrados. Verifique se os IDs estão corretos.');
  }
});

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

    
//ACESSIBILIDADE DE AUMENTAR A FONTE
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
