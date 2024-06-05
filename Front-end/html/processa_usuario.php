<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '../../PHP/connect.php';

$response = ['success' => false, 'message' => '', 'errors' => []];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao']) && $_POST['acao'] == 'excluir_conta') {
        if (isset($_SESSION['usuario_id'])) {
            $user_id = $_SESSION['usuario_id'];

            try {
                $pdo->beginTransaction();

                // Deletar endereços do usuário
                $sql_endereco = "DELETE FROM endereco_completo WHERE idUsuario = ?";
                $stmt_endereco = $pdo->prepare($sql_endereco);
                $stmt_endereco->execute([$user_id]);

                // Deletar histórico de login do usuário
                $sql_historico = "DELETE FROM historico_login WHERE id_usuario = ?";
                $stmt_historico = $pdo->prepare($sql_historico);
                $stmt_historico->execute([$user_id]);

                // Deletar tentativas de login do usuário
                $sql_tentativas = "DELETE FROM tentativas_login WHERE id_usuario = ?";
                $stmt_tentativas = $pdo->prepare($sql_tentativas);
                $stmt_tentativas->execute([$user_id]);

                // Deletar perguntas secretas do usuário
                $sql_perguntas = "DELETE FROM pergunta_secreta WHERE id_usuario = ?";
                $stmt_perguntas = $pdo->prepare($sql_perguntas);
                $stmt_perguntas->execute([$user_id]);

                // Deletar vendas do usuário
                $sql_vendas = "DELETE FROM vendas WHERE idUsuario = ?";
                $stmt_vendas = $pdo->prepare($sql_vendas);
                $stmt_vendas->execute([$user_id]);

                // Deletar pedidos do usuário
                $sql_pedidos = "DELETE FROM pedido WHERE id_cliente = ?";
                $stmt_pedidos = $pdo->prepare($sql_pedidos);
                $stmt_pedidos->execute([$user_id]);

                // Deletar o usuário
                $sql_usuario = "DELETE FROM usuario WHERE idUsuario = ?";
                $stmt_usuario = $pdo->prepare($sql_usuario);
                if ($stmt_usuario->execute([$user_id])) {
                    $pdo->commit();
                    session_destroy();
                    $response['success'] = true;
                    $response['redirect'] = '../../index.php';
                } else {
                    $pdo->rollBack();
                    $response['message'] = "Erro ao excluir conta. Por favor, tente novamente mais tarde.";
                }
            } catch (Exception $e) {
                $pdo->rollBack();
                $response['message'] = "Erro ao excluir conta: " . $e->getMessage();
            }
        } else {
            $response['message'] = "Usuário não autenticado.";
        }
    } elseif (isset($_POST['acao']) && $_POST['acao'] == 'alterar_senha') {
        $senha_atual = $_POST['senha_atual'];
        $nova_senha = $_POST['senha'];
        $confirmacao_senha = $_POST['senha2'];

        if (strlen($senha_atual) !== 8) {
            $response['errors']['senha_atual'] = "A senha atual deve ter exatamente 8 caracteres.";
        } elseif (strlen($nova_senha) !== 8) {
            $response['errors']['senha'] = "A nova senha deve ter exatamente 8 caracteres.";
        } elseif ($nova_senha !== $confirmacao_senha) {
            $response['errors']['senha2'] = "As novas senhas não coincidem. Por favor, tente novamente.";
        } else {
            $user_id = $_SESSION['usuario_id'];
            $sql = "SELECT senha FROM usuario WHERE idUsuario = ?";
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->execute([$user_id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $senha_hash_atual = $result['senha'];

                    if (!password_verify($senha_atual, $senha_hash_atual)) {
                        $response['errors']['senha_atual'] = "A senha atual está incorreta. Por favor, tente novamente.";
                    } else {
                        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                        $sql = "UPDATE usuario SET senha = ? WHERE idUsuario = ?";
                        if ($stmt = $pdo->prepare($sql)) {
                            if ($stmt->execute([$senha_hash, $user_id])) {
                                $response['success'] = true;
                                $response['message'] = "Senha alterada com sucesso.";
                            } else {
                                $response['errors']['senha'] = "Erro ao alterar senha. Por favor, tente novamente mais tarde.";
                            }
                        } else {
                            $response['errors']['senha'] = "Erro na preparação da consulta. Por favor, tente novamente mais tarde.";
                        }
                    }
                } else {
                    $response['errors']['senha_atual'] = "Erro ao verificar a senha atual. Por favor, tente novamente mais tarde.";
                }
            } else {
                $response['errors']['senha_atual'] = "Erro ao verificar a senha atual. Por favor, tente novamente mais tarde.";
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
