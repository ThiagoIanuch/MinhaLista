<?php 
    session_start();
    include "includes/animelist.inc.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo $userName.' | Lista Anime - MinhaLista'?></title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/list.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    </head>
    <body>
        <div class="page-wrap">

            <div class="bg-color"></div>

            <div class="container">
                <div class="header">
                    <div class="menu">
                        <a href="index.php"> 
                            <div class="menu-logo" style="background-image: url(img/logo2.png)"></div>
                        </a>

                        <div  class="menu-buttons">
                            <div class="menu-content">
                                <span>Visualizando a</span>

                                <span class="menu-redirect" id="dropdown2">
                                    <?php 
                                    $list = basename( __FILE__ );
                                    if($list == 'animelist.php') {
                                        echo 'Lista de Anime';
                                    }
                                    else {
                                        echo 'Lista de Manga';
                                    }
                                ?>
                                </span>

                                <span>de</span>

                                <a href="profile.php?userid=<?php echo $userID; ?>" title="Ir para o perfil de <?php echo $userName; ?>"class="menu-redirect"><?php echo $userName; ?></a>
                            
                                <i class="fa fa-angle-down" id="dropdown"></i>
                            </div>
                            
                            <div class="list-display-none" id="display">
                                <?php 
                                if($list == 'animelist.php') {
                                    echo '<a href="mangalist.php?userid='.$userID.'&status=5">Lista Manga</a>';
                                }
                                else {
                                    echo '<a href="animelist.php?userid='.$userID.'&status=5">Lista Anime</a>';
                                }

                                if(isset($_SESSION['userID'])) {
                                    echo '<a href="profile.php?userid='.$_SESSION['userID'].'">Meu perfil</a>';
                                }
                                else {
                                    echo '<a href="signup.php">Registrar</a>';
                                    echo '<a href="login.php">Entrar</a>';
                                }
                            ?>    
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="list-container">
                    <div class="list-background" style=background-image:url(media/users/bannerList/<?php echo $userBannerList.')';?>>
                        <div class="shadow"></div>
                    </div>
    
                    <div class="status-menu">
                        <a href="animelist.php?userid=<?php echo $userID ?>&status=5" class="status-button">TODOS OS ANIMES</a>
                        <a href="animelist.php?userid=<?php echo $userID ?>&status=1" class="status-button">ATUALMENTE ASSISTINDO</a>
                        <a href="animelist.php?userid=<?php echo $userID ?>&status=2" class="status-button">COMPLETADO</a>
                        <a href="animelist.php?userid=<?php echo $userID ?>&status=3" class="status-button">DESISTIU</a>
                        <a href="animelist.php?userid=<?php echo $userID ?>&status=4" class="status-button">PLANEJA ASSISTIR</a>
                    </div>
                
                    <div class="list-status">         
                        <?php 
                            $status = $_GET['status'];
                            switch($status) {
                                case '1':
                                    $status = 'ATUALMENTE ASSISTINDO';
                                break;
                                case '2':
                                    $status = 'COMPLETADO';
                                break;
                                case '3':
                                    $status = 'DESISTIU';
                                break;
                                case '4':
                                    $status = 'PLANEJA ASSISTIR';
                                break;
                                case '5':
                                    $status = 'TODOS OS ANIMES';
                                break;
                            }
                            echo $status; 
                        ?>                
                    </div>

                    <table class="list">
                        <tr class="list-table-header">
                            <td class="data-header status"></td>
                            <td class="data-header rank">#</td>
                            <td class="data-header image">Avatar</td>
                            <td class="data-header title">Anime</td>
                            <td class="data-header score">Pontuação</td>
                            <td class="data-header type">Tipo</td>
                            <td class="data-header progress">Progresso</td>
                        </tr>
                        <?php
                            for($i = 0, $ii = 1; $i < $resultCheck, $i < count($animeID), $i < count($animeTitle), $i < count($animeAvatar), $i < count($animeType), $i < count($animeEpisodes), $i < count($userStatus), $i < count($userScore), $i < count($userEpisodes); $i++, $ii++) {

                                if($userStatus[$i] == '1') {
                                    $userStatus[$i] = 'watching';
                                }
                                if($userStatus[$i] == '2') {
                                    $userStatus[$i] = 'completed';
                                }
                                if($userStatus[$i] == '3') {
                                    $userStatus[$i] = 'dropped';
                                }
                                if($userStatus[$i] == '4') {
                                    $userStatus[$i] = 'plantowatch';
                                }

                                if(empty($userScore[$i])) {
                                    $userScore[$i] = '-';
                                }

                                if(empty($animeEpisodes[$i])) {
                                    $animeEpisodes[$i] = '?';
                                }

                                echo'
                                <tr class="list-table-data">
                                    <td class="data status '.$userStatus[$i].'"></td>
                                    <td class="data rank">'.$ii.'</td>
                                    <td class="data image">
                                        <a href="anime.php?animeid='.$animeID[$i].'" class="avatar" style="background-image: url(media/anime/avatar/'.$animeAvatar[$i].')"></a>
                                    </td>
                                    <td class="data title">
                                        <a href="anime.php?animeid='.$animeID[$i].'">'.$animeTitle[$i].'</a>
                                    </td>
                                    <td class="data score">'.$userScore[$i].'</td>
                                    <td class="data type">'.$animeType[$i].'</td>
                                    <td class="data progress">'.$userEpisodes[$i].' / '.$animeEpisodes[$i].'</td>
                                </tr>'
                                ;
                            }
                        ?>
                    </table>
                    <?php 
                        if($resultCheck < 1) {
                            echo '<div class="block"></div>';
                        }
                    ?>
                    <div class="list-total"></div>
                </div>
            </div>
        </div>  
        <div class="footer">
            <div class="copyright">
                MinhaLista é uma propriedade de MinhaLista. ©2020 Todos os direitos reservados.
            </div>
        </div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/script-list.js"></script>  
    </body>
</html>