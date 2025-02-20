<?php
include "conexao.php"; // Conectar ao banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #2d3e50; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { color: #007bff; text-decoration: none; }
        form { margin-top: 20px; }
    </style>
</head>
<body>

    <h1>Gerenciar Clientes</h1>

    <!-- Adicionar Cliente -->
    <h2>Adicionar Cliente</h2>
    <form action="clientes.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" required><br><br>
        <label for="cpf">CPF:</label><br>
        <input type="text" name="cpf" required><br><br>
        <label for="telefone">Telefone:</label><br>
        <input type="text" name="telefone"><br><br>
        <label for="email">Email:</label><br>
        <input type="email" name="email"><br><br>
        <input type="submit" value="Adicionar">
    </form>

    <?php
    // Processar a Adição do Cliente
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $sql = "INSERT INTO CLIENTE (NOME, CPF, TELEFONE, EMAIL) VALUES ('$nome', '$cpf', '$telefone', '$email')";
        if ($conexao->query($sql) === TRUE) {
            echo "<p>Cliente adicionado com sucesso!</p>";
        } else {
            echo "<p>Erro ao adicionar cliente: " . $conexao->error . "</p>";
        }
    }
    ?>

    <!-- Listar Clientes -->
    <h2>Lista de Clientes</h2>
    <?php
    $sql = "SELECT * FROM CLIENTE";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nome</th><th>CPF</th><th>Telefone</th><th>Email</th><th>Ações</th></tr>";
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr><td>" . $linha["ID_CLIENTE"] . "</td><td>" . $linha["NOME"] . "</td><td>" . $linha["CPF"] . "</td><td>" . $linha["TELEFONE"] . "</td><td>" . $linha["EMAIL"] . "</td><td><a href='editar_cliente.php?id=" . $linha["ID_CLIENTE"] . "'>Editar</a> | <a href='excluir_cliente.php?id=" . $linha["ID_CLIENTE"] . "'>Excluir</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Não há clientes cadastrados.</p>";
    }
    ?>

</body>
</html>
