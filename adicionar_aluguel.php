<?php
include "conexao.php";  // Conexão com o banco de dados

// Consulta para buscar todos os clientes
$sql_clientes = "SELECT * FROM CLIENTE";
$result_clientes = $conexao->query($sql_clientes);

// Consulta para buscar todos os funcionários
$sql_funcionarios = "SELECT * FROM FUNCIONARIOS";
$result_funcionarios = $conexao->query($sql_funcionarios);

// Consulta para buscar todos os carros
$sql_carros = "SELECT * FROM CARRO";
$result_carros = $conexao->query($sql_carros);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebendo os dados do formulário
    $data_inicio = $_POST['data_inicio'];
    $data_final = $_POST['data_final'];
    $valor_total = $_POST['valor_total'];
    $metodo_pagamento = $_POST['metodo_pagamento'];
    $id_cliente = $_POST['id_cliente'];
    $id_funcionario = $_POST['id_funcionario'];
    $id_carro = $_POST['id_carro'];

    // Inserir dados no banco
    $sql = "INSERT INTO ALUGUEL (DATA_INICIO, DATA_FINAL, VALOR_TOTAL, METODO_DE_PAGAMENTO, ID_CLIENTE, ID_FUNCIONARIO, ID_CARRO)
            VALUES ('$data_inicio', '$data_final', '$valor_total', '$metodo_pagamento', $id_cliente, $id_funcionario, $id_carro)";

    if ($conexao->query($sql) === TRUE) {
        echo "Aluguel adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar aluguel: " . $conexao->error;
    }
}
?>

<h2>Adicionar Novo Aluguel</h2>
<form method="POST" action="adicionar_aluguel.php">
    <label for="data_inicio">Data de Início:</label><br>
    <input type="date" id="data_inicio" name="data_inicio" required><br><br>

    <label for="data_final">Data de Fim:</label><br>
    <input type="date" id="data_final" name="data_final" required><br><br>

    <label for="valor_total">Valor Total:</label><br>
    <input type="number" id="valor_total" name="valor_total" step="0.01" required><br><br>

    <label for="metodo_pagamento">Método de Pagamento:</label><br>
    <input type="text" id="metodo_pagamento" name="metodo_pagamento" required><br><br>

    <label for="id_cliente">Cliente:</label><br>
    <select id="id_cliente" name="id_cliente" required>
        <?php while ($linha_cliente = $result_clientes->fetch_assoc()) { ?>
            <option value="<?php echo $linha_cliente['ID_CLIENTE']; ?>"><?php echo $linha_cliente['NOME']; ?></option>
        <?php } ?>
    </select><br><br>

    <label for="id_funcionario">Funcionário:</label><br>
    <select id="id_funcionario" name="id_funcionario" required>
        <?php while ($linha_funcionario = $result_funcionarios->fetch_assoc()) { ?>
            <option value="<?php echo $linha_funcionario['ID_FUNCIONARIO']; ?>"><?php echo $linha_funcionario['CARGO']; ?></option>
        <?php } ?>
    </select><br><br>

    <label for="id_carro">Carro:</label><br>
    <select id="id_carro" name="id_carro" required>
        <?php while ($linha_carro = $result_carros->fetch_assoc()) { ?>
            <option value="<?php echo $linha_carro['ID_CARRO']; ?>"><?php echo $linha_carro['PLACA']; ?></option>
        <?php } ?>
    </select><br><br>

    <input type="submit" value="Adicionar Aluguel">
</form>

<a href="aluguel.php">Voltar para o alugueis</a>
