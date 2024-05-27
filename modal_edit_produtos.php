<!-- Modal de Edição -->
<div id="modalEditar" class="modal-editar">
  <div class="modal-content-editar">
    <span class="close-editar">&times;</span>
    <h2>Editar Produto</h2>
    <form id="editarForm" method="POST" action="/Seven_Gardens/Back-end/editarProduto.php">
      <input type="hidden" name="idProduto" id="editarId">
      <div class="input-box">
        <label for="editarNome">Nome:</label>
        <input type="text" name="nome" id="editarNome" required>
      </div>
      <div class="input-box">
        <label for="editarPreco">Preço:</label>
        <input type="text" name="preco" id="editarPreco" required>
      </div>
      <div class="input-box">
        <label for="editarDescricao">Descrição:</label>
        <textarea name="descricao" id="editarDescricao" required></textarea>
      </div>
      <div class="input-box">
        <label for="editarCategoria">Categoria:</label>
        <input type="text" name="categoria" id="editarCategoria" required>
      </div>
      <div class="input-box">
        <label for="editarSubcategoria">Subcategoria:</label>
        <input type="text" name="subcategoria" id="editarSubcategoria" required>
      </div>
      <div class="button-box">
        <button type="submit">Salvar Alterações</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal de Exclusão -->
<div id="modalExcluir" class="modal-excluir">
  <div class="modal-content-excluir">
    <span class="close-excluir">&times;</span>
    <h2>Excluir Produto</h2>
    <p>Tem certeza de que deseja excluir este produto?</p>
    <form id="excluirForm" method="POST" action="/Seven_Gardens/Back-end/excluirProduto.php">
      <input type="hidden" name="idProduto" id="excluirId">
      <div class="button-box">
        <button type="submit">Excluir</button>
        <button type="button" class="cancel-btn">Cancelar</button>
      </div>
    </form>
  </div>
</div>