<?php
    session_start();
    if(!isset($_SESSION['userID'])) {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }
    else {
        if(!isset($_GET['config']) || $_SESSION['userPermissions'] < 1) {
            header("HTTP/1.1 404 Not Found");
            include "not-found-page.php";
            exit();
        }
        else {
            $config = $_GET['config'];
            if($config != 'add-anime' && $config != 'add-manga' && $config != 'add-character') {
                header("HTTP/1.1 404 Not Found");
                include "not-found-page.php";
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
        Adicionar 
        <?php 
            if($config == "add-anime") {
                echo "Anime";
            }
            else if($config == "add-manga") {
                echo "Manga";
            }
            else if($config == "add-character") {
                echo "Personagem";
            }
        ?>
        - MinhaLista
        </title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/admin.css">
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
                <div class="container-add">

                    <img src="img/logo1.png">
                    <?php
                    /* Anime */
                    if($_GET['config'] == 'add-anime') {
                        /* Opções para selecionar os gêneros */
                        $animeGenresOptions = array("Ação", "Aventura", "Carros", "Comédia", "Dementia", "Dêmonios", "Drama", "Ecchi", "Fantasia", "Jogo", "Harém", "Hentai", "Historical", "Horror", "Josei", "Crianças", "Magia", "Artes Marciais", "Mecha", "Militar", "Música", "Mistério", "Paródia", "Policial", "Psicológico", "Romance", "Samurai", "Escolar", "Ficção Científica", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Fátia de Vida", "Espaço", "Esportes", "Super Poder", "Sobrenatural", "Thriller", "Vampiro", "Yaoi", "Yuri");

                        echo '
                        <form action="includes/admin-add.inc.php?config=add-anime" method="post" enctype="multipart/form-data" id="anime-add">             
                            <h4>Anime *</h4>
                            <input type="text" placeholder="Título do anime" name="title" class="form-input" id="anime-title">
                            <p class="error-messages"></p>

                            <h4>Sinopse</h4>
                            <textarea name="sinopse" placeholder="Sinopse do anime" class="form-input textarea"></textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="avatar" id="avatar-show"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="banner" id="banner-show"></div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Tipo *</h4>   
                            <select name="type" class="form-select">
                                <option value="TV">TV</option>
                                <option value="Filme">Filme</option>
                                <option value="OVA">OVA</option>
                                <option value="ONA">ONA</option>
                            </select>

                            <h4>Episódios</h4>   
                            <input type="text" placeholder="Número de episódios" name="episodes" class="form-input" id="anime-episodes">
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finalizado">Finalizado</option>
                                <option value="Em exibição">Em exibição</option>
                                <option value="Ainda não foi exibido">Ainda não foi exibido</option>
                            </select>

                            <h4>Exibição (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="animeDayStart">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$day.'">'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthStart" class="form-date month" id="animeMonthStart">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$month.'">'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearStart" class="form-date year" id="animeYearStart">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            echo
                            '</select>

                            <select name="dayEnd" class="form-date day" id="animeDayEnd"">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$day.'">'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthEnd" class="form-date month" id="animeMonthEnd">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$month.'">'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearEnd" class="form-date year" id="animeYearEnd">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            echo
                            '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>

                            <h4>Fonte</h4>   
                            <select name="source" class="form-select">
                                <option value="">Selecionar</option>
                                <option value="Manga">Manga</option>
                                <option value="Novel">Novel</option>
                                <option value="Original">Original</option>
                            </select>';
                        
            
                            echo '
                            <h4>Gêneros</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                            foreach($animeGenresOptions as $animeGenreOption) {
                                echo '<option value="'.$animeGenreOption.'">'.$animeGenreOption.'</option>';
                            }
                            echo '</select>
                            
                            <h4>Personagens</h4>
                            <div class="characters-grid">';
                                for($i = 0; $i <= 5; $i++) {
                                    $nameValue = $i+1;
                                    $characterName[] = 'Nome do personagem #'.$nameValue;
                                    echo '
                                    <div class="character-result">
                                        <div class="avatar-characters"></div>
                                        <div class="content-character">
                                            <div class="name">'.$characterName[$i].'</div>  
                                            <input type="text" placeholder="ID do personagem" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Selecionar</option>
                                                <option value="Principal">Principal</option>
                                                <option value="Secundário">Secundário</option>
                                            </select>
                                        </div>
                                    </div>';
                                }
                            echo '</div>
                            
                            <input type="submit" value="Adicionar" name="anime-add" class="btn-submit">
                        </form>';
                    }

                    /* Manga */
                    if($_GET['config'] == 'add-manga') {
                        /* Opções para selecionar os gêneros */
                        $mangaGenresOptions = array("Ação", "Aventura", "Carros", "Comédia", "Dementia", "Dêmonios", "Doujinshi", "Drama", "Ecchi", "Fantasia", "Jogo", "Gênero Bender", "Harém", "Hentai", "Historical", "Horror", "Josei", "Crianças", "Magia", "Artes Marciais", "Mecha", "Militar", "Música", "Mistério", "Paródia", "Policial", "Psicológico", "Romance", "Samurai", "Escolar", "Ficção Científica", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Fátia de Vida", "Espaço", "Esportes", "Super Poder", "Sobrenatural", "Thriller", "Vampiro", "Yaoi", "Yuri");

                        echo '
                        <form action="includes/admin-add.inc.php?config=add-manga" method="post" enctype="multipart/form-data" id="manga-add">             
                            <h4>Manga *</h4>
                            <input type="text" placeholder="Título do manga" name="title" class="form-input" id="manga-title">
                            <p class="error-messages"></p>

                            <h4>Sinopse</h4>
                            <textarea name="sinopse" placeholder="Sinopse do manga" class="form-input textarea"></textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="avatar" id="avatar-show"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="banner" id="banner-show"></div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Tipo *</h4>   
                            <select name="type" class="form-select">
                                <option value="Manga">Manga</option>
                                <option value="Novel">Novel</option>
                            </select>

                            <h4>Capítulos</h4>   
                            <input type="text" placeholder="Número de capitulos" name="chapters" class="form-input" id="manga-chapters">
                            <p class="error-messages"></p>

                            <h4>Volumes</h4>   
                            <input type="text" placeholder="Número de volumes" name="volumes" class="form-input" id="manga-volumes"> 
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finalizado">Finalizado</option>
                                <option value="Em publicação">Em publicação</option>
                                <option value="Ainda não foi publicado">Ainda não foi publicado</option>
                            </select>

                            <h4>Publicação (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="mangaDayStart">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$day.'">'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthStart" class="form-date month" id="mangaMonthStart">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$month.'">'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearStart" class="form-date year" id="mangaYearStart">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            echo
                            '</select>

                            <select name="dayEnd" class="form-date day" id="mangaDayEnd">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$day.'">'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthEnd" class="form-date month" id="mangaMonthEnd">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    echo '<option value="'.$month.'">'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearEnd" class="form-date year" id="mangaYearEnd">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                echo '<option value="'.$year.'">'.$year.'</option>';
                                }
                            echo
                            '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>

                            <h4>Gêneros</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                            foreach($mangaGenresOptions as $mangaGenreOption) {
                                echo '<option value="'.$mangaGenreOption.'">'.$mangaGenreOption.'</option>';
                            }
                            echo '</select>
                            
                            <h4>Personagens</h4>
                            <div class="characters-grid">';
                                for($i = 0; $i <= 5; $i++) {
                                    $nameValue = $i+1;
                                    $characterName[] = 'Nome do personagem #'.$nameValue;
                                    echo '
                                    <div class="character-result">
                                        <div class="avatar-characters"></div>
                                        <div class="content-character">
                                            <div class="name">'.$characterName[$i].'</div>  
                                            <input type="text" placeholder="ID do personagem" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Selecionar</option>
                                                <option value="Principal">Principal</option>
                                                <option value="Secundário">Secundário</option>
                                            </select>
                                        </div>
                                    </div>';
                                }
                            echo '</div>
                            
                            <input type="submit" value="Adicionar" name="manga-add" class="btn-submit">
                        </form>';
                    }

                    /* Personagem */
                    if($_GET['config'] == 'add-character') {
                        echo '
                        <form action="includes/admin-add.inc.php?config=add-character" method="post" enctype="multipart/form-data" id="character-add">             
                            <h4>Personagem *</h4>
                            <input type="text" placeholder="Nome do personagem" name="name" class="form-input" id="character-name">
                            <p class="error-messages"></p>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="avatar" id="avatar-show"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>
                            
                            <h4>Informações</h4>
                            <textarea name="info" placeholder="Informações do personagem" class="form-input textarea"></textarea>
                            
                            <input type="submit" value="Adicionar" name="character-add" class="btn-submit">
                        </form>';
                    }
                    ?>
                </div> <!-- Container -->
            </div> <!-- Container all -->
        </div> <!-- Page-wrap -->
        
        <?php
            include "footer.php";
        ?>

        <script type="text/javascript" src="js/script-admin.js"></script>
        <script type="text/javascript" src="js/script-admin-errors.js"></script>
    </body>
</html>