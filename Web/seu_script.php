<?php
// Define o timezone do PHP globalmente
date_default_timezone_set('America/Sao_Paulo');

$servername = "";
$username = "";
$password = "";
$dbname = "";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Tenta definir o timezone do MySQL
$conn->query("SET time_zone = '-03:00'");

// Obtém os dados da URL
$temperatura = $_GET['temperatura'];
$umidade = $_GET['umidade'];
$peso_colmeia = $_GET['peso_colmeia']; 

// Usa a função NOW() do MySQL
$sql = "INSERT INTO bee_data (temperatura, umidade, peso_colmeia, data_registro) 
        VALUES (?, ?, ?, NOW())";

// Prepara a declaração
$stmt = $conn->prepare($sql);

// Vincula os parâmetros
$stmt->bind_param("ddd", $temperatura, $umidade, $peso_colmeia);

// Executa a consulta
if ($stmt->execute()) {
    echo "Dados inseridos com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

// Verifica o timezone após a inserção
$tz_check = $conn->query("SELECT NOW() as data_atual")->fetch_assoc();
echo "\nData inserida: " . $tz_check['data_atual'];

// Fecha a declaração e a conexão
$stmt->close();
$conn->close();
?>