<?php
include "conexao.php"; // Conectar ao banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o carro pelo ID
    $sql = "SELECT * FROM CARRO WHERE ID_CARRO = $id";
    $resultado = $conexao->query($sql);
    $carro = $resultado->fetch_assoc();

    if (!$carro) {
        die("Carro não encontrado.");
    }
} else {
    die("ID não especificado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $categoria = $_POST['categoria'];
    $id_filial = $_POST['id_filial'];

    // Atualizar o carro
    $sql = "UPDATE CARRO SET PLACA = '$placa', MARCA = '$marca', MODELO = '$modelo', ANO = $ano, COR = '$cor', 
            CATEGORIA = '$categoria', ID_FILIAL = $id_filial WHERE ID_CARRO = $id";
    
    if ($conexao->query($sql) === TRUE) {
        echo "<p>Carro atualizado com sucesso!</p>";
    } else {
        echo "<p>Erro ao atualizar carro: " . $conexao->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>
</head>
<body>
    <h1>Editar Carro</h1>
    <form action="editar_carro.php?id=<?php echo $id; ?>" method="POST">
        <label for="placa">Placa:</label><br>
        <input type="text" name="placa" value="<?php echo $carro['PLACA']; ?>" required><br><br>
        
        <label for="marca">Marca:</label><br>
        <input type="text" name="marca" value="<?php echo $carro['MARCA']; ?>" required><br><br>
        
        <label for="modelo">Modelo:</label><br>
        <input type="text" name="modelo" value="<?php echo $carro['MODELO']; ?>" required><br><br>
        
        <label for="ano">Ano:</label><br>
        <input type="number" name="ano" value="<?php echo $carro['ANO']; ?>" required><br><br>
        
        <label for="cor">Cor:</label><br>
        <input type="text" name="cor" value="<?php echo $carro['COR']; ?>"><br><br>
        
        <label for="categoria">Categoria:</label><br>
        <input type="text" name="categoria" value="<?php echo $carro['CATEGORIA']; ?>"><br><br>
        
        <label for="id_filial">Filial (ID):</label><br>
        <input type="number" name="id_filial" value="<?php echo $carro['ID_FILIAL']; ?>" required><br><br>

        <input type="submit" value="Atualizar Carro">
    </form>
    <a href="carros.php">Voltar para a lista de carros</a>
</body>
</html>
