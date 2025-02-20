<?php
include "conexao.php"; // Conectar ao banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];

    // Validação simples (opcional)
    if (!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($email)) {
        // SQL para inserir um novo cliente
        $sql = "INSERT INTO CLIENTE (NOME, CPF, TELEFONE, EMAIL) 
                VALUES ('$nome', '$cpf', '$telefone', '$email')";

        if ($conexao->query($sql) === TRUE) {
            echo "Novo cliente adicionado com sucesso!";
            echo "<br><a href='clientes.php'>Voltar para a lista de clientes</a>";
        } else {
            echo "Erro ao adicionar cliente: " . $conexao->error;
        }
    } else {
        echo "Por favor, preencha todos os campos!";
    }
} else {
    // Formulário para adicionar um novo cliente
    echo "<h2>Adicionar Novo Cliente</h2>";
    echo "<form method='POST' action='adicionar_cliente.php'>
            Nome: <input type='text' name='nome' required><br>
            CPF: <input type='text' name='cpf' required><br>
            Telefone: <input type='text' name='telefone' required><br>
            Email: <input type='email' name='email' required><br>
            <input type='submit' value='Adicionar Cliente'>
          </form>";
}
?>
