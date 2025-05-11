# 🐝 Bee-byte: Monitoramento Inteligente de Colmeias

Bee-byte é um sistema inovador de monitoramento remoto de colmeias, integrando tecnologias como **IoT (Internet das Coisas)** e **Inteligência Artificial (IA)**. Seu objetivo é apoiar a apicultura de precisão, melhorando a saúde e produtividade das colmeias por meio de análises automatizadas e insights inteligentes.

---

## 🌟 Destaques do Projeto

- **Monitoramento não-invasivo**: coleta de dados essenciais com mínimo impacto nas abelhas.
- **Análise inteligente**: insights automáticos gerados por IA (Gemini - Google).
- **Acessibilidade**: interface web intuitiva com gráficos atualizados em tempo real.
- **Armazenamento robusto**: utiliza banco de dados MySQL para gestão eficaz dos dados coletados.
- **Escalabilidade**: projeto desenvolvido para fácil expansão em ambientes reais.

---

## 📋 Funcionalidades

- ✅ **Monitoramento contínuo** de temperatura, umidade e peso das colmeias.
- 📡 **Envio automático** dos dados coletados para armazenamento no banco de dados MySQL.
- 📊 **Visualização gráfica** em tempo real dos dados coletados.
- 🤖 **Análise preditiva e sugestões de manejo** geradas pela IA Gemini.

---

## ⚙️ Tecnologias Utilizadas

**Hardware:**
- Arduino Uno R4 Wi-Fi
- Sensor DHT22 (temperatura e umidade)
- Célula de carga com módulo HX711 (peso)
- Protótipo impresso em 3D

**Software e Serviços:**
- Arduino IDE (C/C++)
- MySQL (armazenamento de dados)
- PHP (backend)
- Google Gemini API (IA generativa)
- HTML, CSS, JavaScript (Chart.js, Axios)

---

## 🔗 Como Funciona?

1. Sensores instalados na colmeia coletam dados ambientais.
2. Arduino envia esses dados diretamente para o banco de dados MySQL.
3. Dados são exibidos em tempo real em uma interface web.
4. Usuário pode solicitar análise automatizada dos dados pela IA.
5. IA gera insights e recomendações práticas para o manejo das colmeias.

---

## 🚀 Como Usar o Projeto

1. Clone este repositório.

```bash
git clone https://github.com/diogenessouza/bee-byte.git
```

2. Instale as dependências necessárias.

3. Configure suas credenciais no arquivo `arduino_secrets.h`:

```cpp
#define SECRET_SSID "Sua rede Wi-Fi"
#define SECRET_PASS "Sua senha Wi-Fi"
```

4. Configure as credenciais do banco de dados no arquivo `get_data.php` e `seu_script.php`:

```php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco";
```

5. Faça o upload do código no Arduino utilizando a IDE Arduino.

6. Acesse a página web `index.html` no navegador para visualizar os dados e interagir com a análise via IA.

---

## 📷 Prévia do Projeto

![Interface Web](esquema_Bee-byte.png)

---

## 🎓 Contexto Acadêmico

O Bee-byte foi desenvolvido e apresentado na **Mostra Nacional de Robótica 2024**, destacando-se como um projeto promissor na área de apicultura de precisão, robótica e inteligência artificial.

Para detalhes adicionais, consulte o [artigo completo](ARTIGO.pdf) e o [pôster de apresentação](Pôster.pdf).

---

## 📚 Referências

- [Gemini AI - Google](https://deepmind.google/gemini/)
- [Arduino Uno R4 Wi-Fi](https://docs.arduino.cc/hardware/uno-r4-wifi)

---

## 🙌 Agradecimentos

Agradecemos à equipe organizadora da Mostra Nacional de Robótica pela oportunidade de apresentar este projeto, além de todos os colaboradores e entusiastas que nos apoiaram.

---

💡 **Sugestões e contribuições são muito bem-vindas!** Entre em contato pelo e-mail: [diogenes@diocesanocaruaru.g12.br](mailto:diogenes@diocesanocaruaru.g12.br).
