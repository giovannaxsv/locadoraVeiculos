<?php
include "conexao.php";  // Conexão com o banco de dados

// Verifica se foi passado um ID de aluguel na URL
if (isset($_GET['id'])) {
    $id_aluguel = $_GET['id'];

    // Consulta para obter os dados do aluguel
    $sql = "SELECT * FROM ALUGUEL WHERE ID_ALUGUEL = $id_aluguel";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $aluguel = $resultado->fetch_assoc();

        // Consultas para buscar os clientes, funcionários e carros
        $sql_clientes = "SELECT * FROM CLIENTE";
        $result_clientes = $conexao->query($sql_clientes);

        $sql_funcionarios = "SELECT * FROM FUNCIONARIOS";
        $result_funcionarios = $conexao->query($sql_funcionarios);

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

            // Atualizando os dados no banco
            $sql_update = "UPDATE ALUGUEL SET 
                            DATA_INICIO = '$data_inicio', 
                            DATA_FINAL = '$data_final', 
                            VALOR_TOTAL = '$valor_total', 
                            METODO_DE_PAGAMENTO = '$metodo_pagamento', 
                            ID_CLIENTE = $id_cliente, 
                            ID_FUNCIONARIO = $id_funcionario, 
                            ID_CARRO = $id_carro 
                            WHERE ID_ALUGUEL = $id_aluguel";

            if ($conexao->query($sql_update) === TRUE) {
                echo "Aluguel atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar aluguel: " . $conexao->error;
            }
        }
    } else {
        echo "Aluguel não encontrado!";
    }
} else {
    echo "ID de aluguel não fornecido!";
}
?>

<h2>Editar Aluguel</h2>

<form method="POST" action="editar_aluguel.php?id=<?php echo $id_aluguel; ?>">
    <label for="data_inicio">Data de Início:</label><br>
    <input type="date" id="data_inicio" name="data_inicio" value="<?php echo $aluguel['DATA_INICIO']; ?>" required><br><br>

    <label for="data_final">Data de Fim:</label><br>
    <input type="date" id="data_final" name="data_final" value="<?php echo $aluguel['DATA_FINAL']; ?>" required><br><br>

    <label for="valor_total">Valor Total:</label><br>
    <input type="number" id="valor_total" name="valor_total" value="<?php echo $aluguel['VALOR_TOTAL']; ?>" step="0.01" required><br><br>

    <label for="metodo_pagamento">Método de Pagamento:</label><br>
    <input type="text" id="metodo_pagamento" name="metodo_pagamento" value="<?php echo $aluguel['METODO_DE_PAGAMENTO']; ?>" required><br><br>

    <label for="id_cliente">Cliente:</label><br>
    <select id="id_cliente" name="id_cliente" required>
        <?php while ($linha_cliente = $result_clientes->fetch_assoc()) { ?>
            <option value="<?php echo $linha_cliente['ID_CLIENTE']; ?>" <?php echo ($linha_cliente['ID_CLIENTE'] == $aluguel['ID_CLIENTE']) ? 'selected' : ''; ?>><?php echo $linha_cliente['NOME']; ?></option>
        <?php } ?>
    </select><br><br>

    <label for="id_funcionario">Funcionário:</label><br>
    <select id="id_funcionario" name="id_funcionario" required>
        <?php while ($linha_funcionario = $result_funcionarios->fetch_assoc()) { ?>
            <option value="<?php echo $linha_funcionario['ID_FUNCIONARIO']; ?>" <?php echo ($linha_funcionario['ID_FUNCIONARIO'] == $aluguel['ID_FUNCIONARIO']) ? 'selected' : ''; ?>><?php echo $linha_funcionario['CARGO']; ?></option>
        <?php } ?>
    </select><br><br>

    <label for="id_carro">Carro:</label><br>
    <select id="id_carro" name="id_carro" required>
        <?php while ($linha_carro = $result_carros->fetch_assoc()) { ?>
            <option value="<?php echo $linha_carro['ID_CARRO']; ?>" <?php echo ($linha_carro['ID_CARRO'] == $aluguel['ID_CARRO']) ? 'selected' : ''; ?>><?php echo $linha_carro['PLACA']; ?></option>
        <?php } ?>
    </select><br><br>

    <input type="submit" value="Atualizar Aluguel">
</form>

<a href="aluguel.php">Voltar para o alugueis</a>
