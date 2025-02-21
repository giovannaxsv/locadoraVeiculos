<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Carro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1A1A24, #020202);
            color: #FFFFFF;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: #1A1A24;
            padding: 20px;
            border-radius: 15px;
            width: 90%;
            max-width: 800px;
            margin: auto;
            box-shadow: 0px 0px 15px #000000;
        }
        h1 {
            color: #BBFF63;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            text-align: left;
        }
        input {
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            width: 85%;
            height: 90px;
            background: #BBFF63;
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #99cc52;
        }
        .back-link {
            color: #F3F3F3;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
    <div class="container">
    <a class="back-link" href="carros.php">Voltar para a lista de carros</a>
        <h1>Adicionar Carro</h1>
        <form action="adicionar_carro.php" method="POST" enctype="multipart/form-data">
            <label for="placa"> ㅤㅤㅤㅤPlaca:</label>
            <input type="text" name="placa" required>
            
            <label for="marca"> ㅤㅤㅤㅤMarca:</label>
            <input type="text" name="marca" required>
            
            <label for="modelo"> ㅤㅤㅤㅤModelo:</label>
            <input type="text" name="modelo" required>
            
            <label for="ano"> ㅤㅤㅤㅤAno:</label>
            <input type="number" name="ano" required>
            
            <label for="cor"> ㅤㅤㅤㅤCor:</label>
            <input type="text" name="cor">
            
            <label for="categoria"> ㅤㅤㅤㅤCategoria:</label>
            <input type="text" name="categoria">
            
            <label for="id_filial"> ㅤㅤㅤㅤFilial (ID):</label>
            <input type="number" name="id_filial" required>
            
                    
            <input type="submit" value="Cadastrar Carro">
        </form>
        
    </div>
</body>
</html>
