<?php
include "conexao.php"; // Conectar ao banco de dados

// Consulta para listar os carros
$sql = "SELECT * FROM CARRO";
$resultado = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color:rgb(20, 54, 77);
            color: #fff;
        }

        table td {
            background-color: #f9f9f9;
        }

        table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        table a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        table a:hover {
            text-decoration: underline;
        }

        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn {
            background-color:rgb(7, 30, 46);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }

        .link-container a {
            margin: 0 10px;
            color: #3498db;
            font-weight: bold;
        }

        .link-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Lista de Carros</h2>

    <?php
    if ($resultado->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano</th>
                    <th>Cor</th>
                    <th>Categoria</th>
                    <th>Filial</th>
                    <th>Ações</th>
                </tr>";

        while ($linha = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>" . $linha['ID_CARRO'] . "</td>
                    <td>" . $linha['PLACA'] . "</td>
                    <td>" . $linha['MARCA'] . "</td>
                    <td>" . $linha['MODELO'] . "</td>
                    <td>" . $linha['ANO'] . "</td>
                    <td>" . $linha['COR'] . "</td>
                    <td>" . $linha['CATEGORIA'] . "</td>
                    <td>" . $linha['ID_FILIAL'] . "</td>
                    <td class='actions'>
                        <a href='editar_carro.php?id=" . $linha['ID_CARRO'] . "'>Editar</a> |
                        <a href='excluir_carro.php?id=" . $linha['ID_CARRO'] . "'>Excluir</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Não há carros cadastrados.</p>";
    }
    ?>

    <div class="link-container">
        <a href="adicionar_carro.php" class="btn">Adicionar Novo Carro</a>
        <a href="index.php" class="btn">Voltar para Menu Principal</a>
    </div>
</div>

</body>
</html>
