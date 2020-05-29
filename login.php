<?php
    session_start();
	if (isset($_SESSION["userID"])) {
        header("Location: index.php");
    }
    else {
        if(isset($_GET['error'])) {
            $error = $_GET['error'];
            if($error == "nouser") {
                $errorMessage = "* Nome de usúario/email ou senha incorretos";
            }
            else if($error == "userbanned") {
                $errorMessage = "* Este usúario foi banido por infringir as regras do site. Caso considere isto um erro, entre em contato com o <a href='support.php' class='support-error'>Suporte</a>.";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Entrar - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/signup-login.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="container">
                <div class="form-container-all">
                    <div class="logo">
                        <img src="img/logo1.png">
                    </div>
    
                    <div class="form-container">
                        <form action="includes/login.inc.php" method="post" id="login">
                            <input type="text" placeholder="Nome de usúario ou email" name="userNameEmail" class="form-input" id="username">
                            <p class="form-error"></p>

                            <input type="password" placeholder="Senha" name="password" class="form-input" id="password">
                            <p class="form-error">
                                <?php
                                    if(isset($errorMessage)) {
                                        echo $errorMessage;
                                    }
                                ?>
                            </p>

                            <input type="checkbox" name="remember" class="form-checkbox" id="remember"> 
                            <label for="remember">Permanecer sempre logado.</label>

                            <div class="form-submit">
                                <input type="submit" value="Entrar" name="login-submit" class="form-submit-button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
            include "footer.php"
        ?>
    </body>
</html>
