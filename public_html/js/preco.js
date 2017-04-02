$(document).ready(function () {
    $.ajax({
        url: CONEXAO + "/energia/public_html/php/data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var preco=0;
            var label = [];
            var dado = [];
            for (var i in data) {
                label.push(data[i].diaMes);
                dado.push(data[i].preco);
                preco=(preco) + parseFloat(data[i].preco);
            }

            var config = { 
                type: "bar",
                data: {
                    labels: label,
                    datasets: [{
                            label: 'Total gasto por dia: aaaR$',
                            backgroundColor: 'rgba(11,98,165,0.50)',
                            borderColor: 'rgba(11,98,165,1)',
                            hoverBackgroundColor: 'rgba(11,98,165,1)',
                            hoverBorderColor: 'rgba(11,98,165,1)',
                            data: dado
                        }]
                },
                options: {
                    responsive: true,
                    legend:{
                        position:'top',
                    },
                    tittle:{
                      display:true,
                      text: 'Total gasto entre dia' + data[1].diaMes + ' e ' + data[data.length - 1].diaMes + ': ' + preco.toFixed(2) + 'R$',
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
