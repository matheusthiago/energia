<?php
include_once 'register.inc.php';
include_once 'functions.php';
?>
<!DOCTYPE html>
<html> 
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Register with us</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li>Os nomes de usuários devem conter apenas dígitos, letras maiúsculas e minúsculas e underlines (“_”)</li>
            <li>Emails devem seguir um formato válido para email.</li>
            <li>As senhas devem ter no mínimo 6 caracteres.</li>
            <li>As senhas devem conter
               <ul>
                    <li>Pelo menos uma letra maiúscula (A..Z)</li>
                    <li>Pelo menos uma letra minúscula (a..z)</li>
                    <li>Pelo menos um número (0..9)</li>
                </ul>
            </li>
            <li>Sua senha deve conferir exatamente</li>
        </ul>
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">
            Username: <input type='text' 
                name='username' 
                id='username' /><br>
            Email: <input type="text" name="email" id="email" /><br>
            Password: <input type="password"
                             name="password" 
                             id="password"/><br>
            Confirm password: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /><br>
            <input type="button" 
                   value="Register" 
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>