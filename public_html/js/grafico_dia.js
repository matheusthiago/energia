$(document).ready(function () {
    $.ajax({
        url: CONEXAO + "/energia/public_html/php/data2.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var label = [];
            var dado = [];
            var preco = parseFloat(0);
            for (var i in data) {
                label.push(data[i].hora);
                dado.push(data[i].preco);
                preco = (preco) + parseFloat(data[i].preco);
            }

            var config = {
                type: "line",
                data: {
                    labels: label,
                    datasets: [{
                            label: 'Preço por hora: R$',
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
                        text: 'Total gasto nas ultimas 24 horas: R$' + preco.toFixed(2)
                    },
                    tooltips: {
                        mode: 'point',
                    },
                    scales: {
                        xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Hora'
                                }

                            }],
                        yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Preço R$'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }

            };

            var ctx = $("#mycanvas");
            new Chart(ctx, config);
        },
        error: function (data) {
            console.log(data);
        }
    });
});