$(document).ready(function () {
    
    $.ajax({
        url: CONEXAO + "/energia/public_html/php/data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            //alert('alerta');
            var label = [];
            var dado = [];
            var total=0;
            for (var i in data) {
                label.push(data[i].diaMes);
                dado.push(data[i].preco);
            var preco=parseFloat(data[i].preco)
            }
            total=total+preco;
            var config = {
                type: "bar",
                data: {
                    labels: label,
                    datasets: [{
                            label: 'Total gasto entre dia'+data[1].diaMes+' até '+data.diaMes[2]+': '+total.toFixed(2)+'R$',
                            backgroundColor: 'rgba(11,98,165,0.50)',
                            borderColor: 'rgba(11,98,165,1)',
                            hoverBackgroundColor: 'rgba(11,98,165,1)',
                            hoverBorderColor: 'rgba(11,98,165,1)',
                            data: dado
                        }]
                },
                options: {
                    responsive: true,
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
                                    labelString: 'Preco em reais (R$)'
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
