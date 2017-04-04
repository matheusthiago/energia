<?php

// armazena o valor de retorno da função fopen() na variavel $port
// fopen() recebe como parametro o caminho da porta e o parametro para escrever "w" (write) fopen("COM3", "w");
$port = fopen("/dev/ttyUSB0", "w");
$campo=$_POST['ligar1'];
//Se  o valor da variavel "estado" for igual a "A", entao escreve na porta serial o valor "a"
if ($_POST['estado'] == "1") {
    //Imprime a mensagem no browser "Ligou o Amarelo"
    //função para escrever na porta serial o caracter "a"
    fwrite($port, "a");
    fclose();
//$retorno = fread($port,10);
}
if ($_POST['estado'] == "2") {
    fwrite($port, "b");
}
if ($_POST['estado'] == "3") {
    fwrite($port, "c");
}
if ($_POST['estado'] == "4") {
    fwrite($port, "d");
}
if ($_POST['estado'] == "5") {
    //Imprime a mensagem no browser "Ligou o Amarelo"
    //função para escrever na porta serial o caracter "a"
    fwrite($port, "e");
}
if ($_POST['estado'] == "6") {
    //Imprime a mensagem no browser "Ligou o Amarelo"
    //função para escrever na porta serial o caracter "a"
    fwrite($port, "g");
}
if ($_POST['estado'] == "7") {
    //Imprime a mensagem no browser "Ligou o Amarelo"
    //função para escrever na porta serial o caracter "a"
    fwrite($port, "h");
}
$resposta['erro'] = "";
for($i=1;$i<11;$i++){
    $resposta['retorno'][$i] = $i%2;
}
$resposta = json_encode($resposta);
echo $resposta;