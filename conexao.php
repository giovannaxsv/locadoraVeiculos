<?php
$host = "database-1.cpe0myk02du2.sa-east-1.rds.amazonaws.com"; // Substituir pelo endpoint do AWS RDS
$usuario = "admin"; // Usuário do banco
$senha = "C2oBktoexfOPyuh1N7co"; // Senha do banco
$banco = "locadora"; // Nome do banco de dados
$porta = 3306; // Porta padrão do MySQL na AWS

$conexao = new mysqli($host, $usuario, $senha, $banco, $porta);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
} 

?>
