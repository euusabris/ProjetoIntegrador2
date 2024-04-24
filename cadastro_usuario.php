<?php
require_once "topo.php";
require_once "bd/conexao.php"; // Importando o arquivo de conexão com o banco de dados

// Verificando a variável 'acao'
$acao = "";
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
} elseif (isset($_POST['acao'])) {
    $acao = $_POST['acao'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
} else {
    $acao = "novo";
    $id = 0;
    $nome = "";
    $cpf = "";
    $telefone = "";
    $email = "";
    $senha = "";
    $tipo = "";
}

// Executando ações de acordo com 'acao'
if ($acao == "editar") {
    $sql = "SELECT * FROM usuario WHERE idusuario = $id";
    $resultado = $conn->query($sql);
    foreach ($resultado as $registro) {
        $nome = $registro['nome'];
        $cpf = $registro['cpf'];
        $telefone = $registro['telefone'];
        $email = $registro['email'];
        $senha = $registro['senha'];
        $tipo = $registro['tipo'];
    }
} elseif ($acao == "excluir") {
    echo "<script>window.alert('Excluído')</script>";
    $sql = "DELETE FROM usuario WHERE idusuario = $id";
    $conn->exec($sql);
    $id = 0;
    $nome = "";
    $cpf = "";
    $telefone = "";
    $email = "";
    $senha = "";
    $tipo = "";
    $acao = "novo";
} elseif ($acao == "atualizar") {
    echo "<script>window.alert('Atualizado')</script>";
    $sql = "UPDATE usuario SET nome = '$nome', cpf = $cpf, telefone = $telefone, email = '$email', senha = '$senha', tipo = '$tipo' WHERE idusuario = $id";
    $conn->exec($sql);
    $id = 0;
    $nome = "";
    $cpf = "";
    $telefone = "";
    $email = "";
    $senha = "";
    $tipo = "";
    $acao = "novo";
} elseif ($acao == "novo" && !empty($nome)) {
    echo "<script>window.alert('Salvo com sucesso')</script>";
    $sql = "INSERT INTO usuario (nome, cpf, telefone, email, senha, tipo) VALUES ('$nome', $cpf, $telefone, '$email', '$senha', '$tipo')";
    $conn->exec($sql);
    $id = 0;
    $nome = "";
    $cpf = "";
    $telefone = "";
    $email = "";
    $senha = "";
    $tipo = "";
    $acao = "novo";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Cadastro de Usuário</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">

<main class="form-signin w-100 m-auto">
    <form action="login.php" method="post">
        <img class="mb-4" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Cadastre-se</h1>

        <div class="form-floating">
            <input type="hidden" name="acao" value="<?php echo $acao;?>">

            <input type="text" name="nome" class="form-control" id="floatingNome" placeholder="Digite seu nome" value="<?php echo $nome; ?>">
            <label for="floatingNome">Nome</label>
        </div>

        <div class="form-floating">
            <input type="text" name="cpf" class="form-control" id="floatingCPF" placeholder="123.456.789-0" value="<?php echo $cpf; ?>">
            <label for="floatingCPF">CPF</label>
        </div>

        <div class="form-floating">
            <input type="text" name="telefone" class="form-control" id="floatingTelefone" placeholder="17 98820-9532" value="<?php echo $telefone; ?>">
            <label for="floatingTelefone">Telefone</label>
        </div>

        <div class="form-floating">
            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" value="<?php echo $email; ?>">
            <label for="floatingEmail">E-mail</label>
        </div>

        <div class="form-floating">
            <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Senha" value="<?php echo $senha; ?>">
            <label for="floatingPassword">Senha</label>
        </div>

        <div class="form-floating">
            <select name="tipo" class="form-select" id="floatingTipo">
            <option value="Física" <?php if ($tipo == 'Física') echo 'Física'; ?>>Física</option>
                <option value="Jurídica" <?php if ($tipo == 'Jurídica') echo 'Jurídica'; ?>>Jurídica</option>
            </select>
            <label for="floatingTipo">Tipo</label><br></br>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Salvar</button>
