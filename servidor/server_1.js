/** parte que faz a conex�o com o banco de dados */
var host = 'localhost';
var user = 'root';
var password = 'r007';
var database = 'energy';
var table = 'medidas';

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
    } else
        console.log('database is connected as id ' + connection.threadId);
});

connection.query('SELECT * FROM medidas', function(err, rows, fields)   
{  
  if (err) throw err;  
  
  console.log(rows[0]);  
});  
  
connection.end();  