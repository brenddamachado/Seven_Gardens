<?php
session_start();
require_once __DIR__ . '/../../Front-end/PHP/connect.php';

$response = ['success' => false, 'message' => '', 'errors' => []];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['acao']) && $_POST['acao'] == 'excluir_conta') {
        if (isset($_SESSION['usuario_id'])) {
            $user_id = $_SESSION['usuario_id'];

            $sql = "DELETE FROM usuario WHERE idUsuario=?";
            if ($stmt = $pdo->prepare($sql)) {
                if ($stmt->execute([$user_id])) {
                    session_destroy();
                    $response['success'] = true;
                    $response['redirect'] = 'Login.php';
                } else {
                    $response['message'] = "Erro ao excluir conta. Por favor, tente novamente mais tarde.";
                }
            } else {
                $response['message'] = "Erro na preparação da consulta. Por favor, tente novamente mais tarde.";
            }
        } else {
            $response['message'] = "Usuário não autenticado.";
        }
    } elseif (isset($_POST['acao']) && $_POST['acao'] == 'alterar_senha') {
        $senha_atual = $_POST['senha_atual'];
        $nova_senha = $_POST['senha'];
        $confirmacao_senha = $_POST['senha2'];

        if (strlen($nova_senha) !== 8) {
            $response['errors']['senha'] = "A nova senha deve ter exatamente 8 caracteres.";
        } elseif ($nova_senha !== $confirmacao_senha) {
            $response['errors']['senha2'] = "As novas senhas não coincidem. Por favor, tente novamente.";
        } else {
            $user_id = $_SESSION['usuario_id'];
            $sql = "SELECT senha FROM usuario WHERE idUsuario=?";
            if ($stmt = $pdo->prepare($sql)) {
                $stmt->execute([$user_id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $senha_hash_atual = $result['senha'];

                    if (!password_verify($senha_atual, $senha_hash_atual)) {
                        $response['errors']['senha_atual'] = "A senha atual está incorreta. Por favor, tente novamente.";
                    } else {
                        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                        $sql = "UPDATE usuario SET senha=? WHERE idUsuario=?";
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
