<?php
include "conexao.php"; // Conectar ao banco de dados

// Verificando se o ID do aluguel foi passado via URL (para editar um aluguel específico)
$id_aluguel = isset($_GET['id']) ? $_GET['id'] : null;

// Se o ID do aluguel for fornecido, faz a consulta para obter os detalhes do aluguel
if ($id_aluguel) {
    // Consulta para obter os detalhes do aluguel específico
    $sql = "SELECT a.ID_ALUGUEL, a.DATA_INICIO, a.DATA_FINAL, a.VALOR_TOTAL, a.METODO_DE_PAGAMENTO, 
                   a.ID_CLIENTE, a.ID_FUNCIONARIO, a.ID_CARRO, 
                   c.NOME AS CLIENTE, f.CARGO AS FUNCIONARIO, ca.PLACA AS CARRO
            FROM ALUGUEL a
            JOIN CLIENTE c ON a.ID_CLIENTE = c.ID_CLIENTE
            JOIN FUNCIONARIOS f ON a.ID_FUNCIONARIO = f.ID_FUNCIONARIO
            JOIN CARRO ca ON a.ID_CARRO = ca.ID_CARRO
            WHERE a.ID_ALUGUEL = $id_aluguel";

    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        // Exibindo os dados do aluguel
        echo "<h2>Detalhes do Aluguel</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Data Início</th>
                    <th>Data Final</th>
                    <th>Valor Total</th>
                    <th>Método de Pagamento</th>
                    <th>Cliente</th>
                    <th>Funcionário</th>
                    <th>Carro</th>
                    <th>Ações</th>
                </tr>
                <tr>
                    <td>" . $linha['ID_ALUGUEL'] . "</td>
                    <td>" . $linha['DATA_INICIO'] . "</td>
                    <td>" . $linha['DATA_FINAL'] . "</td>
                    <td>" . $linha['VALOR_TOTAL'] . "</td>
                    <td>" . $linha['METODO_DE_PAGAMENTO'] . "</td>
                    <td>" . $linha['CLIENTE'] . "</td>
                    <td>" . $linha['FUNCIONARIO'] . "</td>
                    <td>" . $linha['CARRO'] . "</td>
                    <td>
                        <a href='editar_aluguel.php?id=" . $linha['ID_ALUGUEL'] . "'>Editar</a> 
                    </td>
                </tr>
              </table>";
    } else {
        echo "<p>Aluguel não encontrado.</p>";
    }
} else {
    // Consulta para listar todos os aluguéis
    $sql = "SELECT a.ID_ALUGUEL, a.DATA_INICIO, a.DATA_FINAL, a.VALOR_TOTAL, a.METODO_DE_PAGAMENTO, 
                   c.NOME AS CLIENTE, f.CARGO AS FUNCIONARIO, ca.PLACA AS CARRO
            FROM ALUGUEL a
            JOIN CLIENTE c ON a.ID_CLIENTE = c.ID_CLIENTE
            JOIN FUNCIONARIOS f ON a.ID_FUNCIONARIO = f.ID_FUNCIONARIO
            JOIN CARRO ca ON a.ID_CARRO = ca.ID_CARRO";

    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<h2>Lista de Aluguéis</h2>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Data Início</th>
                    <th>Data Final</th>
                    <th>Valor Total</th>
                    <th>Método de Pagamento</th>
                    <th>Cliente</th>
                    <th>Funcionário</th>
                    <th>Carro</th>
                    <th>Ações</th>
                </tr>";
        while ($linha = $resultado->fetch_assoc()) {
            // Exibindo os aluguéis
            echo "<tr>
                    <td>" . $linha['ID_ALUGUEL'] . "</td>
                    <td>" . $linha['DATA_INICIO'] . "</td>
                    <td>" . $linha['DATA_FINAL'] . "</td>
                    <td>" . $linha['VALOR_TOTAL'] . "</td>
                    <td>" . $linha['METODO_DE_PAGAMENTO'] . "</td>
                    <td>" . $linha['CLIENTE'] . "</td>
                    <td>" . $linha['FUNCIONARIO'] . "</td>
                    <td>" . $linha['CARRO'] . "</td>
                    <td>
                        <a href='editar_aluguel.php?id=" . $linha['ID_ALUGUEL'] . "'>Editar</a> 
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Não há aluguéis cadastrados.</p>";
    }
}
?>

<!-- Links para adicionar e voltar ao menu principal -->
<a href="adicionar_aluguel.php">Adicionar Novo Aluguel</a>
<a href="index.php">Voltar para Menu Principal</a>
