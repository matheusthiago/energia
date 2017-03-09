/**
 * App - 
 */

 // Express � um framework que permite cria app web com facilidade com node.js.
 
 var express = require('express'); //web server
 app = express();
 
 server = require('http').createServer(app);

// Socket.io � um biblioteca que permite estabelecer concex�o cliente servidor em tempo ral.
 io = require('socket.io').listen(server); //we socket server
 server.listen(8080); //inicia o we server na porta 8080
 // Na pasta public � onde colocaremos o arquivo Chart.js
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
 * mySerial - cria uma porta serial para comunica��o com o Ardu�no, define a velocidade de 
 * comunica��o e interpreta o pular linha.
 * Onde eu estou colocando "/dev/ttyUSB0" voc� deve substituir essa informa��o pela sua porta 
 * serial, onde o seu Ardu�no est� conectado. 
 */
 var mySerial = new SerialPort("/dev/ttyUSB0", {
 	baudrate : 9600,
 	parser : serialport.parsers.readline("\n")
 });

/**
 * mySerial.on - Verifiica conex�o com o arduino e informa no console.
 */
 mySerial.on("open", function(){
 	console.log("Arduino conex�o estabelecida!");
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
 * io.on - Recebe conex�o de cliente.
 */
 io.on("connection", function(socket){
 	console.log("Usu�rio est� conect�do!");
 });

/**
 * http.linten -  
*/
 server.listen("8080", function(){
 	console.log("Servidor on-line em http://localhost:3000 - para sair Ctrl+C.");
 }); 
