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
            echo "Filial adicionada com sucesso!";
        } else {
            echo "Erro ao adicionar filial: " . $conexao->error;
        }
    }
?>

<h2>Adicionar Filial</h2>
<form method="POST" action="filiais.php?operacao=adicionar">
    <label for="nome">Nome da Filial:</label><br>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="endereco">Endereço:</label><br>
    <input type="text" id="endereco" name="endereco" required><br><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" id="telefone" name="telefone" required><br><br>

    <input type="submit" value="Adicionar Filial">
</form>

<a href="filiais.php">Voltar para a lista de filiais</a>

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
                echo "Filial atualizada com sucesso!";
            } else {
                echo "Erro ao atualizar filial: " . $conexao->error;
            }
        }
    } else {
        echo "Filial não encontrada!";
    }
?>

<h2>Editar Filial</h2>
<form method="POST" action="filiais.php?operacao=editar&id=<?php echo $id_filial; ?>">
    <label for="nome">Nome da Filial:</label><br>
    <input type="text" id="nome" name="nome" value="<?php echo $filial['NOME']; ?>" required><br><br>

    <label for="endereco">Endereço:</label><br>
    <input type="text" id="endereco" name="endereco" value="<?php echo $filial['ENDERECO']; ?>" required><br><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" id="telefone" name="telefone" value="<?php echo $filial['TELEFONE']; ?>" required><br><br>

    <input type="submit" value="Atualizar Filial">
</form>

<a href="filiais.php">Voltar para a lista de filiais</a>

<?php
} 
// Excluir Filial
elseif ($operacao == 'excluir') {
    $id_filial = $_GET['id'];
    $sql_delete = "DELETE FROM FILIAL WHERE ID_FILIAL = $id_filial";

    if ($conexao->query($sql_delete) === TRUE) {
        echo "Filial excluída com sucesso!";
    } else {
        echo "Erro ao excluir filial: " . $conexao->error;
    }
    echo "<br><a href='filiais.php'>Voltar para a lista de filiais</a>";
} 
// Exibir lista de filiais
else {
    $filiais_list = listarFiliais($conexao);
?>

<h2>Lista de Filiais</h2>
<a href="filiais.php?operacao=adicionar">Adicionar Nova Filial</a><br><br>

<table border="1">
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

<?php
}
?>
