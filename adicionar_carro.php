<?php
include "conexao.php"; // Conectar ao banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa = $_POST['placa'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $categoria = $_POST['categoria'];
    $id_filial = $_POST['id_filial'];

    // Inserir o carro no banco de dados
    $sql = "INSERT INTO CARRO (PLACA, MARCA, MODELO, ANO, COR, CATEGORIA, ID_FILIAL) 
            VALUES ('$placa', '$marca', '$modelo', $ano, '$cor', '$categoria', $id_filial)";
    
    if ($conexao->query($sql) === TRUE) {
        echo "<p>Carro cadastrado com sucesso!</p>";
    } else {
        echo "<p>Erro ao cadastrar carro: " . $conexao->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Carro</title>
</head>
<body>
    <h1>Adicionar Carro</h1>
    <form action="adicionar_carro.php" method="POST">
        <label for="placa">Placa:</label><br>
        <input type="text" name="placa" required><br><br>
        
        <label for="marca">Marca:</label><br>
        <input type="text" name="marca" required><br><br>
        
        <label for="modelo">Modelo:</label><br>
        <input type="text" name="modelo" required><br><br>
        
        <label for="ano">Ano:</label><br>
        <input type="number" name="ano" required><br><br>
        
        <label for="cor">Cor:</label><br>
        <input type="text" name="cor"><br><br>
        
        <label for="categoria">Categoria:</label><br>
        <input type="text" name="categoria"><br><br>
        
        <label for="id_filial">Filial (ID):</label><br>
        <input type="number" name="id_filial" required><br><br>

        <input type="submit" value="Cadastrar Carro">
    </form>
    <a href="carros.php">Voltar para a lista de carros</a>
</body>
</html>
