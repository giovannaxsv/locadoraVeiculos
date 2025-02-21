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
<a href="aluguel.php">Voltar para os alugueis</a>
<h2>Editar Aluguel</h2>

<form method="POST" action="editar_aluguel.php?id=<?php echo $id_aluguel; ?>" class="formulario">
    <div class="campo">
        <label for="data_inicio">Data de Início:</label><br>
        <input type="date" id="data_inicio" name="data_inicio" value="<?php echo $aluguel['DATA_INICIO']; ?>" required>
    </div>

    <div class="campo">
        <label for="data_final">Data de Fim:</label><br>
        <input type="date" id="data_final" name="data_final" value="<?php echo $aluguel['DATA_FINAL']; ?>" required>
    </div>

    <div class="campo">
        <label for="valor_total">Valor Total:</label><br>
        <input type="number" id="valor_total" name="valor_total" value="<?php echo $aluguel['VALOR_TOTAL']; ?>" step="0.01" required>
    </div>

    <div class="campo">
        <label for="metodo_pagamento">Método de Pagamento:</label><br>
        <input type="text" id="metodo_pagamento" name="metodo_pagamento" value="<?php echo $aluguel['METODO_DE_PAGAMENTO']; ?>" required>
    </div>

    <div class="campo">
        <label for="id_cliente">Cliente:</label><br>
        <select id="id_cliente" name="id_cliente" required>
            <?php while ($linha_cliente = $result_clientes->fetch_assoc()) { ?>
                <option value="<?php echo $linha_cliente['ID_CLIENTE']; ?>" <?php echo ($linha_cliente['ID_CLIENTE'] == $aluguel['ID_CLIENTE']) ? 'selected' : ''; ?>><?php echo $linha_cliente['NOME']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="campo">
        <label for="id_funcionario">Funcionário:</label><br>
        <select id="id_funcionario" name="id_funcionario" required>
            <?php while ($linha_funcionario = $result_funcionarios->fetch_assoc()) { ?>
                <option value="<?php echo $linha_funcionario['ID_FUNCIONARIO']; ?>" <?php echo ($linha_funcionario['ID_FUNCIONARIO'] == $aluguel['ID_FUNCIONARIO']) ? 'selected' : ''; ?>><?php echo $linha_funcionario['CARGO']; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="campo">
        <label for="id_carro">Carro:</label><br>
        <select id="id_carro" name="id_carro" required>
            <?php while ($linha_carro = $result_carros->fetch_assoc()) { ?>
                <option value="<?php echo $linha_carro['ID_CARRO']; ?>" <?php echo ($linha_carro['ID_CARRO'] == $aluguel['ID_CARRO']) ? 'selected' : ''; ?>><?php echo $linha_carro['PLACA']; ?></option>
            <?php } ?>
        </select>
    </div>

    <input type="submit" value="Atualizar Aluguel">
</form>



<style>
    body {
        font-family: Arial, sans-serif;
        background-color:rgb(8, 8, 8);
        color: #020202;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #BBFF63;
        text-align: center;
        margin-top: 20px;
    }

    .formulario {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        background: linear-gradient(to bottom right, #BBFF63, #1A1A24);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        max-width: 800px;
    }

    .campo {
        flex: 1 1 45%;
        margin-bottom: 15px;
        padding: 15px;
        background-color: #FFFFFF;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .campo label {
        display: block;
        font-weight: bold;
        color: #1A1A24;
    }

    .campo input, .campo select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #BBFF63;
        border-radius: 8px;
        background-color: #F3F3F3;
        color: #1A1A24;
    }

    input[type="submit"] {
        background-color: #BBFF63;
        color: #020202;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 8px;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #1A1A24;
        color: #FFFFFF;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        text-align: center;
        color: #BBFF63;
        font-weight: bold;
        text-decoration: none;
        padding: 10px 20px;
        border: 2px solid #BBFF63;
        border-radius: 5px;
    }

    a:hover {
        background-color: #BBFF63;
        color: #FFFFFF;
    }
</style>
