
/** parte que faz a conexão com o banco de dados **/
/**
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

connection.query('SELECT * from medidas', function (err, rows, fields) {
    if (err)
        throw err;
    });

 fim da conexão com o banco de dados **/

/********************************************************

/**
 * App - 
 */

 // Express é um framework que permite cria app web com facilidade com node.js.
 
 var express = require('express'); //web server
 app = express();
 
 server = require('http').createServer(app);

// Socket.io é um biblioteca que permite estabelecer concexão cliente servidor em tempo ral.
 io = require('socket.io').listen(server); //we socket server
 server.listen(8080); //inicia o we server na porta 8080
 // Na pasta public é onde colocaremos o arquivo Chart.js
 //app.use(express.static(__dirname + '/public'));
app.use(express.static('/public'));

 var serialport = require("serialport");
 var SerialPort = serialport.SerialPort;

 var mySocket;

/**
 * app.get - 
 */
 app.get("/", function(req, res){
 	res.sendfile("view/index.html");
 });

/**
 * mySerial - cria uma porta serial para comunicação com o Arduíno, define a velocidade de 
 * comunicação e interpreta o pular linha.
 * Onde eu estou colocando "/dev/ttyUSB0" você deve substituir essa informação pela sua porta 
 * serial, onde o seu Arduíno está conectado. 
 */
 var mySerial = new SerialPort("/dev/ttyUSB0", {
 	baudrate : 9600,
 	parser : serialport.parsers.readline("\n")
 });

/**
 * mySerial.on - Verifiica conexão com o arduino e informa no console.
 */
 mySerial.on("open", function(){
 	console.log("Arduino conexão estabelecida!");
 });

/**
 * mySerial.on -
 */
 mySerial.on("data", function(data){
 	// Recebe os dados enviados pelo arduino e exibe no console.
 	// console.log(data);
 	io.emit("dadosArduino", { // Emite um evento e o objeto data recebe valor.
 		valor: data
 	});
 });

/**
 * io.on - Recebe conexão de cliente.
 */
 io.on("connection", function(socket){
 	console.log("Usuário está conectádo!");
 });

/**
 * http.linten -  
*/
 server.listen("8080", function(){
 	console.log("Servidor on-line em http://localhost:3000 - para sair Ctrl+C.");
 }); 
