<?php
include "conexao.php"; // Conectar ao banco

// Verifica se o ID do cliente foi passado pela URL
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // Busca os dados do cliente
    $sql = "SELECT * FROM CLIENTE WHERE ID_CLIENTE = $id_cliente";
    $resultado = $conexao->query($sql);

    // Verifica se o cliente existe
    if ($resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
    } else {
        echo "Cliente não encontrado!";
        exit;
    }
}

// Processar a edição do cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Atualiza os dados no banco de dados
    $sql_update = "UPDATE CLIENTE SET 
                    NOME = '$nome', 
                    CPF = '$cpf', 
                    TELEFONE = '$telefone', 
                    EMAIL = '$email' 
                  WHERE ID_CLIENTE = $id_cliente";

    if ($conexao->query($sql_update) === TRUE) {
        echo "Cliente atualizado com sucesso!";
        header('Location: clientes.php'); // Redireciona de volta para a lista de clientes
        exit;
    } else {
        echo "Erro ao atualizar cliente: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body>

    <h2>Editar Cliente</h2>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $cliente['NOME']; ?>" required><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo $cliente['CPF']; ?>" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['TELEFONE']; ?>"><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo $cliente['EMAIL']; ?>"><br>

        <input type="submit" value="Salvar Alterações">
    </form>

    <br>
    <a href="clientes.php">Voltar para a lista de clientes</a>

</body>
</html>
