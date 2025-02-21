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
            echo "<p class='success-message'>Manutenção adicionada com sucesso!</p>";
        } else {
            echo "<p class='error-message'>Erro ao adicionar manutenção: " . $conexao->error . "</p>";
        }
    }
    // Buscar carros disponíveis para manutenção
    $sql_carros = "SELECT * FROM CARRO";
    $result_carros = $conexao->query($sql_carros);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Manutenção</title>
    <style>
        body {
            background: linear-gradient(135deg, #1A1A24, #020202);
            color: #F3F3F3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #1A1A24;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        h2 {
            color: #BBFF63;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #F3F3F3;
        }
        input, select {
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
        .success-message {
            color: #BBFF63;
            text-align: center;
        }
        .error-message {
            color: #FF5555;
            text-align: center;
        }
        a {
            color: #BBFF63;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Adicionar Manutenção</h2>
        <form method="POST" action="manutencao.php?operacao=adicionar">
            <label for="tipo">Tipo de Manutenção:</label>
            <input type="text" id="tipo" name="tipo" required>

            <label for="custo">Custo:</label>
            <input type="number" id="custo" name="custo" step="0.01" required>

            <label for="data_manutencao">Data da Manutenção:</label>
            <input type="date" id="data_manutencao" name="data_manutencao" required>

            <label for="id_carro">Carro:</label>
            <select id="id_carro" name="id_carro" required>
                <?php while ($linha_carro = $result_carros->fetch_assoc()) { ?>
                    <option value="<?php echo $linha_carro['ID_CARRO']; ?>"><?php echo $linha_carro['PLACA']; ?></option>
                <?php } ?>
            </select>

            <input type="submit" value="Adicionar Manutenção">
        </form>
        <a href="manutencao.php">Voltar para a lista de manutenções</a>
    </div>
</body>
</html>

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
                echo "<p class='success-message'>Manutenção atualizada com sucesso!</p>";
            } else {
                echo "<p class='error-message'>Erro ao atualizar manutenção: " . $conexao->error . "</p>";
            }
        }
    } else {
        echo "<p class='error-message'>Manutenção não encontrada!</p>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Manutenção</title>
    <style>
        body {
            background: linear-gradient(135deg, #1A1A24, #020202);
            color: #F3F3F3;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #1A1A24;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }
        h2 {
            color: #BBFF63;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #F3F3F3;
        }
        input, select {
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
        .success-message {
            color: #BBFF63;
            text-align: center;
        }
        .error-message {
            color: #FF5555;
            text-align: center;
        }
        a {
            color: #BBFF63;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Manutenção</h2>
        <form method="POST" action="manutencao.php?operacao=editar&id=<?php echo $id_manutencao; ?>">
            <label for="tipo">Tipo de Manutenção:</label>
            <input type="text" id="tipo" name="tipo" value="<?php echo $manutencao['TIPO']; ?>" required>

            <label for="custo">Custo:</label>
            <input type="number" id="custo" name="custo" value="<?php echo $manutencao['CUSTO']; ?>" step="0.01" required>

            <label for="data_manutencao">Data da Manutenção:</label>
            <input type="date" id="data_manutencao" name="data_manutencao" value="<?php echo $manutencao['DATA_MANUTENCAO']; ?>" required>

            <label for="id_carro">Carro:</label>
            <select id="id_carro" name="id_carro" required>
                <?php while ($linha_carro = $result_carros->fetch_assoc()) { ?>
                    <option value="<?php echo $linha_carro['ID_CARRO']; ?>" <?php echo ($linha_carro['ID_CARRO'] == $manutencao['ID_CARRO']) ? 'selected' : ''; ?>><?php echo $linha_carro['PLACA']; ?></option>
                <?php } ?>
            </select>

            <input type="submit" value="Atualizar Manutenção">
        </form>
        <a href="manutencao.php">Voltar para a lista de manutenções</a>
    </div>
</body>
</html>

<?php
} 
// Excluir Manutenção
elseif ($operacao == 'excluir') {
    $id_manutencao = $_GET['id'];
    $sql_delete = "DELETE FROM MANUTENCAO WHERE ID_MANUTENCAO = $id_manutencao";

    if ($conexao->query($sql_delete) === TRUE) {
        echo "<p class='success-message'>Manutenção excluída com sucesso!</p>";
    } else {
        echo "<p class='error-message'>Erro ao excluir manutenção: " . $conexao->error . "</p>";
    }
    echo "<br><a href='manutencao.php'>Voltar para a lista de manutenções</a>";
} 
// Exibir lista de manutenções
else {
    $manutencao_list = listarManutencao($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Manutenções</title>
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
        h2 {
            color: #BBFF63;
            text-align: center;
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
        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .add-button {
            display: inline-block;
            padding: 10px 20px;
            background: #BBFF63;
            color: #020202;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }
        .add-button:hover {
            background: #99CC55;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Manutenções</h2>
        <a href="manutencao.php?operacao=adicionar" class="add-button">Adicionar Nova Manutenção</a>
        <table>
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
                        <td class="actions">
                            <a href="manutencao.php?operacao=editar&id=<?php echo $linha['ID_MANUTENCAO']; ?>">Editar</a>
                            <a href="manutencao.php?operacao=excluir&id=<?php echo $linha['ID_MANUTENCAO']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.php">Voltar para Menu Principal</a>
    </div>
</body>
</html>
<?php
}
?>