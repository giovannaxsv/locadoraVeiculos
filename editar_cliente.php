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
        echo "<p class='error-message'>Cliente não encontrado!</p>";
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
        echo "<p class='success-message'>Cliente atualizado com sucesso!</p>";
        header('Location: clientes.php'); // Redireciona de volta para a lista de clientes
        exit;
    } else {
        echo "<p class='error-message'>Erro ao atualizar cliente: " . $conexao->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <style>
        body {
            background: linear-gradient(135deg, #1A1A24, #000000);
            color: #F3F3F3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #020202;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        h2 {
            color: #BBFF63;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #BBFF63;
            font-weight: bold;
        }
        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #BBFF63;
            border-radius: 8px;
            background: #1A1A24;
            color: #F3F3F3;
            font-size: 16px;
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
            margin-bottom: 15px;
        }
        .error-message {
            color: #FF5555;
            text-align: center;
            margin-bottom: 15px;
        }
        a {
            color: #BBFF63;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 20px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Cliente</h2>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $cliente['NOME']; ?>" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?php echo $cliente['CPF']; ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo $cliente['TELEFONE']; ?>">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo $cliente['EMAIL']; ?>">

            <input type="submit" value="Salvar Alterações">
        </form>
        <a href="clientes.php">Voltar para a lista de clientes</a>
    </div>
</body>
</html>