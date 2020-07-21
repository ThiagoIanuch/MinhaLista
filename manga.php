<?php 
    session_start();
    include "includes/manga.inc.php";
    include "includes/characters.inc.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
      <title><?php echo $mangaTitle.' - MinhaLista';?></title>
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
            <div class="banner" style=background-image:url(media/manga/banner/<?php echo $mangaBanner.')';?>>
                <div class="banner-shadow">
                </div> 
            </div>

            <div class="container">
                <div class="container-left">
                    <div class="avatar">
                        <?php
                            echo '<div class="avatar-shows" style="background-image:url(media/manga/avatar/'.$mangaAvatar.')"></div>';
                       
                            if(isset($_SESSION['userID'])) {
                                if(isset($userAddFavorite)) {
                                    echo '<form action="includes/manga-submit.inc.php?mangaid='.$mangaID.'" method="post">
                                        <input type="submit" name="favorite-delete" value="* Remover dos favoritos" class="favorite-add remove">
                                    </form>';
                                }
                                else {
                                    echo '<form action="includes/manga-submit.inc.php?mangaid='.$mangaID.'" method="post">
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
                                <span><?php echo $mangaType;?></span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Capítulos:</span>
                                <span>
                                    <?php 
                                        if($mangaChapters == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo $mangaChapters;
                                        };
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Volumes:</span>
                                <span> 
                                    <?php 
                                        if($mangaVolumes == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo ($mangaVolumes);
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Status:</span>
                                <span>
                                    <?php 
                                       echo $mangaStatus;
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Publicação:</span>
                                <span> 
                                    <?php 
                                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                                        date_default_timezone_set('America/Sao_Paulo');
                                        $yearStart = substr($mangaStart, -10, 4); // ano
                                        $monthStart = substr($mangaStart, -5, 2); // mes
                                        $dayStart = substr($mangaStart, -2, 2);  // dia

                                        $yearEnd = substr($mangaEnd, -10, 4); // ano
                                        $monthEnd = substr($mangaEnd, -5, 2); // mes
                                        $dayEnd = substr($mangaEnd, -2, 2); // dia

                                        // Data de início
                                        if($mangaStart != null) {
                                            // Se a data de início não for nulo
                                            if($yearStart > 0 && $monthStart > 0 && $dayStart > 0) {
                                                echo strftime('%d de %b, %Y',strtotime($mangaStart)).' até ';
                                            }
                                            // Se apenas o dia for nulo
                                            else if($yearStart > 0 && $monthStart > 0 && $dayStart <= 0) {
                                                $mangaStart = $yearStart.'-'.$monthStart.'-'.'01';
                                                echo ucfirst(strftime('%b, %Y',strtotime($mangaStart))).' até ';
                                            }
                                            // Se o dia e o mês for nulo
                                            else if($yearStart > 0 && $monthStart <= 0 && $dayStart <= 0) {
                                                $mangaStart = $yearStart.'-'.'01'.'-'.'01';
                                                echo strftime('%Y',strtotime($mangaStart)).' até ';
                                            }
                                            else {
                                                echo '? até ';
                                            }
                                        }
                                        else if($mangaStart == null && $mangaEnd == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo '? até ';
                                        }

                                        if($mangaEnd != null) {
                                            // Se a data de término não for nulo
                                            if($yearEnd > 0 && $monthEnd > 0 && $dayEnd > 0) {
                                                echo strftime('%d de %b, %Y',strtotime($mangaEnd));
                                            }
                                            // Se apenas o dia for nulo
                                            else if($yearEnd > 0 && $monthEnd > 0 && $dayEnd <= 0) {
                                                $mangaEnd = $yearEnd.'-'.$monthEnd.'-'.'01';
                                                echo ucfirst(strftime('%b, %Y',strtotime($mangaEnd)));
                                            }
                                            // Se o dia e o mês for nulo
                                            else if($yearEnd > 0 && $monthEnd <= 0 && $dayEnd <= 0) {
                                                $mangaEnd = $yearEnd.'-'.'01'.'-'.'01';
                                                echo strftime('%Y',strtotime($mangaEnd));
                                            }
                                            else {
                                                echo '?';
                                            }
                                        }
                                        else if($mangaStart == null && $mangaEnd == null) {
                                            echo '';
                                        }
                                        else {
                                            echo '?';
                                        }
                                    ?>
                                </span>
                            </li>
                            <li class="clear">
                                <span class="info-span">Gêneros:</span>
                                <span> 
                                    <?php 
                                        if($mangaGenres == null) {
                                            echo 'Desconhecido';
                                        }
                                        else {
                                            echo ($mangaGenres) ;
                                        }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="container-right">
                    <div class="title">
                        <h1 class="title-clear"><?php echo $mangaTitle?></h1>
                        <?php
                            if(isset($_SESSION['userID'])) {
                                if($_SESSION['userPermissions'] > 0) {
                                    echo '<a href="admin-edit.php?config=edit&mangaid='.$mangaID.'" class="edit">(Editar)</a>';
                                }
                            }
                        ?>
                    </div>

                    <div class="ranked">
                        <div class="score">
                            <?php
                                if ($mangaScore > 0) {
                                    echo number_format($mangaScore, 2);
                                }
                                else {
                                    echo 'N/A';
                                }
                            ?>
                            <hr>
                        </div>
                        <div class="members">
                            <?php
                                if ($mangaUsers > 0) {
                                    echo $mangaUsers;
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
                                echo '
                                    <div class="status-score">
                                        <form>
                                            <select class="select" id="mangaStatus" name="status-submit">
                                                <option value="1"'; 
                                                    if (isset($statusSelect1)) {
                                                        echo $statusSelect1;
                                                    } 
                                                echo'>Lendo</option>
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
                                                    echo'>Planeja ler</option>
                                            </select>
                                        </form>

                                        <form>
                                            <select class="select" id="mangaScore" name="score-submit">
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
                                    </div>

                                    <div class="user-chapters">
                                        <span>Chapters:</span>
                                        <form id="mangaChapters">
                                            <input type="text" size="3" value="'.$userChapters.'" name="chapters">
                                        </form>
                                        <span>/</span>
                                        <span>';
                                            if($mangaChapters == null) {
                                                echo '?';
                                            }
                                            else {
                                                echo $mangaChapters;
                                            }
                                        echo '</span>
                                    </div>

                                    <div class="user-volumes">
                                        <span>Volumes:</span>
                                        <form id="mangaVolumes">
                                            <input type="text" size="3" value="'.$userVolumes.'" name="volumes">
                                        </form>
                                        <span>/</span>
                                        <span>';
                                            if($mangaVolumes == null) {
                                                echo '?';
                                            }
                                            else {
                                                echo $mangaVolumes;
                                            }
                                        echo '</span>
                                    </div>
                                    
                                    <div class="user-delete">
                                        <form action="includes/manga-submit.inc.php?mangaid='.$mangaID.'" method="post">
                                            <input type="submit" value="* Remover da lista" id="delete" name="delete">
                                        </form>
                                    </div>';
                            }
                            else {
                                echo '<form action="includes/manga-submit.inc.php?mangaid='.$mangaID.'" method="post">
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
                                if ($mangaSinopse == null) {
                                    echo 'Nenhuma sinopse adicionada a este título.';
                                } 
                                else {
                                    echo $mangaSinopse;
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