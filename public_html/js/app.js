$(document).ready(function () {
    $.ajax({
        url: CONEXAO+"/energia/public_html/php/data2.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var label = [];
            var dado = []; 
            var preco = parseFloat(0); 
            var dia=[];
            for (var i in data) {
                label.push(data[i].hora);
                dado.push(data[i].preco);
                dia.push(data[i].dia);
                preco=(preco) + parseFloat(data[i].preco);
            }
           
            var config = {
                type: "bar",
                data: {
                    labels: label,
                    datasets: [{
                            label: 'Consumo total no dia é:'+ preco.toFixed(2)+' R$',
                            backgroundColor: 'rgba(91, 184, 93, 0.75)',
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(91, 184, 93, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
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
                            }                        }
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