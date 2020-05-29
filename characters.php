<?php 
    session_start();
    include "includes/characters.inc.php";
    if(!isset($_GET['characterid'])) {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo $characterName.' - MinhaLista';?></title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/characters.css">
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
                <div class="character-container">
                    <div class="character-grid">  
                        <div class="character-avatar-favorite">
                            <a class="character-avatar" style="background-image:url(media/characters/avatar/<?php echo $characterAvatar; ?>"></a>
                            <?php
                                if(isset($_SESSION['userID'])) {
                                    if($resultCharacterFavorite > 0) {
                                        echo '<form action="includes/characters.inc.php?characterid='.$characterID.'" method="post">
                                            <input type="submit" name="favorite-delete" value="* Remover dos favoritos" class="favorite-add remove">
                                        </form>
                                        '.$characterFavoritesTotal.' favoritos.';
                                    }
                                    else {
                                        echo '
                                        <form action="includes/characters.inc.php?characterid='.$characterID.'" method="post">
                                            <input type="submit" name="favorite-submit" value="* Adicionar aos favoritos" class="favorite-add">
                                        </form> 
                                        '.$characterFavoritesTotal.' favoritos.';
                                    }
                                }
                                else {
                                    echo '<div class="not-login">Gostaria de adicionar esse personagem aos seus favoritos? <a href="login.php">Entre</a> ou <a href="register.php">Registre-se</a> primeiro!</div>';
                                }
                            ?>
                        </div>
                        <div class="character-content">
                            <div class="character-name">
                            <?php
                                echo $characterName.' ';
                                if(isset($_SESSION['userID'])) {
                                    if($_SESSION['userPermissions'] > 0) {
                                        echo '<a href="admin-edit.php?config=edit&characterid='.$characterID.'" class="edit">(Editar)</a>';
                                    }
                                }
                            ?>
                            </div>
                            <div class="character-info">
                                <?php 
                                    if(empty($characterInfo)) {
                                        echo "Nenhuma informação sobre este personagem foi adicionada.";
                                    }
                                    else {
                                        echo $characterInfo;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
            include "footer.php";
        ?>
    </body>
</html>