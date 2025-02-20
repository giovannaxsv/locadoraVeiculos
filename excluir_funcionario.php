<?php
include "conexao.php"; // Conectar ao banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir o funcionário pelo ID
    $sql = "DELETE FROM FUNCIONARIOS WHERE ID_FUNCIONARIO = $id";
    if ($conexao->query($sql) === TRUE) {
        echo "<p>Funcionário excluído com sucesso!</p>";
    } else {
        echo "<p>Erro ao excluir funcionário: " . $conexao->error . "</p>";
    }
} else {
    echo "<p>ID não especificado.</p>";
}
?>

<a href="funcionarios.php">Voltar à lista de funcionários</a>
