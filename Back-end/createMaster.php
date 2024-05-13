<?php
require '../Front-end/PHP/connect.php';

try {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Insere o usuário Master
  $stmt = $pdo->prepare("INSERT INTO usuario
        (idUsuario, nome_completo, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, user_name, senha, tipo_usuario, ativado)
        VALUES
        (0, 'Admin Master', '2000-01-01', 'N', 'Nome Materno Padrão', '00000000000', 'admin@example.com', '0000000000', 'adminM', :senha, 'Master', 1)");
  $senhaHash = password_hash('senhamas', PASSWORD_DEFAULT); // Gera uma senha hash segura
  $stmt->bindParam(':senha', $senhaHash);
  $stmt->execute();

  // Ajusta o AUTO_INCREMENT para que o próximo usuário comece com idUsuario = 1
  $pdo->exec("ALTER TABLE usuario AUTO_INCREMENT = 1");

  echo "Usuário Master registrado com sucesso!";
} catch (PDOException $e) {
  echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
