<?php
include("conexao.php");

if (isset($_POST['email']) && strlen($_POST['email']) > 0) {

    if (!isset($_SESSION))
        session_start();

    $_SESSION['email'] = $mysqli->escape_string($_POST['email']);
    $_SESSION['senha'] = md5(md5($_POST['senha']));

    $sql_code = "SELECT senha, id FROM usuario WHERE email = '$_SESSION[email]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();
    $total = $sql_query->num_rows;

    if ($total == 0) {
        $erro[] = "Este email não pertence à nenhum usuário.";
    } else {
        if ($dado['senha'] == $_SESSION['senha']) {
            $_SESSION['usuario'] = $dado['codigo'];
        } else {
            $erro[] = "Senha incorreta.";
        }
    }
    if (count($erro) == 0 || !isset($erro)) {
        echo "<script>alert('Login efetuado com sucesso'); location.href='sucesso.php';</script>";
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
<?php
if (count($erro) > 0)
    foreach ($erro as $msg) {
        echo "<p>$msg</p>";
    }
?>
        <form method="POST" action="">
            <p><input value="<?php echo $_SESSION['email']; ?>" name="email" placeholder="E-mail" type="text"></p>
            <p><input name="senha"  type="password"></p>
            <p><a href="esqueceuasenha.php" target="_blank">Esqueceu sua senha?</a></p>
            <p><input value="Entrar" type="submit"></p>
        </form>
    </body>
</html>