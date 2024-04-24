<?php
include 'conexao_bd.php';

// Consulta os equipamentos no banco de dados
$sql = "SELECT * FROM equipamento";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    // Exibe os equipamentos
    echo "<h1>Lista de Equipamentos</h1>";
    echo "<ul>";
    while($linha = $resultado->fetch_assoc()) {
        echo "<li><strong>Nome:</strong> " . $linha["nome_equipamento"] . " - <strong>Descrição:</strong> " . $linha["descricao"] . "</li>";
    }
    echo "</ul>";
} else {
    // Caso não haja equipamentos
    echo "Nenhum equipamento encontrado.";
}
?>
