<?php
require_once "bd/conexao.php";

// Receber dados do formulário
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];

// Inserir dados no banco de dados
$sql = "INSERT INTO usuario (nome, cpf, telefone, email, senha, tipo)
        VALUES ('$nome', '$cpf', '$telefone', '$email', '$senha', '$tipo')";

if ($conn->query($sql) === TRUE) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar usuário: " . $conn->error;
}

$conn->close();
?>
