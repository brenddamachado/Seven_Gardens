<?php
// Importa o arquivo que contém a conexão com o banco de dados
require '../Front-end/PHP/connect.php';

try {
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Verifica se o usuário Master já existe
  $stmt = $pdo->prepare('SELECT * FROM usuario WHERE user_name = :user_name');
  $stmt->execute(['user_name' => 'admin_master']);
  $existingUser = $stmt->fetch();

  if ($existingUser) {
    echo "O usuário Master já está registrado no sistema.";
  } else {
    // Prepara os dados do novo usuário Master
    $user_name = 'admin_master';
    $senha = password_hash('senha_master', PASSWORD_DEFAULT); // Substitua por uma senha segura

    // Dados restantes que não podem ser nulos
    $dadosUsuario = [
      'nome_completo' => 'Admin Master',
      'data_nascimento' => '2000-01-01', // Exemplo de data
      'sexo' => 'N', // Valor representando "Não especificado"
      'nome_materno' => 'Nome Materno Padrão',
      'cpf' => '00000000000',
      'email' => 'admin@example.com',
      'telefone_celular' => '0000000000',
      'user_name' => $user_name,
      'senha' => $senha,
      'tipo_usuario' => 'Master',
      'ativado' => 1
    ];

    // Insere o usuário Master
    $sql = "
            INSERT INTO usuario (
                nome_completo, data_nascimento, sexo, nome_materno,
                cpf, email, telefone_celular, user_name, senha,
                tipo_usuario, ativado
            ) VALUES (
                :nome_completo, :data_nascimento, :sexo, :nome_materno,
                :cpf, :email, :telefone_celular, :user_name, :senha,
                :tipo_usuario, :ativado
            )
        ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($dadosUsuario);

    echo "Usuário Master registrado com sucesso!";
  }
} catch (PDOException $e) {
  echo "Erro: " . $e->getMessage();
}
