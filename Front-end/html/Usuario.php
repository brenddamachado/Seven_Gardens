<?php
session_start();
require_once __DIR__ . '/../../Front-end/PHP/connect.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../index.php');
    exit();
}

$user_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM usuario WHERE idUsuario = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Usuário não encontrado";
    exit();
}

$nome_completo = $user['nome_completo'];
$telefone_celular = $user['telefone_celular'];
$email = $user['email'];

$sql = "SELECT * FROM endereco_completo WHERE idUsuario = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$response = ['success' => false, 'message' => '', 'errors' => []];
// Função para buscar pedidos e itens do cliente
function buscarPedidos($pdo, $user_id) {
    $sql = "SELECT pedido.idPedido, pedido.horarioPedido, COALESCE(SUM(item_pedido.quantidade * produto.preco), 0) AS total
            FROM pedido
            LEFT JOIN item_pedido ON pedido.idPedido = item_pedido.id_pedido
            LEFT JOIN produto ON item_pedido.id_produto = produto.idProduto
            WHERE pedido.id_cliente = ?
            GROUP BY pedido.idPedido, pedido.horarioPedido";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarItensPedido($pdo, $pedido_id) {
    $sql = "SELECT produto.nome, item_pedido.quantidade
            FROM item_pedido
            JOIN produto ON item_pedido.id_produto = produto.idProduto
            WHERE item_pedido.id_pedido = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pedido_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$user_id = $_SESSION['usuario_id'];
$pedidos = buscarPedidos($pdo, $user_id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seven Gardens</title>
    <link rel="shortcut icon" href="../img/logoatual.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../css/Usuario.css" />
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/modalEstilos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
</head>
<body>
    <?php include('../../header.php'); ?>
    <div class="container-principal">
        <div class="barra-lateral">
            <a href="#tab1-content" class="active">Meu Painel</a>
            <a href="#tab2-content">Pedidos</a>
            <a href="#tab3-content">Endereços</a>
            <a href="#tab4-content">Detalhes da Conta</a>
            <a href="#tab5-content">Segurança</a>
        </div>
        <div class="conteudo-principal">
        <section id="tab1-content" class="secao">
                <h2>Meu Painel</h2>
                <p>Olá, <?php echo htmlspecialchars($nome_completo); ?> <a href="logout.php">Sair</a></p>          
        </section>
        <section id="tab2-content" class="secao">
                <h2>Seus Pedidos</h2>
                <table id="tabelaPedidos">
                    <thead>
                        <tr>
                            <th class="atributos">Pedido #</th>
                            <th class="atributos">Data</th>
                            <th class="atributos">Itens</th>
                            <th class="atributos">Total</th>
                            <th class="atributos"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($pedidos) > 0): ?>
                            <?php foreach ($pedidos as $pedido): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($pedido['idPedido']); ?></td>
                                    <td><?php echo htmlspecialchars($pedido['horarioPedido']); ?></td>
                                    <td>
                                        <ul>
                                            <?php
                                            $itens = buscarItensPedido($pdo, $pedido['idPedido']);
                                            if (count($itens) > 0):
                                                foreach ($itens as $item):
                                            ?>
                                                    <li><?php echo htmlspecialchars($item['nome']) . ' - ' . htmlspecialchars($item['quantidade']) . 'x'; ?></li>
                                            <?php
                                                endforeach;
                                            else:
                                            ?>
                                                <li>Sem itens</li>
                                            <?php endif; ?>
                                        </ul>
                                    </td>
                                    <td>R$ <?php echo number_format($pedido['total'], 2, ',', '.'); ?></td>
                                    <td><button>Ver detalhes</button></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Nenhum pedido encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
            <section id="tab3-content" class="secao">
                <h2>Endereços</h2>
                <table id="tabelaEnderecos">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CEP</th>
                            <th>Rua</th>
                            <th>Complemento</th>
                            <th class="acoes">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>João Silva</td>
                            <td>01234-567</td>
                            <td>Rua das Flores, 123</td>
                            <td>Apto 101</td>
                            <td class="botoes">
                                <button>Editar</button>
                                <button>Excluir</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
            <section id="tab4-content" class="secao">
    <div class="divForm">
        <form id="formAlterarDados">
            <div class="form-header">
                <h2 class="title">Detalhes da conta</h2>
            </div>
            <div class="container-dados">
                <div class="dados-pessoais">
                    <h3 class="title">Alteração de dados</h3>
                    <div class="input-box">
                        <label for="nome">Nome:</label>
                        <input minlength="15" type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome_completo); ?>" placeholder="Digite o seu nome">
                    </div>
                    <div class="input-box">
                        <label for="telefone">Celular:</label>
                        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($telefone_celular); ?>" placeholder="Digite o seu celular">
                    </div>
                    <div class="input-box">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Digite um e-mail">
                    </div>
                    <button type="submit" class="btn_salvar">Salvar alterações</button>
                </div>
            </div>
        </form>
    </div>
</section>

            <section id="tab5-content" class="secao">
    <div class="divForm">
        <form id="formAlterarSenha">
            <div class="form-header">
                <h2 class="title">Alteração de senha</h2>
            </div>
            <div class="success-message" id="successMessage"></div>
            <div class="alteracao-senha">
                <div class="input-box">
                    <label for="senha_atual">Senha atual:</label>
                    <div class="input-wrapper">
                        <input maxlength="8" type="password" id="senha_atual" name="senha_atual" placeholder="Digite sua senha atual" required>
                        <i class="far fa-eye toggle-password" id="toggleSenhaAtual"></i>
                    </div>
                    <div class="error-message" id="erroSenhaAtual"></div>
                </div>
                <div class="input-box">
                    <label for="senha">Nova senha:</label>
                    <div class="input-wrapper">
                        <input type="password" id="senha" name="senha" placeholder="Digite sua nova senha" maxlength="8" required>
                        <i class="far fa-eye toggle-password" id="toggleNovaSenha"></i>
                    </div>
                    <div class="error-message" id="erroSenha"></div>
                </div>
                <div class="input-box">
                    <label for="senha2">Confirmação da nova senha:</label>
                    <div class="input-wrapper">
                        <input type="password" id="senha2" name="senha2" placeholder="Confirme sua nova senha" maxlength="8" required>
                        <i class="far fa-eye toggle-password" id="toggleConfirmaSenha"></i>
                    </div>
                    <div class="error-message" id="erroSenha2"></div>
                </div>
                <button type="submit" class="btn_salvar">Salvar alterações</button>
            </div>
        </form>
        <div>
            <p>Deseja excluir sua conta?</p>
            <form id="formExcluirConta">
                <button type="submit" name="excluir_conta" class="btn_excluir">Excluir conta</button>
            </form>
        </div>
    </div>
</section>

        </div>
    </div>
    <section id="accessibility-section">
        <i class="fas fa-universal-access" id="accessibility-icon"></i>
        <div id="other-things">
            <i class="fas fa-moon" id="dark-mode-toggle"></i>
            <i class="fas fa-sun" id="light-mode-toggle"></i>
            <img class="img_letra" src="../img/aumentartext_1.svg" alt="" srcset="" id="increase-font"></i>
            <img class="img_letra" src="../img/diminuirtext_1.svg" alt="" srcset="" id="decrease-font"></i>
        </div>
    </section>
    <footer>
        <br>
        <div class="social-icons">
            <p> Siga-nos nas nossas redes sociais:</p>
            <a href="https://www.facebook.com/profile.php?id=100063959239107" class="icon" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/polen_azul?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="icon" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.whatsapp.com/catalog/5521981510975/?app_absent=0" class="icon" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>
    </footer>
    <script src="../js/Usuario.js"></script>
    <script src="../js/acessibilidade.js"></script>
    <script src="../js/carrinho.js"></script>
   
</body>
</html>
