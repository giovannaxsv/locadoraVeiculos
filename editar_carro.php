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
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1A1A24, #000000);
            color: #F3F3F3;
            padding: 20px;
            margin: 0;
        }
        h1 {
            color: #BBFF63;
            text-align: center;
        }
        form {
            background: #020202;
            padding: 20px;
            border-radius: 15px;
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #BBFF63;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #BBFF63;
            background: #1A1A24;
            color: #F3F3F3;
            font-size: 16px;
        }
        input[type="submit"] {
            background: #BBFF63;
            color: #020202;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        input[type="submit"]:hover {
            background: #9BCC50;
        }
        a {
            display: block;
            text-align: center;
            color: #BBFF63;
            text-decoration: none;
            margin-top: 20px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .image-upload {
            margin-bottom: 15px;
        }
        .image-upload img {
            max-width: 100%;
            border-radius: 8px;
            border: 1px solid #BBFF63;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Editar Carro</h1>
    <form action="editar_carro.php?id=<?php echo $id; ?>" method="POST">
       
        
        <label for="placa">Placa:</label>
        <input type="text" name="placa" value="<?php echo $carro['PLACA']; ?>" required>
        
        <label for="marca">Marca:</label>
        <input type="text" name="marca" value="<?php echo $carro['MARCA']; ?>" required>
        
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" value="<?php echo $carro['MODELO']; ?>" required>
        
        <label for="ano">Ano:</label>
        <input type="number" name="ano" value="<?php echo $carro['ANO']; ?>" required>
        
        <label for="cor">Cor:</label>
        <input type="text" name="cor" value="<?php echo $carro['COR']; ?>">
        
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" value="<?php echo $carro['CATEGORIA']; ?>">
        
        <label for="id_filial">Filial (ID):</label>
        <input type="number" name="id_filial" value="<?php echo $carro['ID_FILIAL']; ?>" required>

        <input type="submit" value="Atualizar Carro">
    </form>
    <a href="carros.php">Voltar para a lista de carros</a>
</body>
</html>