/** parte que faz a conex�o com o banco de dados */
var host= 'localhost';
var user= 'root';
var password= 'r007';
var database= 'energy';
var table= 'medidas';

var mysql = require('mysql');
var connection = mysql.createConnection({
    host: host,
    user: user,
    password: password,
    database: database
});

connection.connect(function (err) {
    if (err) {
        console.error('error connecting: ' + err.stack);
        return;
    }
    console.log('database is connected as id ' + connection.threadId);
});

/*connection.query('SELECT * FROM `medidas` ORDER BY `horario` ASC LIMIT 5', function(err, rows, fields) {
  if (err) throw err;
  timeout: 40000 
  console.log('primeiro elemento da tabela', rows[0]);
});

/** fim da conex�o com o banco de dados **/

/** Express � um framework que permite criar  um app web com facilidade com node.js. */
var app = require("express")();
var express = require("express");

// Na pasta public � onde colocaremos o arquivo Chart.js
app.use(express.static(__dirname + '/public'));

var http = require("http").Server(app);

// Socket.io � um biblioteca que permite estabelecer concex�o cliente servidor em tempo real.
var io = require("socket.io")(http);
var serialport = require("serialport");
var SerialPort = serialport;

var mySocket;

/**
 * app.get - 
 app.get("/", function(req, res){
 res.sendFile(__dirname +'/index.html');
 });
 */

/**
 * mySerial - cria uma porta serial para comunica��o com o Ardu�no, define a velocidade de 
 * comunica��o e interpreta o pular linha.
 * /dev/ttyUSB0 porta serial onde o arduino est� conectado
 */

var mySerial = new SerialPort("/dev/ttyUSB0", {
 	baudrate : 9600,
 	parser : serialport.parsers.readline("\n")
 });


/**
 * mySerial.on - Verifiica conex�o com o arduino e informa no console.
 */
mySerial.on("open", function () {
    console.log("Conexao com o Arduino estabelecida!");
});

/**
 * mySerial.on -
 */
mySerial.on("data", function (data) {
    var d = new Date();
    var tempo = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
   connection.query('INSERT INTO '+database+'.'+table+' (horario, corrente,potencia) VALUES ("' + tempo + '", "' + data + '", "' + (data*220) + '")',
function selectCb(err, results, fields) {
    if (err){
	console.log(err);
        throw err;
    }
	else
        ;
});
/*

/** Emite um evento e o objeto valor recebe data e **/
    io.emit("dadosArduino", {
        valor: data*220,
        tempo: d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds()
    });
});

/**
 * io.on - Recebe conex�o de cliente.
 */
io.on("connection", function (socket) {
    console.log("User is connected!");
});

http.listen(8080);



