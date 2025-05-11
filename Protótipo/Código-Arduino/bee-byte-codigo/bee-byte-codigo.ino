// Inclusão das bibliotecas usa das no projeto
#include <WiFiS3.h>
#include <WiFiSSLClient.h>
#include <WiFiClient.h>
#include <IPAddress.h>
#include <HX711.h>
#include <DHT.h>
#include <DHT_U.h>

#include "arduino_secrets.h"

#define pinDT 6        // define o pino de dados do módulo HX711 - sensor de carga
#define pinSCK 7       // define a porta serial de tempo do módulo HX711
#define DHTPIN 4       // Pino ao qual o DHT22 está conectado
#define DHTTYPE DHT22  // Definindo o tipo de sensor

DHT dht(DHTPIN, DHTTYPE);

#define pesoMin 0.010
#define pesoMax 20.0
#define escala -140880.0f

// Detalhes da rede WiFi
const char* ssid = SECRET_SSID;
;
const char* password = SECRET_PASS;
;

// Servidor e URL do script PHP
const char* host = "bee-byte.com";
const int httpsPort = 443;
const char* serverPath = "/seu_script.php";  // Substitua pelo caminho real do script PHP

float medida = 0;

WiFiSSLClient client;

HX711 scale;

void setup() {
  Serial.begin(9600);
  while (!Serial)
    ;

  // Inicializa o sensor DHT
  dht.begin();
  scale.begin(pinDT, pinSCK);
  scale.set_scale(escala);  // configura o valor obtido na calibração
  scale.tare();             //tara a balança
  delay(2000);

  // Conectando ao WiFi
  Serial.print("Conectando-se a ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi conectado.");
  Serial.println("Endereço IP: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  // Coleta os dados do sensor
  float temperatura = dht.readTemperature();
  float umidade = dht.readHumidity();

  scale.power_up();             // ativa os sensores da balança
  medida = scale.get_units(5);  // obtém a média de 5 pesagens seguidas - valor personalizável
  if (medida <= pesoMin) {      // confere se o peso está abaixo do limite mínimo
    scale.tare();               // tara a balança, caso o peso esteja abaixo do limite mínimo
    medida = 0;
    scale.power_down();  // desativa os sensores da balança

  } else if (medida >= pesoMax) {  // confere se o peso está acima do limite máximo
    scale.tare();                  // tara a balança, caso o peso esteja acima do limite máximo
    medida = 0;
    scale.power_down();  // desativa os sensores da balança
  }
  scale.power_down();  // desativa os sensores da balança

  // Verifica se a leitura foi bem-sucedida
  if (isnan(temperatura) || isnan(umidade)) {
    Serial.println("Falha ao ler do sensor DHT!");
    return;
  }

  // Conecta ao servidor
  if (client.connect(host, httpsPort)) {
    Serial.println("Conectado ao servidor");

    // Cria o caminho da URL com os parâmetros
    String url = String(serverPath) + "?temperatura=" + String(temperatura) + "&umidade=" + String(umidade) + "&peso_colmeia=" + String(medida);

    // Envia a requisição HTTP
    client.println("GET " + url + " HTTP/1.1");
    client.println("Host: " + String(host));
    client.println("Connection: close");
    client.println();

    // Aguarda a resposta do servidor
    while (client.connected()) {
      String line = client.readStringUntil('\n');
      if (line == "\r") {
        break;
      }
    }

    // Lê o corpo da resposta
    String responseBody = client.readString();
    Serial.println("Resposta do servidor:");
    Serial.println(responseBody);
  } else {
    Serial.println("Falha na conexão com o servidor");
  }

  // Fecha a conexão
  client.stop();
  medida = 0;
  // Aguarda 30 segundos antes de nova leitura
  delay(30000);
}