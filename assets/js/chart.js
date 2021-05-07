if(financeInfo) {
    const ctx = document.getElementById('chart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Dólar',
                data: financeInfo,
                backgroundColor: [
                    'rgba(0, 136, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(0, 136, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const data = context.dataset.data[context.dataIndex];
                            const dollar = (+(data.dollar)).toLocaleString("pt-br", {style: "currency", currency: "BRL"});
                            const dollarPercentage = (+(data.dollarPercentage)).toLocaleString("pt-br", {style: "currency", currency: "BRL"});
                            return `${dollar} (${dollarPercentage}%)`;
                        }
                    }
                }
            },
            parsing: {
                xAxisKey: "date",
                yAxisKey: "dollar"
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
}
