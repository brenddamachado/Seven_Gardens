document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('formAdicionarColaborador');

  form.addEventListener('submit', function(e) {
      e.preventDefault(); // Impede o envio tradicional do formulário

      const formData = new FormData(this);
      const responseMessageElement = document.getElementById('responseMessage'); // Elemento para mostrar mensagens de resposta
      const submitButton = form.querySelector('button[type="submit"]');
      submitButton.disabled = true; // Desabilita o botão para evitar envios múltiplos

      fetch(this.action, {
          method: 'POST',
          body: formData
      })
      .then(response => response.json()) // Assume que o servidor responde com JSON
      .then(data => {
          responseMessageElement.textContent = data.message; // Define a mensagem de resposta
          responseMessageElement.style.display = 'block'; // Torna o elemento visível
          responseMessageElement.style.color = data.success ? 'green' : 'red'; // Muda a cor baseada no sucesso

          if (data.success) {
              // Opcional: Limpa o formulário após sucesso
              form.reset();
          }

          submitButton.disabled = false; // Habilita o botão novamente
      })
      .catch(error => {
          console.error('Erro:', error);
          responseMessageElement.textContent = 'Erro ao enviar o formulário.';
          responseMessageElement.style.display = 'block';
          responseMessageElement.style.color = 'red'; // Cor vermelha para erros
          submitButton.disabled = false; // Habilita o botão novamente em caso de erro
      });
  });
});

// Funções para abrir e fechar o modal
function abrirModalCadastroColaborador() {
  var modal = document.getElementById("modalAdicionarColaborador");
  if (modal) {
      modal.showModal();
  }
}

function fecharModalCadastroColaborador() {
  var modal = document.getElementById("modalAdicionarColaborador");
  if (modal) {
      modal.close();
  }
}

// Função para pré-visualizar a imagem do produto (para outro modal, caso necessário)
function previewImg(event) {
  const previewImage = document.getElementById('previewImage');
  const file = event.target.files[0];
  if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewImage.style.display = 'block';
      };
      reader.readAsDataURL(file);
  }
}
