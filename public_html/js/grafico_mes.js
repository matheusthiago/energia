$(document).ready(function () {
    $.ajax({
        url: CONEXAO + "/energia/public_html/php/data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var preco = 0;
            var label = [];
            var dado = [];
            for (var i in data) {
                label.push(data[i].diaMes);
                dado.push(data[i].preco);
                preco = (preco) + parseFloat(data[i].preco);
            }

            var config = {
                type: "bar",
                data: {
                    labels: label,
                    datasets: [{
                            backgroundColor: 'rgba(91, 184, 93, 0.75)',
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(91, 184, 93, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: dado
                        }]
                },

                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Total gasto entre ' + data[0].diaMes+' e '+data[data.length-1].diaMes+': R$' + preco.toFixed(2),
                    },

                    tooltips: {
                        mode: 'label',
                        callbacks: {
                            title: function () {
                                return config.data.datasets.label;
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Dia/Mês'
                                }

                            }],
                        yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Preço em reais (R$)'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }

            };

            var ctx = $("#canvasChartPreco");
            new Chart(ctx, config);
        },
        error: function (data) {
            console.log(data);
        }
    });
});
