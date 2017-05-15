/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function mudaGrafico(canvas) {
        $.ajax({
            url: CONEXAO + "/energia/public_html/php/data.php",
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
    var a = "<canvas id='canvasChartPreco'></canvas>";
    document.getElementById(canvas).innerHTML = a;
}
jQuery(document).ready(function($){
    function muda(item, indice) {
        var id = indice.substring(5);
        var icone = $('#ligar'+id).attr('data-ico');
        if (item.state=="False") {
            $('#'+icone).css({color:'#f0ad4e'});
            $('#text'+id).html("Desligar");

        } else if(item.state=="True") {
            $('#'+icone).css({color:'#111111'});
            $('#text'+texto).html("Ligar");
        }
    }
    function atualizaStatus(itens){
        for(var i=1;i<11;i++){
            if(itens[i]==0){
                $('#'+$('#ligar'+i).attr('data-status')).html("Desligar");
                $('#'+$('#ligar'+i).attr('data-ico')).css({color:'#111111'});
            }else{
                $('#'+$('#ligar'+i).attr('data-status')).html("Ligar");
                $('#'+$('#ligar'+i).attr('data-ico')).css({color:'#f0ad4e'});
            }
        }
    }
    $('#action1').click(function(e){
        e.preventDefault();
        mudaGrafico('chart-container');
        
    });
    $('.botao').click(function(e){
        e.preventDefault();
        var status = $(this).attr('data-status');
        var ioAtual = status.substring(4);
        var estado;
        if ($('#'+status).html() === "Ligar") {
            estado = 0;
        }else if($('#'+status).html() === "Desligar") {
            estado = 1;
        }
        $.ajax({
            url: 'http://192.168.0.100:8181/esp8266/gpio'+ioAtual+"/"+estado,
            type: 'get',
            dataType: 'json',
            success: function(data){
                console.log(data);
                data.forEach(muda);
            }
        });
    });
});