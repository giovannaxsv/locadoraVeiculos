<?php
include "conexao.php";  // Conexão com o banco de dados

// Função para listar as manutenções
function listarManutencao($conexao) {
    $sql = "SELECT m.ID_MANUTENCAO, m.TIPO, m.CUSTO, m.DATA_MANUTENCAO, c.PLACA 
            FROM MANUTENCAO m 
            JOIN CARRO c ON m.ID_CARRO = c.ID_CARRO";
    return $conexao->query($sql);
}

// Verificar a operação (Adicionar, Editar, Excluir)
$operacao = isset($_GET['operacao']) ? $_GET['operacao'] : '';

// Adicionar Manutenção
if ($operacao == 'adicionar') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recebendo os dados do formulário
        $tipo = $_POST['tipo'];
        $custo = $_POST['custo'];
        $data_manutencao = $_POST['data_manutencao'];
        $id_carro = $_POST['id_carro'];

        // Inserir dados no banco
        $sql = "INSERT INTO MANUTENCAO (TIPO, CUSTO, DATA_MANUTENCAO, ID_CARRO) 
                VALUES ('$tipo', '$custo', '$data_manutencao', $id_carro)";

        if ($conexao->query($sql) === TRUE) {
            echo "Manutenção adicionada com sucesso!";
        } else {
            echo "Erro ao adicionar manutenção: " . $conexao->error;
        }
    }
    // Buscar carros disponíveis para manutenção
    $sql_carros = "SELECT * FROM CARRO";
    $result_carros = $conexao->query($sql_carros);
?>

<h2>Adicionar Manutenção</h2>
<form method="POST" action="manutencao.php?operacao=adicionar">
    <label for="tipo">Tipo de Manutenção:</label><br>
    <input type="text" id="tipo" name="tipo" required><br><br>

    <label for="custo">Custo:</label><br>
    <input type="number" id="custo" name="custo" step="0.01" required><br><br>

    <label for="data_manutencao">Data da Manutenção:</label><br>
    <input type="date" id="data_manutencao" name="data_manutencao" required><br><br>

    <label for="id_carro">Carro:</label><br>
    <select id="id_carro" name="id_carro" required>
        <?php while ($linha_carro = $result_carros->fetch_assoc()) { ?>
            <option value="<?php echo $linha_carro['ID_CARRO']; ?>"><?php echo $linha_carro['PLACA']; ?></option>
        <?php } ?>
    </select><br><br>

    <input type="submit" value="Adicionar Manutenção">
</form>

<a href="manutencao.php">Voltar para a lista de manutenções</a>

<?php
} 
// Editar Manutenção
elseif ($operacao == 'editar') {
    $id_manutencao = $_GET['id'];
    // Consultar a manutenção existente
    $sql = "SELECT * FROM MANUTENCAO WHERE ID_MANUTENCAO = $id_manutencao";
    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {
        $manutencao = $resultado->fetch_assoc();
        $sql_carros = "SELECT * FROM CARRO";
        $result_carros = $conexao->query($sql_carros);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recebendo os dados do formulário
            $tipo = $_POST['tipo'];
            $custo = $_POST['custo'];
            $data_manutencao = $_POST['data_manutencao'];
            $id_carro = $_POST['id_carro'];

            // Atualizar os dados no banco
            $sql_update = "UPDATE MANUTENCAO SET 
                            TIPO = '$tipo', 
                            CUSTO = '$custo', 
                            DATA_MANUTENCAO = '$data_manutencao', 
                            ID_CARRO = $id_carro 
                            WHERE ID_MANUTENCAO = $id_manutencao";

            if ($conexao->query($sql_update) === TRUE) {
                echo "Manutenção atualizada com sucesso!";
            } else {
                echo "Erro ao atualizar manutenção: " . $conexao->error;
            }
        }
    } else {
        echo "Manutenção não encontrada!";
    }
?>

<h2>Editar Manutenção</h2>
<form method="POST" action="manutencao.php?operacao=editar&id=<?php echo $id_manutencao; ?>">
    <label for="tipo">Tipo de Manutenção:</label><br>
    <input type="text" id="tipo" name="tipo" value="<?php echo $manutencao['TIPO']; ?>" required><br><br>

    <label for="custo">Custo:</label><br>
    <input type="number" id="custo" name="custo" value="<?php echo $manutencao['CUSTO']; ?>" step="0.01" required><br><br>

    <label for="data_manutencao">Data da Manutenção:</label><br>
    <input type="date" id="data_manutencao" name="data_manutencao" value="<?php echo $manutencao['DATA_MANUTENCAO']; ?>" required><br><br>

    <label for="id_carro">Carro:</label><br>
    <select id="id_carro" name="id_carro" required>
        <?php while ($linha_carro = $result_carros->fetch_assoc()) { ?>
            <option value="<?php echo $linha_carro['ID_CARRO']; ?>" <?php echo ($linha_carro['ID_CARRO'] == $manutencao['ID_CARRO']) ? 'selected' : ''; ?>><?php echo $linha_carro['PLACA']; ?></option>
        <?php } ?>
    </select><br><br>

    <input type="submit" value="Atualizar Manutenção">
</form>

<a href="manutencao.php">Voltar para a lista de manutenções</a>

<?php
} 
// Excluir Manutenção
elseif ($operacao == 'excluir') {
    $id_manutencao = $_GET['id'];
    $sql_delete = "DELETE FROM MANUTENCAO WHERE ID_MANUTENCAO = $id_manutencao";

    if ($conexao->query($sql_delete) === TRUE) {
        echo "Manutenção excluída com sucesso!";
    } else {
        echo "Erro ao excluir manutenção: " . $conexao->error;
    }
    echo "<br><a href='manutencao.php'>Voltar para a lista de manutenções</a>";
} 
// Exibir lista de manutenções
else {
    $manutencao_list = listarManutencao($conexao);
?>

<h2>Lista de Manutenções</h2>
<a href="manutencao.php?operacao=adicionar">Adicionar Nova Manutenção</a><br><br>

<table border="1">
    <thead>
        <tr>
            <th>Tipo</th>
            <th>Custo</th>
            <th>Data da Manutenção</th>
            <th>Carro</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($linha = $manutencao_list->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $linha['TIPO']; ?></td>
                <td><?php echo $linha['CUSTO']; ?></td>
                <td><?php echo $linha['DATA_MANUTENCAO']; ?></td>
                <td><?php echo $linha['PLACA']; ?></td>
                <td>
                    <a href="manutencao.php?operacao=editar&id=<?php echo $linha['ID_MANUTENCAO']; ?>">Editar</a> | 
                    <a href="manutencao.php?operacao=excluir&id=<?php echo $linha['ID_MANUTENCAO']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<a href="index.php">Voltar para Menu Principal</a>
<?php
}
?>
