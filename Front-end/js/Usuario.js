document.addEventListener('DOMContentLoaded', function () {
  // Seleciona todas as abas e todos os conteúdos de abas
  const tabs = document.querySelectorAll('.barra-lateral a');
  const contents = document.querySelectorAll('.secao');

  // Função para remover a classe 'active' de todas as abas e ocultar todos os conteúdos
  function deactivateAllTabs() {
    tabs.forEach(tab => tab.classList.remove('active'));
    contents.forEach(content => content.style.display = 'none');
  }

  // Adiciona o evento de clique a cada aba
  tabs.forEach(tab => {
    tab.addEventListener('click', function (e) {
      e.preventDefault();
      deactivateAllTabs();
      // Adiciona a classe 'active' à aba clicada e mostra o conteúdo correspondente
      this.classList.add('active');
      const activeContent = document.querySelector(this.getAttribute('href'));
      if (activeContent) {
        activeContent.style.display = 'block';
      }
    });
  });

  // Ativa a primeira aba por padrão
  if (tabs.length > 0) {
    tabs[0].click();
  }
});



// HAMBURGUER JS

let hamburger = document.getElementById("hamburguer");
let mobileMenu = document.getElementById("mobile");
let closeButton = document.querySelector(".close-btn");

hamburger.addEventListener("click", function () {
  mobileMenu.style.left = "0"; // Abre o menu
});

closeButton.addEventListener("click", function () {
  mobileMenu.style.left = "-100%"; // Fecha o menu
});








document.getElementById('formAlterarSenha').addEventListener('submit', function(event) {
  event.preventDefault();
  let formData = new FormData(this);
  formData.append('acao', 'alterar_senha');
  fetch('processa_usuario.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          document.getElementById('erroSenhaAtual').innerText = data.errors?.senha_atual || '';
          document.getElementById('erroSenha').innerText = data.errors?.senha || '';
          document.getElementById('erroSenha2').innerText = data.errors?.senha2 || '';
          document.getElementById('successMessage').innerText = data.message || '';
          if (data.success) {
              document.getElementById('formAlterarSenha').reset();
          }
          if (data.errors || data.message) {
              window.location.hash = '#tab5-content';
          }
      })
      .catch(error => console.error('Erro:', error));
});
document.getElementById('formExcluirConta').addEventListener('submit', function(event) {
  event.preventDefault();
  if (confirm('Tem certeza de que deseja excluir sua conta? Esta ação não pode ser desfeita.')) {
      let formData = new FormData(this);
      formData.append('acao', 'excluir_conta');
      fetch('processa_usuario.php', {
              method: 'POST',
              body: formData
          })
          .then(response => {
              if (!response.ok) {
                  throw new Error('Network response was not ok');
              }
              return response.json();
          })
          .then(data => {
              if (data.success) {
                  window.location.href = data.redirect;
              } else {
                  alert(data.message);
              }
          })
          .catch(error => console.error('Erro:', error));
  }
});


document.querySelectorAll('.toggle-password').forEach(item => {
  item.addEventListener('click', function() {
      const input = this.previousElementSibling;
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
  });
});


document.getElementById('formAlterarDados').addEventListener('submit', function(event) {
  event.preventDefault();

  let formData = new FormData(this);
  formData.append('acao', 'alterar_dados');

  fetch('processa_usuario.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert('Dados alterados com sucesso!');
              // Atualize a página ou redirecione conforme necessário
          } else {
              alert(data.message || 'Erro ao alterar os dados. Por favor, tente novamente.');
          }
      })
      .catch(error => console.error('Erro:', error));
});