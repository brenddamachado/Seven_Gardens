<?php


include('../Front-end/PHP/connect.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    $nome_completo = $_POST['nome_completo'];
    $email = $_POST['email'];
    $telefone_celular = $_POST['telefone_celular'];
    $logradouro = $_POST['logradouro'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar se o colaborador já existe
    $sql = "SELECT * FROM colaboradores WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Colaborador já existe
        $response = array('success' => false, 'message' => 'Colaborador já cadastrado com este email ou username.');
    } else {
        // Cadastrar novo colaborador
        $sql = "INSERT INTO colaboradores (nome_completo, email, telefone_celular, logradouro, username, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss', $nome_completo, $email, $telefone_celular, $logradouro, $username, $password);
        
        if ($stmt->execute()) {
            $response = array('success' => true, 'message' => 'Colaborador cadastrado com sucesso.');
        } else {
            $response = array('success' => false, 'message' => 'Erro ao cadastrar colaborador.');
        }
    }

    echo json_encode($response);
    exit();
}
?>


<script>

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formAdicionarColaborador');
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

</script>
