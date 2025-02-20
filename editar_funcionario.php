<?php
include "conexao.php"; // Conectar ao banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o funcionário pelo ID
    $sql = "SELECT * FROM FUNCIONARIOS WHERE ID_FUNCIONARIO = $id";
    $resultado = $conexao->query($sql);
    $funcionario = $resultado->fetch_assoc();

    if (!$funcionario) {
        die("Funcionário não encontrado.");
    }
} else {
    die("ID não especificado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];

    // Atualizar o funcionário
    $sql = "UPDATE FUNCIONARIOS SET CPF = '$cpf', CARGO = '$cargo' WHERE ID_FUNCIONARIO = $id";
    if ($conexao->query($sql) === TRUE) {
        echo "<p>Funcionário atualizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao atualizar funcionário: " . $conexao->error . "</p>";
    }
}
?>
<br>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
</head>
<body>
    <h1>Editar Funcionário</h1>
    <form action="editar_funcionario.php?id=<?php echo $id; ?>" method="POST">
        <label for="cpf">CPF:</label><br>
        <input type="text" name="cpf" value="<?php echo $funcionario['CPF']; ?>" required><br><br>
        <label for="cargo">Cargo:</label><br>
        <input type="text" name="cargo" value="<?php echo $funcionario['CARGO']; ?>" required><br><br>
        <input type="submit" value="Atualizar">
    </form>

    <a href="funcionarios.php">Voltar para a lista de funcionarios</a>
</body>
</html>
