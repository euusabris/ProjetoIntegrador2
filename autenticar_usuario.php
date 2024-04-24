<?php
require_once "bd/conexao.php";

if(isset($_POST['email']) && isset($_POST['senha'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // Buscar o usuário na tabela
    $sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
    $resultado = $conn->query($sql);

    if($resultado->num_rows > 0) {
        $registro = $resultado->fetch_assoc();

        // Verificar o status do usuário
        if($registro['status'] == 1){
            // Verificar as permissões do usuário
            $idUsuario = $registro['idusuario'];
            $sqlPermissoes = "SELECT * FROM permissoes WHERE idusuario='$idUsuario'";
            $resultadoPermissoes = $conn->query($sqlPermissoes);

            // Se houver permissões, criar sessão do usuário
            if($resultadoPermissoes->num_rows > 0) {
                session_start();
                $_SESSION['idUsuario'] = $registro['idusuario'];
                $_SESSION['nomeUsuario'] = $registro['nome'];
                echo "<p>Login bem-sucedido</p>";
                exit;
            } else {
                echo "<h3>Você não tem permissão para acessar o sistema.</h3>";
            }
        } else {
            echo "<h3>Você precisa verificar seu login. Status = ".$registro['status']."</h3>";
        }
    } else {
        echo "<h3>Usuário ou senha inválidos</h3>";
    }
} else {
    echo "<h3>Preencha o e-mail e a senha.</h3>";
}
?>
