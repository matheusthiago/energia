<?php

require_once(seguranca.php);

//verifica o envio do formulario

if($_SERVER['REQUEST_METHOD']=='POST'){
	//salva as variáveis com a verificação se o campo foi preenchido
	$usuario=(isset($_POST['usuario'])) ? $_POST['usuario']:'';
	$senha=(isset($_POST['senha'])) ? $_POST['senha']: '';
	//utiliza a funcao criada em seguranca.php para validar os dados
	if(validaUsuario($usuario, $senha)==true){
		header("Location: index.php");
	} else{
		retorna();
	}		
}