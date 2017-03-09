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
connection.connect();
connection.query('SELECT * FROM `medidas` ORDER BY `horario` ASC LIMIT 5', function(err, rows, fields) {
  if (err) throw err;
 
  console.log('tabela: ', rows[0]);
});
 
connection.end();
