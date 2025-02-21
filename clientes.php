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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #020202 0%, #1A1A24 100%);
            color:rgb(15, 13, 13);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            width: 100%;
            max-width: 1000px; /* Limitar a largura do conteúdo */
            padding: 20px;
            background-color: #1A1A24;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }
        h1 {
            color: #BBFF63;
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }
        h2 {
            color: #BBFF63;
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #F3F3F3;
            border-radius: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #1A1A24;
            color: #BBFF63;
        }
        td {
            background-color: #FFFFFF;
        }
        a {
            color: #BBFF63;
            text-decoration: none;
        }
        .btn {
            background-color: #BBFF63;
            color: #020202;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #1A1A24;
            color: #FFFFFF;
        }
        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin: 10px 0;
            background-color: #F3F3F3;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #BBFF63;
            color: #020202;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #1A1A24;
            color: #FFFFFF;
        }
        form {
            background-color: #1A1A24;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            color: #FFFFFF;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .form-row .form-group {
            flex: 1;
        }
        .form-row .form-group input {
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>ㅤㅤㅤㅤ</h1>
        <!-- Botão para retornar ao menu principal -->
        <a href="index.php"><button class="btn">Voltar ao Menu Principal</button></a>
        
        <!-- Adicionar Cliente -->
        <h2>ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤCADASTRAR CLIENTE</h2>
        <form action="clientes.php" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">Nome:</label><br>
                    <input type="text" name="nome" required><br><br>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label><br>
                    <input type="text" name="cpf" required><br><br>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="telefone">Telefone:</label><br>
                    <input type="text" name="telefone"><br><br>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label><br>
                    <input type="email" name="email"><br><br>
                </div>
            </div>
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
                echo "<p style='color: #BBFF63;'>Cliente adicionado com sucesso!</p>";
            } else {
                echo "<p style='color: #FF6B6B;'>Erro ao adicionar cliente: " . $conexao->error . "</p>";
            }
        }
        ?>

        <!-- Listar Clientes -->
        <h2>Lista de Clientes Cadastrados</h2>
        <?php
        $sql = "SELECT * FROM CLIENTE";
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table><tr><th>ID</th><th>Nome</th><th>CPF</th><th>Telefone</th><th>Email</th>";
            while ($linha = $resultado->fetch_assoc()) {
                echo "<tr><td>" . $linha["ID_CLIENTE"] . "</td><td>" . $linha["NOME"] . "</td><td>" . $linha["CPF"] . "</td><td>" . $linha["TELEFONE"] . "</td><td>" . $linha["EMAIL"] . "</td><td><a href='editar_cliente.php?id=" . $linha["ID_CLIENTE"] . "' class='btn'>Editar</a> | <a href='excluir_cliente.php?id=" . $linha["ID_CLIENTE"] . "' class='btn'>Excluir</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p style='color: #FF6B6B;'>Não há clientes cadastrados.</p>";
        }
        ?>
    </div>

</body>
</html>
