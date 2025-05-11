# 🐝 Bee-byte: Monitoramento Inteligente de Colmeias

Bee-byte é um sistema inovador de monitoramento remoto de colmeias, integrando tecnologias como **IoT (Internet das Coisas)** e **Inteligência Artificial (IA)**. Seu objetivo é apoiar a apicultura de precisão, melhorando a saúde e produtividade das colmeias por meio de análises automatizadas e insights inteligentes.

---

## 🌟 Destaques do Projeto

- 🐝 **Monitoramento não-invasivo**: coleta de dados essenciais com mínimo impacto nas abelhas.
- 🤖 **Análise inteligente**: insights automáticos gerados por IA (Gemini - Google).
- 🎨 **Interface Intuitiva**: gráficos atualizados em tempo real em uma interface web amigável.
- 📦 **Banco de Dados MySQL**: armazenamento robusto e gerenciamento eficaz dos dados coletados.
- 🚀 **Escalabilidade**: fácil expansão em ambientes reais.

---

## 📋 Funcionalidades

- ✅ **Monitoramento contínuo**: temperatura, umidade e peso das colmeias.
- 📡 **Envio automático**: dados coletados diretamente para o banco de dados MySQL.
- 📊 **Visualização gráfica em tempo real**.
- 🔍 **Análise preditiva**: insights e sugestões de manejo geradas pela IA Gemini.

---

## 🛠️ Tecnologias Utilizadas

![Arduino](https://img.shields.io/badge/-Arduino-00979D?style=for-the-badge&logo=arduino&logoColor=white)
![MySQL](https://img.shields.io/badge/-MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/-PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Google Gemini](https://img.shields.io/badge/-Google%20Gemini-4285F4?style=for-the-badge&logo=google&logoColor=white)
![HTML5](https://img.shields.io/badge/-HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/-CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![Chart.js](https://img.shields.io/badge/-Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white)

---

## 🔗 Fluxo do Projeto

1. 🛰️ Sensores coletam dados ambientais.
2. 💾 Arduino envia dados diretamente para MySQL.
3. 🌐 Interface web exibe os dados em tempo real.
4. 🖱️ Usuário solicita análise da IA.
5. 💡 IA gera insights e recomendações práticas.

---

## 🚀 Como Usar

### 🖥️ Clone o repositório:
```bash
git clone https://github.com/diogenessouza/bee-byte.git
```

### 📍 Configure o Wi-Fi (arquivo `arduino_secrets.h`):
```cpp
#define SECRET_SSID "Sua rede Wi-Fi"
#define SECRET_PASS "Sua senha Wi-Fi"
```

### 🗄️ Configure o Banco de Dados (`get_data.php`, `seu_script.php`):
```php
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "seu_banco";
```

### ⚡ Faça upload do código no Arduino.

### 🌍 Abra `index.html` para visualizar e interagir.

---

## 📷 Prévia do Projeto

!(/Protótipo/Esquema/esquema_Bee-byte.png)

---

## 🎓 Contexto Acadêmico

O Bee-byte foi apresentado na **Mostra Nacional de Robótica 2024**, destacando-se como um projeto inovador em apicultura de precisão, robótica e inteligência artificial.

📄 [Artigo Completo](/Artigo/ARTIGO.pdf)

---

## 📚 Referências

- 🌐 [Gemini AI - Google](https://deepmind.google/gemini/)
- 🎛️ [Arduino Uno R4 Wi-Fi](https://docs.arduino.cc/hardware/uno-r4-wifi)

---

## 🙌 Agradecimentos

Agradecemos à equipe organizadora da Mostra Nacional de Robótica pela oportunidade, bem como todos os colaboradores e entusiastas que apoiaram este projeto.

---

💡 **Sugestões e contribuições são bem-vindas!** 📧 [diogenes@diocesanocaruaru.g12.br](mailto:diogenes@diocesanocaruaru.g12.br).
