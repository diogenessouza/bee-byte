document.addEventListener('DOMContentLoaded', () => {
    const chartConfigs = {
        temperature: {
            ctx: document.getElementById('temperatureChart'),
            label: 'Temperatura (°C)',
            borderColor: '#FF6384',
            backgroundColor: 'rgba(255, 99, 132, 0.2)'
        },
        humidity: {
            ctx: document.getElementById('humidityChart'),
            label: 'Umidade (%)',
            borderColor: '#36A2EB',
            backgroundColor: 'rgba(54, 162, 235, 0.2)'
        },
        weight: {
            ctx: document.getElementById('weightChart'),
            label: 'Peso da Colmeia (kg)',
            borderColor: '#4BC0C0',
            backgroundColor: 'rgba(75, 192, 192, 0.2)'
        }
    };

    const charts = {};

    function createCharts(data) {
        Object.keys(chartConfigs).forEach(type => {
            const config = chartConfigs[type];
            charts[type] = new Chart(config.ctx, {
                type: 'line',
                data: {
                    labels: data.timestamps,
                    datasets: [{
                        label: config.label,
                        data: data[type],
                        borderColor: config.borderColor,
                        backgroundColor: config.backgroundColor,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    }

    function updateCharts(data) {
        Object.keys(chartConfigs).forEach(type => {
            charts[type].data.labels = data.timestamps;
            charts[type].data.datasets[0].data = data[type];
            charts[type].update();
        });
    }

    async function fetchData() {
        try {
            const response = await fetch('get_data.php');
            const data = await response.json();
            
            if (!charts.temperature) {
                createCharts(data);
            } else {
                updateCharts(data);
            }
        } catch (error) {
            console.error('Erro ao buscar dados:', error);
        }
    }

    document.getElementById('analyzeWithAI').addEventListener('click', async function() {
        const aiResultDiv = document.getElementById('aiAnalysisResult');
        const analyzeButton = this;

        analyzeButton.disabled = true;
        analyzeButton.innerHTML = '<span class="btn-icon">🤖</span> Analisando...';
        aiResultDiv.innerHTML = '';

        try {
            const response = await axios.get('analyze_with_gemini.php');
            
            aiResultDiv.innerHTML = `
                <div class="ai-analysis">
                    <h4>📊 Análise Inteligente da Colmeia</h4>
                    ${response.data.analysis}
                </div>
            `;
        } catch (error) {
            aiResultDiv.innerHTML = `
                <div class="alert alert-danger">
                    Erro na análise: ${error.response ? error.response.data : error.message}
                </div>
            `;
        } finally {
            analyzeButton.disabled = false;
            analyzeButton.innerHTML = '<span class="btn-icon">🤖</span> Analisar dados com IA';
        }
    });

    fetchData();
    setInterval(fetchData, 40000);
});