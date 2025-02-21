<?php
include "conexao.php"; // Conectar ao banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o funcionário pelo ID
    $sql = "SELECT * FROM FUNCIONARIOS WHERE ID_FUNCIONARIO = $id";
    $resultado = $conexao->query($sql);
    $funcionario = $resultado->fetch_assoc();

    if (!$funcionario) {
        die("<p class='error-message'>Funcionário não encontrado.</p>");
    }
} else {
    die("<p class='error-message'>ID não especificado.</p>");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];

    // Atualizar o funcionário
    $sql = "UPDATE FUNCIONARIOS SET CPF = '$cpf', CARGO = '$cargo' WHERE ID_FUNCIONARIO = $id";
    if ($conexao->query($sql) === TRUE) {
        echo "<p class='success-message'>Funcionário atualizado com sucesso!</p>";
    } else {
        echo "<p class='error-message'>Erro ao atualizar funcionário: " . $conexao->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <style>
        body {
            background: linear-gradient(135deg, #1A1A24, #020202);
            color: #F3F3F3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #1A1A24;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        h1 {
            color: #BBFF63;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #F3F3F3;
        }
        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #BBFF63;
            border-radius: 5px;
            background: #020202;
            color: #F3F3F3;
        }
        input[type="submit"] {
            background: #BBFF63;
            color: #020202;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #99CC55;
        }
        .success-message {
            color: #BBFF63;
            text-align: center;
        }
        .error-message {
            color: #FF5555;
            text-align: center;
        }
        a {
            color: #BBFF63;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Funcionário</h1>
        <form action="editar_funcionario.php?id=<?php echo $id; ?>" method="POST">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" value="<?php echo $funcionario['CPF']; ?>" required>

            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" value="<?php echo $funcionario['CARGO']; ?>" required>

            <input type="submit" value="Atualizar">
        </form>
        <a href="funcionarios.php">Voltar para a lista de funcionários</a>
    </div>
</body>
</html>