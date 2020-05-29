<?php
    session_start();
    if (isset($_SESSION["userID"])) {
        header("Location: index.php");
    }
    else {
        if(isset($_GET['error'])) {
            $error = $_GET['error'];
            if($error == "useremailtaken") {
                $errorUserEmail = "* Este nome de usúario ou email já existe";
            }
        }
    }           
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Registrar - MinhaLista</title>
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
                        <form action="includes/signup.inc.php" method="post" id="signup">
                            <input type="text" placeholder="Nome de usúario" name="username" class="form-input" id="username">
                            <p class="form-error">
                                <?php
                                    if(isset($errorUserEmail)) {
                                        echo $errorUserEmail;
                                    }
                                ?>
                            </p>

                            <input type="text" placeholder="Email" name="email" class="form-input" id="email">
                            <p class="form-error">
                                <?php
                                    if(isset($errorUserEmail)) {
                                        echo $errorUserEmail;
                                    }
                                ?>        
                            </p>

                            <input type="password" placeholder="Senha" name="password" class="form-input" id="password">
                            <p class="form-error"></p>

                            <input type="password" placeholder="Confirmar a senha" name="password_confirm" class="form-input" id="password_confirm"> 
                            <p class="form-error"></p>

                            <input type="checkbox" name="terms_accept" class="form-checkbox" id="terms_accept"> 
                            <label for="terms_accept">Li e concordo com os termos de uso.</label>
                            <p class="form-error"></p>

                            <div class="form-submit">
                                <input type="submit" value="Registrar" name="signup-submit" class="form-submit-button">
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