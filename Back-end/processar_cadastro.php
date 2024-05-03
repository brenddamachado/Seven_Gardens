<?php 
// Assegure-se de que este arquivo contém as credenciais corretas para acessar o banco de dados
include("../PHP/connect.php"); 

// Captura dos dados do formulário
if (isset($_POST['cadastrar'])) {
    $nome_completo = $_POST['nome'];
    $nome_materno = $_POST['nomeDamae'];
    $data_nascimento = $_POST['data'];
    $sexo = $_POST['genero'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone_celular = $_POST['numeroCelular'];
    $endereco_completo = $_POST['cep'] . " " . $_POST['cidade'] . " " . $_POST['bairro'] . " " . $_POST['rua'] . " " . $_POST['numero'] . " " . $_POST['complemento'];
    $user_name = $_POST['login'];
    $senha = $_POST['senha'];
    $tipo_usuario = 'Cliente'; // Isso é um exemplo, você pode querer adicionar um campo no formulário para especificar o tipo do usuário
    $ativado = true;

    // Verificação de e-mail único
    $verify_query = mysqli_query($conn, "SELECT email FROM usuario WHERE email='$email'");

    if(mysqli_num_rows($verify_query) !=0 ){
      echo "Este e-mail está em uso, por favor, tente outro.";
  } else {
      // Inserir usuário no banco de dados
      $query = "INSERT INTO usuario (nome, nome_mae, data_nascimento, genero, cpf, telefone_celular, cep, cidade, bairro, rua, numero, complemento, user_name, email, senha) 
                VALUES ('$nome_completo', '$nome_materno', '$data_nascimento', '$genero', '$cpf', '$numeroCelular', '$cep', '$cidade', '$bairro', '$rua', '$numero', '$complemento', '$login', '$email', '$senha')";
      if(mysqli_query($conn, $query)){
          echo "Usuário cadastrado com sucesso!";
      } else{
          echo "Erro ao cadastrar o usuário. Por favor, tente novamente.";
      }
  }
}

?>