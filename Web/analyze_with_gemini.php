<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Chave da API do Gemini (substitua pela sua)
$GEMINI_API_KEY = '';

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die(json_encode(['error' => 'Falha na conexão com o banco']));
}

// Busca todos os registros
$sql = "SELECT temperatura, umidade, peso_colmeia, data_registro 
        FROM bee_data 
        ORDER BY data_registro";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die(json_encode(['error' => 'Sem dados para análise']));
}

// Prepara os dados para envio
$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

// Prepara a requisição para a API do Gemini
$prompt = 
"Atue como um assistente de apicultor. Você deve analisar os dados coletados automaticamente de uma colmeia de abelhas melíferas e oferecer insights e dicas relevantes sobre os dados e o estado de saúde da colmeia." .
"\nOs dados são: " . json_encode($data) ;

$postData = [
    'contents' => [
        ['role' => 'user', 'parts' => [['text' => $prompt]]]
    ]
];

$ch = curl_init("https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key={$GEMINI_API_KEY}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

if ($err) {
    die(json_encode(['error' => 'Erro na comunicação com a API']));
}

$responseData = json_decode($response, true);

// Extrai a análise da resposta do Gemini
$analysis = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Análise não disponível';

// Remove asteriscos e ajusta formatação
$analysis = preg_replace('/\*+/', '', $analysis);
$analysis = nl2br($analysis);

echo json_encode(['analysis' => $analysis]);
?>