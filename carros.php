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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg,rgb(134, 138, 132),rgb(158, 255, 182));
            color: #FFFFFF;
            padding: 20px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            background:rgb(34, 33, 33);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
        }

        h2 {
            text-align: center;
            color: #BBFF63;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #020202;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #BBFF63;
        }

        th {
            background: #BBFF63;
            color: #020202;
            font-weight: bold;
        }

        td {
            background: #1A1A24;
            color: #FFFFFF;
        }

        tr:nth-child(even) td {
            background: #020202;
        }

        .car-image {
            width: 100px;
            height: auto;
            border-radius: 8px;
        }

        .actions a {
            display: inline-block;
            padding: 8px 15px;
            margin: 5px;
            background: #BBFF63;
            color: #020202;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .actions a:hover {
            background: #036310;
            color: #FFFFFF;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            background: #BBFF63;
            color: #020202;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin: 10px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #036310;
            color: #FFFFFF;
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
                        <a href='editar_carro.php?id=" . $linha['ID_CARRO'] . "'>Editar</a>
                        <a href='excluir_carro.php?id=" . $linha['ID_CARRO'] . "'>Excluir</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center; color: #BBFF63;'>Não há carros cadastrados.</p>";
    }
    ?>

    <div class="link-container">
        <a href="adicionar_carro.php" class="btn">Adicionar Novo Carro</a>
        <a href="index.php" class="btn">Voltar para Menu Principal</a>
    </div>
</div>

</body>
</html>
