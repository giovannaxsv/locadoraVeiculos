<?php
include "conexao.php"; // Conectar ao banco

// Verifica se o ID do cliente foi passado pela URL
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // Deleta o cliente do banco de dados
    $sql_delete = "DELETE FROM CLIENTE WHERE ID_CLIENTE = $id_cliente";

    if ($conexao->query($sql_delete) === TRUE) {
        echo "Cliente excluído com sucesso!";
        header('Location: clientes.php'); // Redireciona de volta para a lista de clientes
        exit;
    } else {
        echo "Erro ao excluir cliente: " . $conexao->error;
    }
} else {
    echo "ID de cliente não fornecido.";
}
?>
