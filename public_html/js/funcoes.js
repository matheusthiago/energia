/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function muda(icone, texto) {
    if (document.getElementById(texto).innerHTML === "Ligar") {
        document.getElementById(icone).style.color = "#f0ad4e";
        document.getElementById(texto).innerHTML = "Desligar";

    }
    else if (document.getElementById(texto).innerHTML === "Desligar") {
        document.getElementById(icone).style.color = "#111";
        document.getElementById(texto).innerHTML = "Ligar";
    }
}
function mudaGrafico(canvas) {
    ﻿﻿﻿$(document).ready(function () {
    $.ajax({
        url: "http://localhost/site/public_html/php/data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var label = [];
            var dado = [];
            for (var i in data) {
                label.push(data[i].diaMes);
                dado.push(data[i].preco);
            }

            var config = {
                type: "bar",
                data: {
                    labels: label,
                    datasets: [{
                            label: 'Total gasto por dia',
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
var a="<canvas id='canvasChartPreco'></canvas>";
    document.getElementById(canvas).innerHTML = a;
}
