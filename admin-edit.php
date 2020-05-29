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
            if($config != 'edit') {
                header("HTTP/1.1 404 Not Found");
                include "not-found-page.php";
                exit();
            }
            else {
                if(!isset($_GET['animeid']) && !isset($_GET['mangaid']) && !isset($_GET['characterid']) && !isset($_GET['userid'])) {
                    header("HTTP/1.1 404 Not Found");
                    include "not-found-page.php";
                    exit();
                }
                else {
                    include "includes/admin-edit.inc.php";
                    if(isset($_GET['animeid']) && !isset($animeTitle)) {
                        header("HTTP/1.1 404 Not Found");
                        include "not-found-page.php";
                        exit();
                    }
                    else if(isset($_GET['mangaid']) && !isset($mangaTitle)) {
                        header("HTTP/1.1 404 Not Found");
                        include "not-found-page.php";
                        exit();
                    }
                    else if(isset($_GET['characterid']) && !isset($characterName)) {
                        header("HTTP/1.1 404 Not Found");
                        include "not-found-page.php";
                        exit();
                    }
                    else if(isset($_GET['userid']) && !isset($userName)) {
                        header("HTTP/1.1 404 Not Found");
                        include "not-found-page.php";
                        exit();
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>
            <?php
                echo isset($_GET['animeid']) ? "$animeTitle" : "";
                echo isset($_GET['mangaid']) ? "$mangaTitle" : "";
                echo isset($_GET['characterid']) ? "$characterName" : "";
                echo isset($_GET['userid']) ? "$userName" : "";
            ?>
            | Editar - MinhaLista
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
                <div class="container-edit">
                    <img src="img/logo1.png">
                    <?php
                    /* Anime */
                    if($_GET['config'] == 'edit' && isset($_GET['animeid'])) {
                        /* Verificar a data que o anime começou */
                        $yearStart = substr($animeStart, -10, 4);
                        $monthStart = substr($animeStart, -5, 2);
                        $dayStart = substr($animeStart, -2, 2);

                        /* Verificar a data que o anime terminou */
                        $yearEnd = substr($animeEnd, -10, 4);
                        $monthEnd = substr($animeEnd, -5, 2);
                        $dayEnd = substr($animeEnd, -2, 2);

                        /* Verificar qual o tipo selecionado */
                        $typeTV = $animeType == "TV" ? "selected" : "";
                        $typeMovie = $animeType == "Filme" ? "selected" : "";
                        $typeOVA = $animeType == "OVA" ? "selected" : "";
                        $typeONA = $animeType == "ONA" ? "selected" : "";

                        /* Verificar qual o status selecionado */
                        $statusFinished = $animeStatus == "Finalizado" ? "selected" : "";
                        $statusAiring = $animeStatus == "Em exibição" ? "selected" : "";
                        $statusNotAired = $animeStatus == "Ainda não foi exibido" ? "selected" : "";

                        /* Verificar qual a fonte selecionada */
                        $sourceManga = $animeSource == "Manga" ? "selected" : "";
                        $sourceNovel = $animeSource == "Novel" ? "selected" : "";
                        $sourceOriginal = $animeSource == "Original" ? "selected" : "";

                        /* Opções para selecionar os gêneros e os gêneros já selecionados*/
                        $animeGenresOptions = array("Ação", "Aventura", "Carros", "Comédia", "Dementia", "Dêmonios", "Drama", "Ecchi", "Fantasia", "Jogo", "Harém", "Hentai", "Historical", "Horror", "Josei", "Crianças", "Magia", "Artes Marciais", "Mecha", "Militar", "Música", "Mistério", "Paródia", "Policial", "Psicológico", "Romance", "Samurai", "Escolar", "Ficção Científica", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Fátia de Vida", "Espaço", "Esportes", "Super Poder", "Sobrenatural", "Thriller", "Vampiro", "Yaoi", "Yuri");
                        $animeGenres = explode(", ", $animeGenres);

                        echo '
                        <form action="includes/admin-edit.inc.php?config=edit&animeid='.$animeID.'" method="post" enctype="multipart/form-data" id="anime-edit">        
                            <h4>ID *</h4>     
                            <input type="text" value="'.$animeID.'" name="ID" class="form-input" disabled>

                            <h4>Anime *</h4>
                            <input type="text" value="'.$animeTitle.'" placeholder="Título do anime" name="title" class="form-input" id="anime-title">
                            <p class="error-messages"></p>

                            <h4>Sinopse</h4>
                            <textarea name="sinopse" placeholder="Sinopse do anime" class="form-input textarea">'.$animeSinopse.'</textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(media/anime/avatar/'.$animeAvatar.')"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="banner" id="banner-show" style="background-image:url(media/anime/banner/'.$animeBanner.')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerCheck" id="bannerCheck"> <label for="bannerCheck">Excluir banner do anime</label>
                                </div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Tipo *</h4>   
                            <select name="type" class="form-select">
                                <option value="TV" '.$typeTV.'>TV</option>
                                <option value="Filme" '.$typeMovie.'>Filme</option>
                                <option value="OVA" '.$typeOVA.'>OVA</option>
                                <option value="ONA" '.$typeONA.'>ONA</option>
                            </select>

                            <h4>Episódios</h4>   
                            <input type="text" value="'.$animeEpisodes.'" placeholder="Número de episódios" name="episodes" class="form-input" id="anime-episodes">
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finalizado" '.$statusFinished.'>Finalizado</option>
                                <option value="Em exibição" '.$statusAiring.'>Em exibição</option>
                                <option value="Ainda não foi exibido" '.$statusNotAired.'>Ainda não foi exibido</option>
                            </select>

                            <h4>Exibição (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="animeDayStart">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    if($dayStart == $day) {
                                        $daySS = 'selected';
                                    }
                                    else {
                                        $daySS = '';
                                    }
                                    echo '<option value="'.$day.'" '.$daySS.'>'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthStart" class="form-date month" id="animeMonthStart">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    if($monthStart == $month) {
                                        $monthSS = 'selected';
                                    }
                                    else {
                                        $monthSS = '';
                                    }
                                    echo '<option value="'.$month.'" '.$monthSS.'>'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearStart" class="form-date year" id="animeYearStart">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                    if($yearStart == $year) {
                                        $yearSS = 'selected';
                                    }
                                    else {
                                        $yearSS = '';
                                    }
                                echo '<option value="'.$year.'" '.$yearSS.'>'.$year.'</option>';
                                }
                            echo
                            '</select>

                            <select name="dayEnd" class="form-date day" id="animeDayEnd">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    if($dayEnd == $day) {
                                        $dayES = 'selected';
                                    }
                                    else {
                                        $dayES = '';
                                    }
                                    echo '<option value="'.$day.'" '.$dayES.'>'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthEnd" class="form-date month" id="animeMonthEnd">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    if($monthEnd == $month) {
                                        $monthES = 'selected';
                                    }
                                    else {
                                        $monthES = '';
                                    }
                                    echo '<option value="'.$month.'" '.$monthES.'>'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearEnd" class="form-date year" id="animeYearEnd">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                    if($yearEnd == $year) {
                                        $yearES = 'selected';
                                    }
                                    else {
                                        $yearES = '';
                                    }
                                echo '<option value="'.$year.'" '.$yearES.'>'.$year.'</option>';
                                }
                            echo
                            '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>

                            <h4>Fonte</h4>   
                            <select name="source" class="form-select">
                                <option value="">Selecionar</option>
                                <option value="Manga" '.$sourceManga.'>Manga</option>
                                <option value="Novel" '.$sourceNovel.'>Novel</option>
                                <option value="Original" '.$sourceOriginal.'>Original</option>
                            </select>';
                        
            
                            echo '
                            <h4>Gêneros</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                            foreach($animeGenresOptions as $animeGenreOption) {
                                echo '<option value="'.$animeGenreOption.'"';
                                foreach($animeGenres as $animeGenre) {
                                    if($animeGenre == $animeGenreOption) {
                                        $selected = 'selected';
                                    }
                                    else {
                                        $selected = '';
                                    }   
                                    echo $selected;
                                }
                                echo '>'.$animeGenreOption.'</option>';
                            }
                            echo '</select>
                            
                            <h4>Personagens</h4>
                            <div class="characters-grid">';
                                /* Se não existir 6 personagens no banco de dados do anime */
                                for($i = 0; $i <= 5; $i++) {
                                    if(empty($characterID[$i])) {
                                        $nameValue = $i+1;
                                        $characterID[$i] = '';
                                        $characterName[$i] = 'Nome do personagem #'.$nameValue;
                                        $characterAvatar[$i] = '';
                                        $characterRole[$i] = '';
                                    }
                                }
                            
                                for($i = 0; $i < count($characterID), $i < count($characterName), $i < count($characterAvatar), $i < count($characterRole); $i++) {  
                                    /* Marcar como selecionado se for principal ou secundário */
                                    $characterRoleMain[$i] = $characterRole[$i] == "Principal" ? "selected" : "";
                                    $characterRoleSecondary[$i] = $characterRole[$i] == "Secundário" ? "selected" : "";

                                    echo '
                                    <div class="character-result">
                                        <div class="avatar-characters" style="background-image:url(media/characters/avatar/'.$characterAvatar[$i].')"></div>
                                        <div class="content-character">
                                            <div class="name">'.$characterName[$i].'</div>  
                                            <input type="text" placeholder="ID do personagem" value="'.$characterID[$i].'" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Selecionar</option>
                                                <option value="Principal" '.$characterRoleMain[$i].'>Principal</option>
                                                <option value="Secundário" '.$characterRoleSecondary[$i].'>Secundário</option>
                                            </select>
                                        </div>
                                    </div>';
                                }
                            echo '</div>

                            <input type="submit" value="Editar" name="anime-edit" class="btn-submit">
                        </form>';
                    }

                    /* Manga */
                    if($_GET['config'] == 'edit' && isset($_GET['mangaid'])) {
                        /* Verificar o ano que o manga começou */
                        $yearStart = substr($mangaStart, -10, 4);
                        $monthStart = substr($mangaStart, -5, 2);
                        $dayStart = substr($mangaStart, -2, 2);

                        /* Verificar o ano que o manga terminou */
                        $yearEnd = substr($mangaEnd, -10, 4);
                        $monthEnd = substr($mangaEnd, -5, 2);
                        $dayEnd = substr($mangaEnd, -2, 2);

                        /* Verificar qual o tipo selecionado */
                        $typeManga = $mangaType == "Manga" ? "selected" : "";
                        $typeNovel = $mangaType == "Novel" ? "selected" : "";

                        /* Verificar qual o status selecionado */
                        $statusFinished = $mangaStatus == "Finalizado" ? "selected" : "";
                        $statusPublished = $mangaStatus == "Em publicação" ? "selected" : "";
                        $statusNotPublished = $mangaStatus == "Ainda não foi publicado" ? "selected" : "";

                        /* Opções para selecionar os gêneros e os gêneros já selecionados*/
                        $mangaGenresOptions = array("Ação", "Aventura", "Carros", "Comédia", "Dementia", "Dêmonios", "Doujinshi", "Drama", "Ecchi", "Fantasia", "Jogo", "Gênero Bender", "Harém", "Hentai", "Historical", "Horror", "Josei", "Crianças", "Magia", "Artes Marciais", "Mecha", "Militar", "Música", "Mistério", "Paródia", "Policial", "Psicológico", "Romance", "Samurai", "Escolar", "Ficção Científica", "Seinen", "Shoujo", "Shoujo Ai", "Shounen", "Shounen Ai", "Fátia de Vida", "Espaço", "Esportes", "Super Poder", "Sobrenatural", "Thriller", "Vampiro", "Yaoi", "Yuri");
                        $mangaGenres = explode(", ", $mangaGenres);

                        echo '
                        <form action="includes/admin-edit.inc.php?config=edit&mangaid='.$mangaID.'" method="post" enctype="multipart/form-data" id="manga-edit">    
                            <h4>ID *</h4>    
                            <input type="text" value="'.$mangaID.'" name="ID" class="form-input" disabled>

                            <h4>Manga *</h4>
                            <input type="text" value="'.$mangaTitle.'" placeholder="Título do manga" name="title" class="form-input" id="manga-title">
                            <p class="error-messages"></p>

                            <h4>Sinopse</h4>
                            <textarea name="sinopse" placeholder="Sinopse do manga" class="form-input textarea">'.$mangaSinopse.'</textarea>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(media/manga/avatar/'.$mangaAvatar.')"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>

                            <h4>Banner</h4>
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="banner" id="banner-show" style="background-image:url(media/manga/banner/'.$mangaBanner.')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerCheck" id="bannerCheck"> <label for="bannerCheck">Excluir banner do manga</label>
                                </div>
                            </div>
                            <p class="error-messages e-banner"></p>

                            <h4>Tipo *</h4>   
                            <select name="type" class="form-select">
                                <option value="Manga" '.$typeManga.'>Manga</option>
                                <option value="Novel" '.$typeNovel.'>Novel</option>
                            </select>

                            <h4>Capítulos</h4>   
                            <input type="text" value="'.$mangaChapters.'" placeholder="Número de capitulos" name="chapters" class="form-input" id="manga-chapters">
                            <p class="error-messages"></p>

                            <h4>Volumes</h4>   
                            <input type="text" value="'.$mangaVolumes.'" placeholder="Número de volumes" name="volumes" class="form-input" id="manga-volumes">
                            <p class="error-messages"></p>

                            <h4>Status *</h4>   
                            <select name="status" class="form-select">
                                <option value="Finalizado" '.$statusFinished.'>Finalizado</option>
                                <option value="Em publicação" '.$statusPublished.'>Em publicação</option>
                                <option value="Ainda não foi publicado" '.$statusNotPublished.'>Ainda não foi publicado</option>
                            </select>

                            <h4>Publicação (dd/mm/yyyy)</h4>   
                            <select name="dayStart" class="form-date day" id="mangaDayStart">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    if($dayStart == $day) {
                                        $daySS = 'selected';
                                    }
                                    else {
                                        $daySS = '';
                                    }
                                    echo '<option value="'.$day.'" '.$daySS.'>'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthStart" class="form-date month" id="mangaMonthStart">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    if($monthStart == $month) {
                                        $monthSS = 'selected';
                                    }
                                    else {
                                        $monthSS = '';
                                    }
                                    echo '<option value="'.$month.'" '.$monthSS.'>'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearStart" class="form-date year" id="mangaYearStart">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                    if($yearStart == $year) {
                                        $yearSS = 'selected';
                                    }
                                    else {
                                        $yearSS = '';
                                    }
                                echo '<option value="'.$year.'" '.$yearSS.'>'.$year.'</option>';
                                }
                            echo
                            '</select>

                            <select name="dayEnd" class="form-date day" id="mangaDayEnd">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    if($dayEnd == $day) {
                                        $dayES = 'selected';
                                    }
                                    else {
                                        $dayES = '';
                                    }
                                    echo '<option value="'.$day.'" '.$dayES.'>'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthEnd" class="form-date month" id="mangaMonthEnd">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    if($monthEnd == $month) {
                                        $monthES = 'selected';
                                    }
                                    else {
                                        $monthES = '';
                                    }
                                    echo '<option value="'.$month.'" '.$monthES.'>'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearEnd" class="form-date year" id="mangaYearEnd">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                    if($yearEnd == $year) {
                                        $yearES = 'selected';
                                    }
                                    else {
                                        $yearES = '';
                                    }
                                echo '<option value="'.$year.'" '.$yearES.'>'.$year.'</option>';
                                }
                            echo
                            '</select>
                            <p class="error-messages date"></p>
                            <p class="error-messages date double"></p>
                            <p class="error-messages date double"></p>';

                            echo '
                            <h4>Gêneros</h4>
                            <select multiple size="9" name="genres[]" class="form-select multiple">';
                            foreach($mangaGenresOptions as $mangaGenreOption) {
                                echo '<option value="'.$mangaGenreOption.'"';
                                foreach($mangaGenres as $mangaGenre) {
                                    if($mangaGenre == $mangaGenreOption) {
                                        $selected = 'selected';
                                    }
                                    else {
                                        $selected = '';
                                    }   
                                    echo $selected;
                                }
                                echo '>'.$mangaGenreOption.'</option>';
                            }
                            echo '</select>
                            
                            <h4>Personagens</h4>
                            <div class="characters-grid">';
                                /* Se não existir 6 personagens no banco de dados do anime */
                                for($i = 0; $i <= 5; $i++) {
                                    if(empty($characterID[$i])) {
                                        $nameValue = $i+1;
                                        $characterID[$i] = '';
                                        $characterName[$i] = 'Nome do personagem #'.$nameValue;
                                        $characterAvatar[$i] = '';
                                        $characterRole[$i] = '';
                                    }
                                }
                            
                                for($i = 0; $i < count($characterID), $i < count($characterName), $i < count($characterAvatar), $i < count($characterRole); $i++) {  
                                    /* Marcar como selecionado se for principal ou secundário */
                                    $characterRoleMain[$i] = $characterRole[$i] == "Principal" ? "selected" : "";
                                    $characterRoleSecondary[$i] = $characterRole[$i] == "Secundário" ? "selected" : "";

                                    echo '
                                    <div class="character-result">
                                        <div class="avatar-characters" style="background-image:url(media/characters/avatar/'.$characterAvatar[$i].')"></div>
                                        <div class="content-character">
                                            <div class="name">'.$characterName[$i].'</div>  
                                            <input type="text" placeholder="ID do personagem" value="'.$characterID[$i].'" name="characterID[]" class="form-input-character">
                                            <select name="characterRole[]" class="form-input-character">
                                                <option value="">Selecionar</option>
                                                <option value="Principal" '.$characterRoleMain[$i].'>Principal</option>
                                                <option value="Secundário" '.$characterRoleSecondary[$i].'>Secundário</option>
                                            </select>
                                        </div>
                                    </div>';
                                }
                            echo '</div>
                            
                            <input type="submit" value="Editar" name="manga-edit" class="btn-submit">
                        </form>';
                    }

                    /* Personagens */
                    if($_GET['config'] == 'edit' && isset($_GET['characterid'])) {
                        echo '
                        <form action="includes/admin-edit.inc.php?config=edit&characterid='.$characterID.'" method="post" enctype="multipart/form-data" id="character-edit">   
                            <h4>ID *</h4>              
                            <input type="text" value="'.$characterID.'" name="ID" class="form-input" disabled>

                            <h4>Personagem *</h4>
                            <input type="text" value="'.$characterName.'" placeholder="Nome do personagem" name="name" class="form-input" id="character-name">
                            <p class="error-messages"></p>

                            <h4>Avatar *</h4>   
                            <div class="form-image">
                                <p>Formatos permitidos: JPEG, PNG. Tamanho máximo: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(media/characters/avatar/'.$characterAvatar.')"></div>
                            </div>
                            <p class="error-messages e-avatar"></p>
                            
                            <h4>Informações</h4>
                            <textarea name="info" placeholder="Informações do personagem" class="form-input textarea">'.$characterInfo.'</textarea>
                    
                            <input type="submit" value="Editar" name="character-edit" class="btn-submit">
                        </form>';
                    }

                    /* Usúarios */
                    if($_GET['config'] == 'edit' && isset($_GET['userid'])) {
                        $yearBirthday = substr($userBirthday, -10, 4);
                        $monthBirthday = substr($userBirthday, -5, 2);
                        $dayBirthday = substr($userBirthday, -2, 2);

                        $yearSignUP = substr($userDateSignUP, -10, 4);
                        $monthSignUP = substr($userDateSignUP, -5, 2);
                        $daySignUP = substr($userDateSignUP, -2, 2);

                        $permissionMember = $userPermissions == "0" ? "selected" : "";
                        $permissionAdmin = $userPermissions == "1" ? "selected" : "";

                        $genderNotSpecified = $userGender == "0" ? "selected" : "";
                        $genderMale = $userGender == "1" ? "selected" : "";
                        $genderFemale = $userGender == "2" ? "selected" : "";

                        $userDateSignUP = date('d-m-Y', strtotime($userDateSignUP));
                        $userLastOnline = date('d-m-Y H:i:s', strtotime($userLastOnline));

                        echo '
                        <form action="includes/admin-edit.inc.php?config=edit&userid='.$userID.'" method="post" enctype="multipart/form-data" id="user-edit">             
                            <h4>ID *</h4>    
                            <input type="text" value="'.$userID.'" name="ID" class="form-input" disabled>

                            <h4>Usúario *</h4>
                            <input type="text" value="'.$userName.'" placeholder="Nome do usúario" name="name" class="form-input" id="userName">
                            <p class="error-messages"></p>
                            
                            <h4>Email *</h4>
                            <input type="text" value="'.$userEmail.'" placeholder="Email do usúario" name="email" class="form-input" id="userEmail">
                            <p class="error-messages"></p>

                            <h4>Senha *</h4>
                            <input type="text" value="'.$userPassword.'" class="form-input" disabled>

                            <input type="text" placeholder="Alterar senha do usúario" name="password" class="form-input" id="userPassword">
                            <p class="error-messages"></p>
                            
                            <h4>Permissões *</h4>   
                            <select name="permissions" class="form-select">
                                <option value="0" '.$permissionMember.'>Membro</option>
                                <option value="1" '.$permissionAdmin.'>Administrador</option>
                            </select>
                            
                            <h4>Avatar</h4>   
                            <div class="form-image margin-bottom">
                                <p>Formatos permitidos: JPEG, PNG e GIF. Tamanho máximo: 3mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="avatar" class="file-input" id="avatar">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="avatar" id="avatar-show" style="background-image:url(media/users/avatar/'.$userAvatar.')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="avatarCheck" id="avatarCheck"> <label for="avatarCheck">Excluir avatar do usúario</label>
                                </div>
                            </div>
                            <p class="error-messages e-avatar"></p>
                            
                            <h4>Banner do perfil</h4>
                            <div class="form-image margin-bottom">
                                <p>Formatos permitidos: JPEG, PNG e GIF. Tamanho máximo: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner" class="file-input" id="banner">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="banner" id="banner-show" style="background-image:url(media/users/banner/'.$userBanner.')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerCheck" id="bannerCheck"> <label for="bannerCheck">Excluir banner do usúario</label>
                                </div>
                            </div>
                            <p class="error-messages e-banner"></p>
                            
                            <h4>Banner da lista</h4>
                            <div class="form-image margin-bottom">
                                <p>Formatos permitidos: JPEG, PNG e GIF. Tamanho máximo: 6mb.</p>
                                <div class="dropbox">
                                    <input type="file" name="banner-list" class="file-input" id="bannerList">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                <div class="banner" id="bannerList-show" style="background-image:url(media/users/bannerList/'.$userBannerList.')"></div>
                                <div class="form-checkbox">
                                    <input type="checkbox" name="bannerListCheck" id="bannerListCheck"> <label for="bannerListCheck">Excluir banner da lista do usúario</label>
                                </div>
                            </div>
                            <p class="error-messages e-bannerList"></p>

                            <h4>Sobre</h4>
                            <textarea name="about" placeholder="Sobre o usúario" class="form-input textarea" id="userAbout">'.$userAbout.'</textarea>
                            <p class="error-messages"></p>

                            <h4>Gênero</h4>   
                            <select name="gender" class="form-select">
                                <option value="0" '.$genderNotSpecified.'>Não específicado</option>
                                <option value="1" '.$genderMale.'>Masculino</option>
                                <option value="2" '.$genderFemale.'>Feminino</option>
                            </select>
                            
                            <h4>Data de aniversário (dd/mm/yyyy)</h4>   
                            <select name="dayBirthday" class="form-date day" id="userDay">
                                <option value="00">Selecionar</option>';
                                for($day = 1; $day <= 31; $day++) {
                                    $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                    if($dayBirthday == $day) {
                                        $dayBS = 'selected';
                                    }
                                    else {
                                        $dayBS = '';
                                    }
                                    echo '<option value="'.$day.'" '.$dayBS.'>'.$day.'</option>';
                                }
                            echo 
                            '</select>

                            <select name="monthBirthday" class="form-date month" id="userMonth">
                                <option value="00">Selecionar</option>';
                                for($month = 1; $month <= 12; $month++) {
                                    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                    if($monthBirthday == $month) {
                                        $monthBS = 'selected';
                                    }
                                    else {
                                        $monthBS = '';
                                    }
                                    echo '<option value="'.$month.'" '.$monthBS.'>'.$month.'</option>';
                            }
                            echo 
                            '</select>

                            <select name="yearBirthday" class="form-date year" id="userYear">
                                <option value="0000">Selecionar</option>';
                                for($year = 2020; $year >= 1930; $year--) {
                                    $year = str_pad($year, 2, 0, STR_PAD_LEFT);
                                    if($yearBirthday == $year) {
                                        $yearBS = 'selected';
                                    }
                                    else {
                                        $yearBS = '';
                                    }
                                echo '<option value="'.$year.'" '.$yearBS.'>'.$year.'</option>';
                                }
                            echo
                            '</select>
                            <p class="error-messages date"></p>
                            
                            <h4 class="margin">Localização</h4>
                            <input type="text" value="'.$userLocalization.'" placeholder="Localização do usúario" name="localization" class="form-input" id="userLocalization">
                            <p class="error-messages"></p>
            
                            <h4>Data de cadastro(dd/mm/yyyy)</h4>   
                            <input type="text" value="'.$userDateSignUP.'" class="form-input" disabled>
                            
                            <h4>Ultima vez online</h4>
                            <input type="text" value="'.$userLastOnline.'" class="form-input" disabled>';

                            if($_GET['userid'] != $_SESSION['userID']) {
                                if($userBanStatus == 1) {
                                    echo '<input type="submit" value="Desbanir" name="user-desban" class="btn-submit ban">';
                                }
                                else {
                                    echo '<input type="submit" value="Banir" name="user-ban" class="btn-submit desban">';
                                }
                            }

                            echo '<input type="submit" value="Editar" name="user-edit" class="btn-submit">
                        </form>';
                    }
                    ?>
                </div> <!-- Container edit -->
            </div> <!-- Container all -->
        </div> <!-- Page wrap -->

        <?php
            include "footer.php";
        ?>

        <script type="text/javascript" src="js/script-admin.js"></script>
        <script type="text/javascript" src="js/script-admin-errors.js"></script>
    </body>
</html>