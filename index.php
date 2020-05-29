<?php
    session_start();
    include "includes/index.inc.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Início - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css.css">
    </head>
    <body>  
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="logo">
                <img src="img/logo1.png">
            </div>

            <div class="text-changing">
				<p id="text-changing"></p>
			</div>

           
            <?php
                if (isset($_SESSION["userID"])) {
                    echo
                    '<div class="text-welcome">Bem vindo 
                        <a href="profile.php?userid='.$_SESSION["userID"].'">'.$_SESSION["username"].'.</a>
                    </div>';
                }
                else {
                    echo 
                    '<div class="links"> 
                        <a href="signup.php" class="link-signup">Registrar</a>
                        <a href="login.php" class="link-login">Entrar</a>  
                    </div>';
				}
            ?>
            
            <div class="video-header">
                <video autoplay="autoplay" loop="loop" muted="muted" class="video-bg">
                    <source type="video/mp4" src="videos/bg1.mp4">
                </video>
            </div>

            <div class="shows">
                <div class="text-header">DESCUBRA NOVOS ANIMES E MANGAS!</div>
                    <div class="grid">
                        <?php 
                        /* Mostrar anime/manga */
                        for($i = 0; $i < count ($animeID), $i < count($animeTitle), $i < count($animeAvatar); $i++) {
                            echo '
                            <div class="shows-not-responsive">
                                <a href="anime.php?animeid='.$animeID[$i].'" class="avatar" title="'.$animeTitle[$i].'" style="background-image:url(media/anime/avatar/'.$animeAvatar[$i].')"></a>
                            </div>';
                        }
                        
                        for($i = 0; $i < count ($mangaID), $i < count($mangaTitle), $i < count($mangaAvatar); $i++) {
                            echo '
                            <div class="shows-not-responsive">
                                <a href="manga.php?mangaid='.$mangaID[$i].'" class="avatar" title="'.$mangaTitle[$i].'" style="background-image:url(media/manga/avatar/'.$mangaAvatar[$i].')"></a>
                            </div>';
                        }

                        /* Para quando o site for responsivo */
                        for($i = 0; $i < 3; $i++) {
                            echo '
                            <div class="shows-responsive">
                                <a href="anime.php?animeid='.$animeID[$i].'" class="avatar" title="'.$animeTitle[$i].'" style="background-image:url(media/anime/avatar/'.$animeAvatar[$i].')"></a>
                            </div>';
                        }
                        
                        for($i = 0; $i < 3; $i++) {
                            echo '
                            <div class="shows-responsive">
                                <a href="manga.php?mangaid='.$mangaID[$i].'" class="avatar" title="'.$mangaTitle[$i].'" style="background-image:url(media/manga/avatar/'.$mangaAvatar[$i].')"></a>
                            </div>';
                        }
                        ?>
                </div>
			</div>
        </div>

        <?php
            include "footer.php"
        ?>
    </body>
</html>