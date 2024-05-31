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
        document.addEventListener('DOMContentLoaded', function() {
            const cadastrarColaboradorButton = document.querySelector('.card-container .card:nth-child(2) button');
            const verClientesButton = document.querySelector('.card-container .card:nth-child(3) .card-button');
            const verHistoricoButton = document.querySelector('.card-container .card:nth-child(4) .card-button');

            if (<?php echo json_encode($isColaborador); ?>) {
                cadastrarColaboradorButton.disabled = true;
                cadastrarColaboradorButton.classList.add('disabled-button');
                verClientesButton.classList.add('disabled-button');
                verHistoricoButton.classList.add('disabled-button');
            }
        });

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

<script>
            // Verifique se o usuário é um colaborador ou não
            <?php
            // A variável $isColaborador deve ser definida com base na lógica do seu sistema
            // Aqui, estou assumindo que você tem uma maneira de verificar se o usuário está logado e se ele é um colaborador
            // O valor de $isColaborador deve ser true apenas se o usuário estiver logado como um colaborador
            $isUserMasterOrColaborador = isset($_SESSION['usuario_tipo']) && in_array($_SESSION['usuario_tipo'], ['Master', 'Colaborador']);
            ?>

            // Função para abrir a modal de cadastro de colaborador
            function abrirModalCadastroColaborador() {
              var modal = document.getElementById("modalAdicionarColaborador");
              if (modal) {
                modal.showModal();
              }
            }

            // Função para fechar a modal de cadastro de colaborador
            function fecharModalCadastroColaborador() {
              var modal = document.getElementById("modalAdicionarColaborador");
              if (modal) {
                modal.close();
              }
            }

            // Função para abrir a modal de adicionar produto
            function abrirModalAdicionarProduto() {
              var modal = document.getElementById("modalAdicionarProduto");
              if (modal) {
                modal.showModal();
              }
            }

            // Função para fechar a modal de adicionar produto
            function fecharModalAdicionarProduto() {
              var modal = document.getElementById("modalAdicionarProduto");
              if (modal) {
                modal.close();
              }
            }

            // Desabilite os botões se o usuário for um colaborador
            document.addEventListener('DOMContentLoaded', function() {
              const cadastrarColaboradorButton = document.querySelector('.card-container .card:nth-child(2) button');
              const verClientesButton = document.querySelector('.card-container .card:nth-child(3) .card-button');
              const verHistoricoButton = document.querySelector('.card-container .card:nth-child(4) .card-button');

              if (<?php echo $isColaborador ? 'true' : 'false'; ?>) {
                cadastrarColaboradorButton.disabled = true;
                cadastrarColaboradorButton.style.backgroundColor = 'gray';
                verClientesButton.style.pointerEvents = 'none';
                verClientesButton.style.backgroundColor = 'gray';
                verHistoricoButton.style.pointerEvents = 'none';
                verHistoricoButton.style.backgroundColor = 'gray';
              }
            });
          </script>