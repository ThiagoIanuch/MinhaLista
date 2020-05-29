<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Sobre - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel=stylesheet type="text/css" href="css/about.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="container-all">
                <div class="container">
                    <div class="bg-header" style="background-image: url(img/bg-header.jpg)">   
                        <img src="img/logo3.png" class="logo">
                    </div>

                    <h2>CRIE SUA PRÓPRIA LISTA</h2>

                    <p>MinhaLista é um projeto de TCC com o objetivo de criar uma base de dados sobre Animes e Mangas e seus respectivos personagens, com diversas informações sobre eles e também o que foi melhor avaliado pelos usúarios e o que é mais popular.</p>
                    <p>Ao criar uma conta, você possui um perfil próprio, onde pode adicionar amigos, animes e mangas favoritos, além de possuir também uma lista própria para colocar tudo o que já assistiu ou leu.</p>

                    <h3>DESCUBRA NOVOS ANIMES E MANGAS AGORA! </h3>

                    <a href="signup.php" class="button">REGISTRE-SE AGORA</a>
                </div> <!-- Container -->
            </div> <!-- Container all -->
        </div> <!-- Page wrap -->

        <?php
            include "footer.php";
        ?>
    </body>
</html>