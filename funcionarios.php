<?php
include "conexao.php"; // Conectar ao banco de dados
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Funcionários</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h2 { color: #2d3e50; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { color: #007bff; text-decoration: none; }
        form { margin-top: 20px; }
        .btn { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

 <!-- Botão para retornar ao menu principal -->
 <br><br>
    <a href="index.php"><button class="btn">Voltar ao Menu Principal</button></a>
    <h1>Gerenciar Funcionários</h1>

    <!-- Adicionar Funcionário -->
    <h2>Adicionar Funcionário</h2>
    <form action="funcionarios.php" method="POST">
        
        <label for="cpf">CPF:</label><br>
        <input type="text" name="cpf" required><br><br>
        <label for="cargo">Cargo:</label><br>
        <input type="text" name="cargo" required><br><br>
        <input type="submit" value="Adicionar">
    </form>

    <?php
    // Processar a Adição do Funcionário
   // Processar a Adição do Funcionário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifique se os campos "cpf" e "cargo" foram enviados no formulário
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $cargo = isset($_POST['cargo']) ? $_POST['cargo'] : '';

    // Verificar se os dados estão corretos antes de inserir no banco
    if (!empty($cpf) && !empty($cargo)) {
        // Escapar os dados para evitar SQL injection
        $cpf = $conexao->real_escape_string($cpf);
        $cargo = $conexao->real_escape_string($cargo);

        // Consulta SQL para inserir o funcionário
        $sql = "INSERT INTO FUNCIONARIOS (CPF, CARGO) VALUES ('$cpf', '$cargo')";

        // Executar a consulta
        if ($conexao->query($sql) === TRUE) {
            echo "<p>Funcionário adicionado com sucesso!</p>";
        } else {
            echo "<p>Erro ao adicionar funcionário: " . $conexao->error . "</p>";
        }
    } else {
        echo "<p>Por favor, preencha todos os campos.</p>";
    }
}
    ?>

    <!-- Listar Funcionários -->
    <h2>Lista de Funcionários</h2>
    <?php
    $sql = "SELECT * FROM FUNCIONARIOS";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>CPF</th><th>CARGO</th><th>Ações</th></tr>";
        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>" . $linha["ID_FUNCIONARIO"] . "</td>
                <td>" . $linha["CPF"] . "</td>
                <td>" . $linha["CARGO"] . "</td>
                <td><a href='editar_funcionario.php?id=" . $linha["ID_FUNCIONARIO"] . "'>Editar</a> | <a href='excluir_funcionario.php?id=" . $linha["ID_FUNCIONARIO"] . "'>Excluir</a></td>
              </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Não há funcionários cadastrados.</p>";
    }
    ?>

   

</body>
</html>
