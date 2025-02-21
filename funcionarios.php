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
        body {
            background: linear-gradient(135deg, #1A1A24, #020202);
            color: #F3F3F3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #1A1A24;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        h1, h2 {
            color: #BBFF63;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 0 auto;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #BBFF63;
            text-align: center;
        }
        th {
            background-color: #020202;
        }
        a {
            color: #BBFF63;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #BBFF63;
            color: #020202;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            transition: background 0.3s ease;
        }
        .btn:hover {
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Botão para retornar ao menu principal -->
        <a href="index.php" class="btn">Voltar ao Menu Principal</a>
        <h1>Gerenciar Funcionários</h1>

        

        <!-- Adicionar Funcionário -->
        <h2>Adicionar Funcionário</h2>
        <form action="funcionarios.php" method="POST">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" required>

            <label for="cargo">Cargo:</label>
            <input type="text" name="cargo" required>

            <input type="submit" value="Adicionar">
        </form>

        <?php
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
                    echo "<p class='success-message'>Funcionário adicionado com sucesso!</p>";
                } else {
                    echo "<p class='error-message'>Erro ao adicionar funcionário: " . $conexao->error . "</p>";
                }
            } else {
                echo "<p class='error-message'>Por favor, preencha todos os campos.</p>";
            }
        }
        ?>

        <!-- Listar Funcionários -->
        <h2>Lista de Funcionários</h2>
        <?php
        $sql = "SELECT * FROM FUNCIONARIOS";
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>CPF</th>
                        <th>CARGO</th>
                        <th>Ações</th>
                    </tr>";
            while ($linha = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . $linha["ID_FUNCIONARIO"] . "</td>
                        <td>" . $linha["CPF"] . "</td>
                        <td>" . $linha["CARGO"] . "</td>
                        <td>
                            <a href='editar_funcionario.php?id=" . $linha["ID_FUNCIONARIO"] . "'>Editar</a> | 
                            <a href='excluir_funcionario.php?id=" . $linha["ID_FUNCIONARIO"] . "'>Excluir</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='error-message'>Não há funcionários cadastrados.</p>";
        }
        ?>
    </div>
</body>
</html>