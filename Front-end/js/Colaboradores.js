document.addEventListener("DOMContentLoaded", function () {
  const colaboradorSearchForm = document.getElementById(
    "colaborador-search-form"
  );
  const tabelaColaboradores = document.getElementById("tabelaColaboradores");

  // Função para exibir colaboradores na tabela
  function displayColaboradores(colaboradores) {
    const tbody = tabelaColaboradores.querySelector("tbody");
    tbody.innerHTML = ""; // Limpa a tabela antes de preenchê-la novamente

    colaboradores.forEach((colaborador) => {
      const tr = document.createElement("tr");
      tr.innerHTML = `
          <td>${colaborador.nome_completo}</td>
          <td><button class="delete-btn" data-id="${colaborador.idUsuario}">Excluir</button></td>
        `;
      tbody.appendChild(tr);
    });
  }

  // Evento de envio do formulário de pesquisa de colaborador
  colaboradorSearchForm.addEventListener("submit", function (event) {
    event.preventDefault();
    const inputPesquisa = document
      .getElementById("inputPesquisa")
      .value.toLowerCase(); // Convertendo para minúsculas para comparar

    // Requisição AJAX para buscar colaboradores
    fetch("buscar_colaboradores.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ query: inputPesquisa }),
    })
      .then((response) => response.json())
      .then((data) => {
        displayColaboradores(data);
      })
      .catch((error) => {
        console.error("Erro ao buscar colaboradores:", error);
      });
  });

  // Evento de clique em um botão de exclusão
  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn")) {
      const colaboradorId = parseInt(event.target.getAttribute("data-id"));
      // Exibir modal de confirmação
      const modal = document.getElementById("modal");
      modal.style.display = "block";
      // Evento de clique no botão de confirmação
      document
        .getElementById("confirm-btn")
        .addEventListener("click", function () {
          // Requisição AJAX para excluir colaborador
          fetch("excluir_colaborador.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({ id: colaboradorId }),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                console.log("Colaborador excluído com sucesso!");
                modal.style.display = "none";
                // Remover a linha da tabela
                event.target.closest("tr").remove();
              } else {
                console.error("Erro ao excluir colaborador:", data.message);
              }
            })
            .catch((error) => {
              console.error("Erro ao excluir colaborador:", error);
            });
        });
      // Evento de clique no botão de cancelamento
      document
        .getElementById("cancel-btn")
        .addEventListener("click", function () {
          modal.style.display = "none";
        });
    }
  });
});
