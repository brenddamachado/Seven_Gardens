<script>
            document.addEventListener('DOMContentLoaded', function() {
              const form = document.getElementById('modalAdicionarColaborador').querySelector('form');
              const responseMessageElement = document.getElementById('responseMessage');
              const submitButton = form.querySelector('button[type="submit"]');

              form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                submitButton.disabled = true;

                fetch(this.action, {
                    method: 'POST',
                    body: formData
                  })
                  .then(response => response.json())
                  .then(data => {
                    responseMessageElement.textContent = data.message;
                    responseMessageElement.style.display = 'block';
                    responseMessageElement.style.color = data.success ? 'green' : 'red';

                    if (data.success) {
                      form.reset();
                    }

                    submitButton.disabled = false;
                  })
                  .catch(error => {
                    console.error('Erro:', error);
                    responseMessageElement.textContent = 'Erro ao enviar o formulário.';
                    responseMessageElement.style.display = 'block';
                    responseMessageElement.style.color = 'red';
                    submitButton.disabled = false;
                  });
              });
            });
            
          </script>
          <!-- JavaScript para exibir mensagem na modal de cadastro do Colaborador -->
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const form = document.getElementById('modalAdicionarColaborador').querySelector('form');

              form.addEventListener('submit', function(e) {
                e.preventDefault(); // Impede o envio tradicional do formulário

                const formData = new FormData(this);
                const responseMessageElement = document.getElementById('responseMessage'); // Elemento para mostrar mensagens de resposta

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
                  })
                  .catch(error => {
                    console.error('Erro:', error);
                    responseMessageElement.textContent = 'Erro ao enviar o formulário.';
                    responseMessageElement.style.display = 'block';
                    responseMessageElement.style.color = 'red'; // Cor vermelha para erros
                  });
              });
            });
          </script>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
                  const form = document.getElementById('formAdicionarColaborador');
                  const responseMessageElement = document.getElementById('responseMessage');
                  const submitButton = form.querySelector('button[type="submit"]');
                  form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        const formData = new FormData(this);
                        submitButton.disabled = true; // Desabilita o botão para evitar envios múltiplos fetch
                        (this.action, { method: 'POST', body: formData }) .then(response => response.json()) .then(data => { responseMessageElement.textContent = data.message; responseMessageElement.style.display = 'block'; responseMessageElement.style.color = data.success ? 'green' : 'red'; if (data.success) { form.reset(); } submitButton.disabled = false; }) .catch(error => { console.error('Erro:', error); responseMessageElement.textContent = 'Erro ao enviar o formulário.'; responseMessageElement.style.display = 'block'; responseMessageElement.style.color = 'red'; submitButton.disabled = false;
                           // Habilita o botão novamente em caso de erro  
                          }); }); }); 
          </script>


          
<script>
        
  
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

        function abrirModalAdicionarProduto() {
            var modal = document.getElementById("modalAdicionarProduto");
            if (modal) {
                modal.showModal();
            }
        }

        function fecharModalAdicionarProduto() {
            var modal = document.getElementById("modalAdicionarProduto");
            if (modal) {
                modal.close();
            }
        }
    </script>
