<?php
include_once '../php/db_connect.php';
include_once '../php/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'in';
    echo 'logado com sucesso bd';
} else {
    echo 'não logado com sucesso bd';
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html> 
    
    <head>
        <title>Secure Login: Log In</title>
        <script type="text/javascript" src="../js/sha512.js"></script> 
        <script type="text/javascript" src="../js/forms.js"></script> 
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Erro ao fazer o login!</p>';
        }
        ?> 
        <form action="../php/process_login.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Login" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
        <p>If you don't have a login, please <a href="../php/register.php">register</a></p>
        <p>If you are done, please <a href="../php/logout.php">log out</a>.</p>
        <p>You are currently logged <?php echo $logged ?>.</p>
    </body>
</html>