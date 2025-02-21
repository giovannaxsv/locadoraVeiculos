<?php
include "conexao.php";  // Conexão com o banco de dados

// Função para listar as filiais
function listarFiliais($conexao) {
    $sql = "SELECT * FROM FILIAL";
    return $conexao->query($sql);
}

// Verificar a operação (Adicionar, Editar, Excluir)
$operacao = isset($_GET['operacao']) ? $_GET['operacao'] : '';

// Adicionar Filial
if ($operacao == 'adicionar') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recebendo os dados do formulário
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];

        // Inserir dados no banco
        $sql = "INSERT INTO FILIAL (NOME, ENDERECO, TELEFONE) 
                VALUES ('$nome', '$endereco', '$telefone')";

        if ($conexao->query($sql) === TRUE) {
            echo "<p class='success-message'>Filial adicionada com sucesso!</p>";
        } else {
            echo "<p class='error-message'>Erro ao adicionar filial: " . $conexao->error . "</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Filial</title>
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
        <h2>Adicionar Filial</h2>
        <form method="POST" action="filiais.php?operacao=adicionar">
            <label for="nome">Nome da Filial:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required>

            <input type="submit" value="Adicionar Filial">
        </form>
        <a href="filiais.php">Voltar para a lista de filiais</a>
    </div>
</body>
</html>

<?php
} 
// Editar Filial
elseif ($operacao == 'editar') {
    $id_filial = $_GET['id'];
    // Consultar a filial existente
    $sql = "SELECT * FROM FILIAL WHERE ID_FILIAL = $id_filial";
    $resultado = $conexao->query($sql);
    if ($resultado->num_rows > 0) {
        $filial = $resultado->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recebendo os dados do formulário
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];

            // Atualizar os dados no banco
            $sql_update = "UPDATE FILIAL SET 
                            NOME = '$nome', 
                            ENDERECO = '$endereco', 
                            TELEFONE = '$telefone' 
                            WHERE ID_FILIAL = $id_filial";

            if ($conexao->query($sql_update) === TRUE) {
                echo "<p class='success-message'>Filial atualizada com sucesso!</p>";
            } else {
                echo "<p class='error-message'>Erro ao atualizar filial: " . $conexao->error . "</p>";
            }
        }
    } else {
        echo "<p class='error-message'>Filial não encontrada!</p>";
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filial</title>
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
        <h2>Editar Filial</h2>
        <form method="POST" action="filiais.php?operacao=editar&id=<?php echo $id_filial; ?>">
            <label for="nome">Nome da Filial:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $filial['NOME']; ?>" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?php echo $filial['ENDERECO']; ?>" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?php echo $filial['TELEFONE']; ?>" required>

            <input type="submit" value="Atualizar Filial">
        </form>
        <a href="filiais.php">Voltar para a lista de filiais</a>
    </div>
</body>
</html>

<?php
} 
// Excluir Filial
elseif ($operacao == 'excluir') {
    $id_filial = $_GET['id'];
    $sql_delete = "DELETE FROM FILIAL WHERE ID_FILIAL = $id_filial";

    if ($conexao->query($sql_delete) === TRUE) {
        echo "<p class='success-message'>Filial excluída com sucesso!</p>";
    } else {
        echo "<p class='error-message'>Erro ao excluir filial: " . $conexao->error . "</p>";
    }
    echo "<br><a href='filiais.php'>Voltar para a lista de filiais</a>";
} 
// Exibir lista de filiais
else {
    $filiais_list = listarFiliais($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Filiais</title>
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
        <h2>Lista de Filiais</h2>
        <a href="filiais.php?operacao=adicionar" class="add-button">Adicionar Nova Filial</a>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = $filiais_list->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $linha['NOME']; ?></td>
                        <td><?php echo $linha['ENDERECO']; ?></td>
                        <td><?php echo $linha['TELEFONE']; ?></td>
                        <td>
                            <a href="filiais.php?operacao=editar&id=<?php echo $linha['ID_FILIAL']; ?>">Editar</a> | 
                            <a href="filiais.php?operacao=excluir&id=<?php echo $linha['ID_FILIAL']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
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