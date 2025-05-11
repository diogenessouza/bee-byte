<?php
header('Content-Type: application/json');

$servername = "";
$username = "";
$password = "";
$dbname = "";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die(json_encode(['error' => 'Falha na conexão']));
}

// Busca os últimos 20 registros
$sql = "SELECT temperatura, umidade, peso_colmeia, data_registro 
        FROM bee_data 
        ORDER BY data_registro DESC 
        LIMIT 20";

$result = $conn->query($sql);

$data = [
    'timestamps' => [],
    'temperature' => [],
    'humidity' => [],
    'weight' => []
];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data['timestamps'][] = date('H:i:s', strtotime($row['data_registro']));
        $data['temperature'][] = floatval($row['temperatura']);
        $data['humidity'][] = floatval($row['umidade']);
        $data['weight'][] = floatval($row['peso_colmeia']);
    }

    // Inverter arrays para ordem cronológica
    $data['timestamps'] = array_reverse($data['timestamps']);
    $data['temperature'] = array_reverse($data['temperature']);
    $data['humidity'] = array_reverse($data['humidity']);
    $data['weight'] = array_reverse($data['weight']);
}

echo json_encode($data);

$conn->close();
?>