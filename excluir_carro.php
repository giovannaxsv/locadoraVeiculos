<?php
include "conexao.php"; // Conectar ao banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o carro pelo ID
    $sql = "DELETE FROM CARRO WHERE ID_CARRO = $id";
    
    if ($conexao->query($sql) === TRUE) {
        echo "<p>Carro excluído com sucesso!</p>";
    } else {
        echo "<p>Erro ao excluir carro: " . $conexao->error . "</p>";
    }
} else {
    echo "<p>ID não especificado.</p>";
}
?>
<a href="carros.php">Voltar para a lista de carros</a>

