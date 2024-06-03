document.addEventListener('DOMContentLoaded', function() {
  console.log("DOM totalmente carregado e analisado");

  var openButton = document.getElementById('openFilterForm');
  var filterFormContainer = document.getElementById('filterFormContainer');
  var filterForm = document.getElementById('filterForm');
  var tabelaBody = document.getElementById('tabelaBody');

  if (openButton) {
    openButton.addEventListener('click', function() {
      console.log("Clicou no filtro");
      if (filterFormContainer.style.display === "none" || filterFormContainer.style.display === "") {
        filterFormContainer.style.display = "block";
      } else {
        filterFormContainer.style.display = "none";
      }
    });
  } else {
    console.log("openFilterForm não encontrado");
  }

  if (filterForm) {
    filterForm.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = new FormData(filterForm);
      var inputPesquisa = formData.get('inputPesquisa');

      // Verifica se o valor de pesquisa é numérico
      if (!isNaN(inputPesquisa) && inputPesquisa !== '') {
        formData.set('idUsuario', inputPesquisa);
      }

      fetch('', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
          tabelaBody.innerHTML = ''; // Limpa a tabela
          if (data.error) {
            tabelaBody.innerHTML = '<tr><td colspan="4">' + data.error + '</td></tr>';
          } else if (data.length > 0) {
            data.forEach(item => {
              var row = document.createElement('tr');
              row.innerHTML = `
                <td>${item.id_usuario}</td>
                <td>${item.nome_completo}</td>
                <td>${new Date(item.horarioLogin).toLocaleString('pt-BR')}</td>
                <td>${item.pergunta}</td>
              `;
              tabelaBody.appendChild(row);
            });
          } else {
            tabelaBody.innerHTML = '<tr><td colspan="4">Nenhum registro encontrado.</td></tr>';
          }
        })
        .catch(error => {
          console.error('Erro:', error);
          tabelaBody.innerHTML = '<tr><td colspan="4">Erro ao buscar dados.</td></tr>';
        });
    });
  }
});

document.addEventListener("DOMContentLoaded", function() {
  const userSearchForm = document.getElementById("user-search-form");
  const tabelaUsuarios = document.getElementById("tabelaUsuarios");
  const modal = document.getElementById("modal");
  const modalMessage = document.getElementById("modal-message");
  const confirmBtn = document.getElementById("confirm-btn");
  const cancelBtn = document.getElementById("cancel-btn");
  let userIdToDelete = null;

  if (userSearchForm && tabelaUsuarios) {
    // Função para exibir usuários na tabela
    function displayUsers(users) {
      const tbody = tabelaUsuarios.querySelector("tbody");
      tbody.innerHTML = ""; // Limpa a tabela antes de preenchê-la novamente
  
      if (users.length > 0) {
        users.forEach(user => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${user.idUsuario}</td>
            <td>${user.nome_completo}</td>
            <td>${user.tipo_usuario}</td>
            <td><button class="delete-btn" data-id="${user.idUsuario}" data-modal="true">Excluir</button></td>
          `;
          tbody.appendChild(tr);
        });
      } else {
        // Se nenhum usuário for encontrado, exibe a mensagem na tabela
        const tr = document.createElement("tr");
        tr.innerHTML = '<td colspan="4" style="color: #212529;">Nenhum resultado encontrado</td>';
        tbody.appendChild(tr);
      }
    }

    // Função para lidar com a exclusão de usuários
    function deleteUser(userId) {
      // Envia a requisição AJAX para o servidor
      fetch('../../Back-end/processo_consulta_adm.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `delete_id=${encodeURIComponent(userId)}`
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro na resposta do servidor');
        }
        return response.json();
      })
      .then(data => {
        if (data && data.success) {
          modalMessage.textContent = data.message;
          confirmBtn.style.display = "none";
          cancelBtn.style.display = "none";
          setTimeout(() => {
            modal.style.display = "none";
            userSearchForm.dispatchEvent(new Event('submit')); // Reenvia o formulário para atualizar a lista
          }, 2000); // Fecha o modal após 2 segundos
        } else {
          console.error('Erro na exclusão:', data && data.message ? data.message : 'Resposta inválida do servidor');
          modalMessage.textContent = data.message || 'Erro desconhecido ao excluir usuário';
          confirmBtn.style.display = "none";
          cancelBtn.style.display = "none";
        }
      })
      .catch(error => {
        console.error('Erro na requisição:', error);
        modalMessage.textContent = 'Erro na requisição: ' + error.message;
        confirmBtn.style.display = "none";
        cancelBtn.style.display = "none";
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
      if (event.target.classList.contains("delete-btn") && event.target.dataset.modal === "true") {
        userIdToDelete = event.target.dataset.id;
        modalMessage.textContent = "Deseja realmente excluir este usuário?";
        confirmBtn.style.display = "inline-block";
        cancelBtn.style.display = "inline-block";
        modal.style.display = "block";
      }
    });

    // Evento de clique no botão de confirmação do modal
    confirmBtn.addEventListener("click", function() {
      if (userIdToDelete) {
        deleteUser(userIdToDelete);
        userIdToDelete = null;
      }
    });

    // Evento de clique no botão de cancelamento do modal
    cancelBtn.addEventListener("click", function() {
      modal.style.display = "none";
      userIdToDelete = null;
    });

    // Fechar o modal se clicar fora dele
    window.addEventListener("click", function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
        userIdToDelete = null;
      }
    });

  } else {
    console.error('Elementos não encontrados. Verifique se os IDs estão corretos.');
  }
});

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

function downloadPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  // Título do documento PDF
  doc.text("Relatório de Clientes", 105, 10, null, null, 'center');

  // Cabeçalhos da tabela
  const headers = ["ID do Cliente", "Nome", "Compras"];

  // Montando os dados da tabela
  let rows = [];
  const table = document.getElementById("tabelaUsuarios").getElementsByTagName("tbody")[0];
  const trs = table.getElementsByTagName("tr");

  for (let tr of trs) {
    const tds = tr.getElementsByTagName("td");
    let row = [];
    for (let td of tds) {
      row.push(td.innerText);
    }
    rows.push(row);
  }

  // Adicionar a tabela ao PDF
  doc.autoTable({
    head: [headers],
    body: rows,
    startY: 20,
    theme: 'grid',
    headStyles: { fillColor: [64, 91, 57] }, // Cor de fundo dos cabeçalhos
    styles: { font: 'courier', fontSize: 11 }
  });

  // Salva o PDF
  doc.save("relatorio-clientes.pdf");
}
