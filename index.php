<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Veículos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: linear-gradient(135deg, rgb(173, 167, 167),rgba(176, 243, 88, 0.78));
            color:rgb(0, 0, 0);
            text-align: center;
        }

        .header {
            background: #BBFF63;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #036310;
        }

        .header a {
            background: #036310;
            color: rgb(255, 255, 255);
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            background: #F3F3F3;
            border-radius: 12px;
            padding: 20px;
            margin: 20px auto;
            max-width: 900px;
        }

        .menu {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .menu a {
            text-decoration: none;
            color: #000000;
            font-weight: bold;
            padding: 15px;
            background: #BBFF63;
            border-radius: 8px;
        }

        .menu a:hover {
            background:rgb(0, 85, 5);
            color: #FFFFFF;
        }

        .fleet img {
            width: 100%;
            max-width: 800px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .fleet a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #BBFF63;
            color: #020202;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background: #000000;
            color: #BBFF63;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LOCADORA</h1>
        <a href="filiais.php">Nossas Filiais</a>
    </div>

    <div class="container">
        <div class="menu">
            <a href="aluguel.php">Gerenciar Aluguéis</a>
            <a href="manutencao.php">Gerenciar Manutenções</a>
            <a href="clientes.php">Gerenciar Clientes</a>
            <a href="funcionarios.php">Gerenciar Funcionários</a>
        </div>
        </div>

    <div class="container">
        <div class="fleet">
            <h2>NOSSA FROTA DE CARROS</h2>
            <a href="https://imgur.com/befKLPm"><img src="https://i.imgur.com/befKLPm.png" title="source: imgur.com" /></a>
            <a href="carros.php">Ver Mais</a>
        </div>
    </div>

    <div class="footer">
        <p>Locadora de Veículos</p>
    </div>
</body>
</html>
