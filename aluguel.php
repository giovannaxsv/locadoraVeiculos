<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aluguéis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #020202, #1A1A24);
            color: #FFFFFF;
            text-align: center;
            padding: 20px;
        }
        h2 {
            color: #BBFF63;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #F3F3F3;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #000000;
            color: #020202;
        }
        th {
            background-color: #BBFF63;
        }
        a {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px;
            text-decoration: none;
            background: #BBFF63;
            color: #020202;
            border-radius: 5px;
            font-weight: bold;
        }
        a:hover {
            background: #A0E856;
        }
    </style>
</head>
<body>
    <?php 
    include "conexao.php";
    
    $id_aluguel = isset($_GET['id']) ? $_GET['id'] : null;

    if ($id_aluguel) {
        $sql = "SELECT a.ID_ALUGUEL, a.DATA_INICIO, a.DATA_FINAL, a.VALOR_TOTAL, a.METODO_DE_PAGAMENTO, 
                       c.NOME AS CLIENTE, f.CARGO AS FUNCIONARIO, ca.PLACA AS CARRO
                FROM ALUGUEL a
                JOIN CLIENTE c ON a.ID_CLIENTE = c.ID_CLIENTE
                JOIN FUNCIONARIOS f ON a.ID_FUNCIONARIO = f.ID_FUNCIONARIO
                JOIN CARRO ca ON a.ID_CARRO = ca.ID_CARRO
                WHERE a.ID_ALUGUEL = $id_aluguel";
        
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            $linha = $resultado->fetch_assoc();
            echo "<h2>Detalhes do Aluguel</h2>";
            echo "<table>
                    <tr><th>ID</th><th>Data Início</th><th>Data Final</th><th>Valor Total</th><th>Método de Pagamento</th><th>Cliente</th><th>Funcionário</th><th>Carro</th><th>Ações</th></tr>
                    <tr>
                        <td>" . $linha['ID_ALUGUEL'] . "</td>
                        <td>" . $linha['DATA_INICIO'] . "</td>
                        <td>" . $linha['DATA_FINAL'] . "</td>
                        <td>R$ " . $linha['VALOR_TOTAL'] . "</td>
                        <td>" . $linha['METODO_DE_PAGAMENTO'] . "</td>
                        <td>" . $linha['CLIENTE'] . "</td>
                        <td>" . $linha['FUNCIONARIO'] . "</td>
                        <td>" . $linha['CARRO'] . "</td>
                        <td><a href='editar_aluguel.php?id=" . $linha['ID_ALUGUEL'] . "'>Editar</a></td>
                    </tr>
                  </table>";
        } else {
            echo "<p>Aluguel não encontrado.</p>";
        }
    } else {
        $sql = "SELECT a.ID_ALUGUEL, a.DATA_INICIO, a.DATA_FINAL, a.VALOR_TOTAL, a.METODO_DE_PAGAMENTO, 
                       c.NOME AS CLIENTE, f.CARGO AS FUNCIONARIO, ca.PLACA AS CARRO
                FROM ALUGUEL a
                JOIN CLIENTE c ON a.ID_CLIENTE = c.ID_CLIENTE
                JOIN FUNCIONARIOS f ON a.ID_FUNCIONARIO = f.ID_FUNCIONARIO
                JOIN CARRO ca ON a.ID_CARRO = ca.ID_CARRO";
        
        $resultado = $conexao->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<h2>Lista de Aluguéis</h2>";
            echo "<table>
                    <tr><th>ID</th><th>Data Início</th><th>Data Final</th><th>Valor Total</th><th>Método de Pagamento</th><th>Cliente</th><th>Funcionário</th><th>Carro</th><th>Ações</th></tr>";
            while ($linha = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . $linha['ID_ALUGUEL'] . "</td>
                        <td>" . $linha['DATA_INICIO'] . "</td>
                        <td>" . $linha['DATA_FINAL'] . "</td>
                        <td>R$ " . $linha['VALOR_TOTAL'] . "</td>
                        <td>" . $linha['METODO_DE_PAGAMENTO'] . "</td>
                        <td>" . $linha['CLIENTE'] . "</td>
                        <td>" . $linha['FUNCIONARIO'] . "</td>
                        <td>" . $linha['CARRO'] . "</td>
                        <td><a href='editar_aluguel.php?id=" . $linha['ID_ALUGUEL'] . "'>Editar</a></td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Não há aluguéis cadastrados.</p>";
        }
    }
    ?>

    <a href="adicionar_aluguel.php">Adicionar Novo Aluguel</a>
    <a href="index.php">Voltar para Menu Principal</a>
</body>
</html>
