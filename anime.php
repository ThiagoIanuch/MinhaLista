<?php 
    session_start();
    include "includes/anime.inc.php";
    include "includes/characters.inc.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title><?php echo $animeTitle.' - MinhaLista';?></title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/shows.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap"> 
            <div class="banner" style=background-image:url(media/anime/banner/<?php echo $animeBanner.')';?>>
                <div class="banner-shadow">
                </div> 
            </div>

            <div class="container">
                <div class="container-left">
                    <div class="avatar">
                        <?php 
                            echo '<div class="avatar-shows" style="background-image:url(media/anime/avatar/'.$animeAvatar.')"></div>';

                            if(isset($_SESSION['userID'])) {
                                if(isset($userAddFavorite)) {
                                    echo '<form action="includes/anime-submit.inc.php?animeid='.$animeID.'" method="post">
                                        <input type="submit" name="favorite-delete" value="* Remover dos favoritos" class="favorite-add remove">
                                    </form>';
                                }
                                else {
                                    echo '<form action="includes/anime-submit.inc.php?animeid='.$animeID.'" method="post">
                                            <input type="submit" name="favorite-submit" value="* Adicionar aos favoritos" class="favorite-add">
                                        </form>';
                                }
                            }
                        ?>
                    </div>

                    <div class="info">
                        <h3>Informações</h3>
                        <ul>
                            <li class="clear">
                                <span class="info-span">Tipo:</span>
                                <span><?php echo $animeType;?></span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Episódios:</span>
                                <span>
                                    <?php 
                                        if($animeEpisodes == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo $animeEpisodes;
                                        };
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Status:</span>
                                <span>
                                    <?php 
                                       echo $animeStatus;
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Exibição:</span>
                                <span> 
                                    <?php 
                                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                                        date_default_timezone_set('America/Sao_Paulo');
                                        $yearStart = substr($animeStart, -10, 4); // ano
                                        $monthStart = substr($animeStart, -5, 2); // mes
                                        $dayStart = substr($animeStart, -2, 2); // dia 

                                        $yearEnd = substr($animeEnd, -10, 4); // ano
                                        $monthEnd = substr($animeEnd, -5, 2); // mes
                                        $dayEnd = substr($animeEnd, -2, 2); // dia

                                        // Data de início
                                        if($animeStart != null) {
                                            // Se a data de início não for nulo
                                            if($yearStart > 0 && $monthStart > 0 && $dayStart > 0) {
                                                echo strftime('%d de %b, %Y',strtotime($animeStart)).' até ';
                                            }
                                            // Se apenas o dia for nulo
                                            else if($yearStart > 0 && $monthStart > 0 && $dayStart <= 0) {
                                                $animeStart = $yearStart.'-'.$monthStart.'-'.'01';
                                                echo ucfirst(strftime('%b, %Y',strtotime($animeStart))).' até ';
                                            }
                                            // Se o dia e o mês for nulo
                                            else if($yearStart > 0 && $monthStart <= 0 && $dayStart <= 0) {
                                                $animeStart = $yearStart.'-'.'01'.'-'.'01';
                                                echo strftime('%Y',strtotime($animeStart)).' até ';
                                            }
                                            else {
                                                echo '? até ';
                                            }
                                        }
                                        else if($animeStart == null && $animeEnd == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo '? até ';
                                        }

                                        if($animeEnd != null) {
                                            // Se a data de término não for nulo
                                            if($yearEnd > 0 && $monthEnd > 0 && $dayEnd > 0) {
                                                echo strftime('%d de %b, %Y',strtotime($animeEnd));
                                            }
                                            // Se apenas o dia for nulo
                                            else if($yearEnd > 0 && $monthEnd > 0 && $dayEnd <= 0) {
                                                $animeEnd = $yearEnd.'-'.$monthEnd.'-'.'01';
                                                echo ucfirst(strftime('%b, %Y',strtotime($animeEnd)));
                                            }
                                            // Se o dia e o mês for nulo
                                            else if($yearEnd > 0 && $monthEnd <= 0 && $dayEnd <= 0) {
                                                $animeEnd = $yearEnd.'-'.'01'.'-'.'01';
                                                echo strftime('%Y',strtotime($animeEnd));
                                            }
                                            else {
                                                echo '?';
                                            }
                                        }
                                        else if($animeStart == null && $animeEnd == null) {
                                            echo '';
                                        }
                                        else {
                                            echo '?';
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Fonte:</span>
                                <span> 
                                    <?php 
                                        if($animeSource == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo ($animeSource);
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Gêneros:</span>
                                <span> 
                                    <?php 
                                        if($animeGenres == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo ($animeGenres) ;
                                        }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="container-right">
                    <div class="title">
                        <h1 class="title-clear"><?php echo $animeTitle?></h1>
                        <?php
                            if(isset($_SESSION['userID'])) {
                                if($_SESSION['userPermissions'] > 0) {
                                    echo '<a href="admin-edit.php?config=edit&animeid='.$animeID.'" class="edit">(Editar)</a>';
                                }
                            }
                        ?>
                    </div>

                    <div class="ranked">
                        <div class="score">
                            <?php
                                if ($animeScore > 0) {
                                    echo number_format($animeScore, 2);
                                }
                                else {
                                    echo 'N/A';
                                }
                            ?>
                            <hr>
                        </div>
                        <div class="members">
                            <?php
                                if ($animeUsers > 0) {
                                    echo $animeUsers;
                                }
                                else {
                                    echo 'N/A';
                                }
                            ?>
                            <hr>
                        </div>

                    </div>
                    <?php
                        echo '<div class="user-add">';
                        if (isset($_SESSION['userID'])) {  
                            if (isset($userAdd)) {
                                echo '<form>
                                        <select class="select" id="animeStatus" name="status-submit">
                                            <option value="1"'; 
                                                if (isset($statusSelect1)) {
                                                    echo $statusSelect1;
                                                } 
                                            echo'>Assistindo</option>
                                            <option value="2"'; 
                                                if(isset($statusSelect2)) {
                                                    echo $statusSelect2;
                                                } 
                                            echo'>Completado</option>
                                            <option value="3"'; 
                                                if(isset($statusSelect3)) {
                                                    echo $statusSelect3;
                                                } 
                                            echo'>Desistiu</option>
                                            <option value="4"'; 
                                                if(isset($statusSelect4)) {
                                                    echo $statusSelect4; 
                                                } 
                                                echo'>Planeja Assistir</option>
                                        </select>
                                    </form>

                                    <form>
                                        <select class="select" id="animeScore" name="score-submit">
                                            <option value="0">Selecionar</option>
                                            <option value="10"';
                                                if(isset($scoreSelect10)) {
                                                    echo $scoreSelect10;
                                                }
                                            echo'>(10) Obra prima</option>
                                            <option value="9"';
                                                if(isset($scoreSelect9)) {
                                                    echo $scoreSelect9;
                                                }
                                            echo'>(9) Ótimo</option>
                                            <option value="8"';
                                                if(isset($scoreSelect8)) {
                                                    echo $scoreSelect8;
                                                }
                                            echo'>(8) Muito bom</option>
                                            <option value="7"';
                                                if(isset($scoreSelect7)) {
                                                    echo $scoreSelect7;
                                                }
                                            echo'>(7) Bom</option>
                                            <option value="6"';
                                                if(isset($scoreSelect6)) {
                                                    echo $scoreSelect6;
                                                } 
                                            echo'>(6) Bem</option>
                                            <option value="5"';
                                                if(isset($scoreSelect5)) {
                                                    echo $scoreSelect5;
                                                }
                                            echo'>(5) Médio</option>
                                            <option value="4"';
                                                if(isset($scoreSelect4)) {
                                                    echo $scoreSelect4;
                                                }
                                            echo'>(4) Ruim</option>
                                            <option value="3"';
                                                if(isset($scoreSelect3)) {
                                                    echo $scoreSelect3;
                                                }
                                            echo'>(3) Muito ruim</option>
                                            <option value="2"';
                                                if(isset($scoreSelect2)) {
                                                    echo $scoreSelect2;
                                                }
                                            echo'>(2) Horrível</option>
                                            <option value="1"';
                                                if(isset($scoreSelect1)) {
                                                    echo $scoreSelect1;
                                                }
                                            echo'>(1) Terrível</option>
                                        </select>
                                    </form>

                                    <div class="user-episodes">
                                        <span>Episódios:</span>
                                        <form id="animeEpisodes">
                                            <input type="text" size="3" value="'.$userEpisodes.'" name="episodes-submit">
                                        </form>
                                        <span>/</span>
                                        <span>';
                                            if($animeEpisodes == null) {
                                                echo '?';
                                            }
                                            else {
                                                echo $animeEpisodes;
                                            }
                                        echo '</span>
                                    </div>
                                    
                                    <div class="user-delete">
                                        <form action="includes/anime-submit.inc.php?animeid='.$animeID.'" method="post">
                                            <input type="submit" value="* Remover da lista" id="delete" name="delete">
                                        </form>
                                    </div>';
                            }
                            else {
                                echo '<form action="includes/anime-submit.inc.php?animeid='.$animeID.'" method="post">
                                        <input type="submit" class="button-submit" value="Adicionar" name="add-submit">
                                    </form>';
                            }
                        }
                        else {
                            echo '<div class="not-login">Gostaria de adicionar esse anime a lista ou aos seus favoritos? <a href="login.php">Entre</a> ou <a href="register.php">Registre-se</a> primeiro!</div>';
                        }
                        echo '</div>';
                    ?>
                    <div class="sinopse">
                        <h3>Sinopse</h3>
                        <span>
                            <?php 
                                if ($animeSinopse == null) {
                                    echo 'Nenhuma sinopse adicionada a este título.';
                                } 
                                else {
                                    echo $animeSinopse;
                                }
                            ?>
                        </span>
                    </div>

                    <div class="characters">
                        <h3>Personagens</h3>
                        <div class="characters-grid">
                            <?php
                                if ($resultCharacters > 0 ) {
                                    for ($i = 0; $i < count($characterID), $i < count($characterName), $i < count($characterAvatar), $i < count($characterRole); $i++) {
                                        echo '
                                        <div class="character">
                                            <a href="characters.php?characterid='.$characterID[$i].'" class="avatar-character" style="background-image:url(media/characters/avatar/'.$characterAvatar[$i].')"></a>
                                            <div class="content">
                                                <div class="name">
                                                    <a href="characters.php?characterid='.$characterID[$i].'">'.$characterName[$i].'</a>
                                                </div>
                                                <div class="role">'.$characterRole[$i].'</div>
                                            </div>
                                        </div>';
                                    }
                                }
                                
                            ?>
                        </div> <!-- Characters grid --> 
                        <?php
                            if($resultCharacters <= 0) {
                                    echo 'Nenhum personagem adicionado';
                            }
                        ?>
                    </div> <!-- Characters -->
                </div> <!-- Container right -->
            </div> <!-- Container -->
        </div> <!-- Page wrap -->
        <?php
            include "footer.php";
        ?>
    </body>
</html>