<?php
    session_start();
    if(!isset($_SESSION['userID'])) {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }
    else {
        if(!isset($_GET['view']) || $_SESSION['userPermissions'] < 1) {
            header("HTTP/1.1 404 Not Found");
            include "not-found-page.php";
            exit();
        }
        else {
            $view = $_GET['view'];
            if($view != 'anime' && $view != 'manga' && $view != 'characters' && $view != 'users') {
                header("HTTP/1.1 404 Not Found");
                include "not-found-page.php";
                exit();
            }
        }
        include "includes/admin.inc.php";   
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head> 
        <title>
            <?php
                echo $view == "anime" ? 'Anime | ' : '';
                echo $view == "manga" ? 'Manga | ' : '';
                echo $view == "characters" ? 'Personagens | ' : '';
                echo $view == "users" ? 'Usúarios | ' : '';
            ?>
            Painel de Controle - MinhaLista
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
                <!-- Logo  -->
                <div class="logo">
                    <img src="img/logo1.png">
                </div>
                <!--  -->

                <!-- Menu view -->
                <div class="view-menu">
                    <a href="admin.php?view=anime&page=1" class="btn-view">Anime</a>
                    <a href="admin.php?view=manga&page=1" class="btn-view">Manga</a>
                    <a href="admin.php?view=characters&page=1" class="btn-view">Personagens</a>
                    <a href="admin.php?view=users&page=1" class="btn-view">Usúarios</a>
                </div>
                <!--  -->

                <div class="container">
                    <div class="page-buttons-top">
                        <?php
                            $pageSum = 1;
                            $pageNext = $page+$pageSum;
                            $pagePrevious = $page-$pageSum;

                            // Página anterior
                            if($view == "anime") {
                                if($page <= $total_pages && $page != 1) {
                                    echo '<a href="admin.php?view=anime&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                                }
                            }
                            else if($view == "manga") {
                                if($page <= $total_pages && $page != 1) {
                                    echo '<a href="admin.php?view=manga&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                                }
                            }
                            else if($view == "characters") {
                                if($page <= $total_pages && $page != 1) {
                                    echo '<a href="admin.php?view=characters&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                                }
                            }
                            else if($view == "users") {
                                if($page <= $total_pages && $page != 1) {
                                    echo '<a href="admin.php?view=users&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                                }
                            }

                            // Próxima página
                            if($view == "anime") {
                                if($page < $total_pages) {
                                    echo '<a href="admin.php?view=anime&page='.$pageNext.'" class="page-button">Próximo</a>';
                                }
                            }
                            else if($view == "manga") {
                                if($page < $total_pages) {
                                    echo '<a href="admin.php?view=manga&page='.$pageNext.'" class="page-button">Próximo</a>';
                                }
                            }
                            else if($view == "characters") {
                                if($page < $total_pages) {
                                    echo '<a href="admin.php?view=characters&page='.$pageNext.'" class="page-button">Próximo</a>';
                                }
                            }
                            else if($view == "users") {
                                if($page < $total_pages) {
                                    echo '<a href="admin.php?view=users&page='.$pageNext.'" class="page-button">Próximo</a>';
                                }
                            }
                        ?>
                    </div>

                    <?php
                    // Anime
                    if($view == 'anime') {
                    echo '
                    <div class="anime-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Título</div>
                        </div>

                        <div class="grid-content">';
                            for($i = 0; $i < count($animeDBID), $i < count($animeDBTitle); $i++) {

                            echo '
                                <div class="grid-content-result">
                                    <div class="content">'.$animeDBID[$i].'</div>
                                    <div class="title"><a href="anime.php?animeid='.$animeDBID[$i].'" class="clear">'.$animeDBTitle[$i].'</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&animeid='.$animeDBID[$i].'" target="_blank" class="clear">Editar</a>
                                    </div>
                                </div>';
                            }
                            echo '
                        </div>

                        <div class="grid-bottom">
                            <span></span>
                            <span></span>
                            <span class="add">
                                <a href="admin-add.php?config=add-anime" target="_blank" class="clear">Adicionar</a>
                            </span>
                        </div>
                    </div>'; // Anime
                    }
                    ?>

                <?php
                    // Manga
                    if($view == 'manga') {
                    echo '
                    <div class="manga-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Título</div>
                        </div>

                        <div class="grid-content">';
                            for($i = 0; $i < count($mangaDBID), $i < count($mangaDBTitle); $i++) {

                            echo '
                                <div class="grid-content-result">
                                    <div class="content">'.$mangaDBID[$i].'</div>
                                    <div class="title"><a href="manga.php?mangaid='.$mangaDBID[$i].'" class="clear">'.$mangaDBTitle[$i].'</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&mangaid='.$mangaDBID[$i].'" target="_blank" class="clear">Editar</a>
                                    </div>
                                </div>';
                            }
                            echo '
                        </div>

                        <div class="grid-bottom">
                            <span></span>
                            <span></span>
                            <span class="add">
                                <a href="admin-add.php?config=add-manga" target="_blank" class="clear">Adicionar</a>
                            </span>
                        </div>
                    </div>'; // Manga
                    }
                ?>

                <?php
                    // Personagens
                    if($view == 'characters') {
                    echo '
                    <div class="characters-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Nome</div>
                        </div>

                        <div class="grid-content">';
                            for($i = 0; $i < count($characterDBID), $i < count($characterDBName); $i++) {

                            echo '
                                <div class="grid-content-result">
                                    <div class="content">'.$characterDBID[$i].'</div>
                                    <div class="title"><a href="characters.php?characterid='.$characterDBID[$i].'" class="clear">'.$characterDBName[$i].'</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&characterid='.$characterDBID[$i].'" target="_blank" class="clear">Editar</a>
                                    </div>
                                </div>';
                            }
                            echo '
                        </div>

                        <div class="grid-bottom">
                            <span></span>
                            <span></span>
                            <span class="add">
                                <a href="admin-add.php?config=add-character" target="_blank" class="clear">Adicionar</a>
                            </span>
                        </div>
                    </div>'; // Personagens
                    }
                ?>

                <?php
                    // Usuários
                    if($view == 'users') {
                    echo '
                    <div class="users-container">
                        <div class="grid-header">
                            <div class="content">ID</div>
                            <div class="content">Nome</div>
                        </div>

                        <div class="grid-content">';
                            for($i = 0; $i < count($userDBID), $i < count($userDBName); $i++) {

                            echo '
                                <div class="grid-content-result">
                                    <div class="content">'.$userDBID[$i].'</div>
                                    <div class="title"><a href="profile.php?userid='.$userDBID[$i].'" class="clear">'.$userDBName[$i].'</a></div>
                                    <div class="edit">
                                        <a href="admin-edit.php?config=edit&userid='.$userDBID[$i].'" target="_blank"  class="clear">Editar</a>
                                    </div>
                                </div>';
                            }
                            echo '
                        </div>

                        <div class="grid-bottom users">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>'; // Usúarios
                    }
                ?>
                </div> <!-- Container -->
            </div> <!-- Container all -->
        </div> <!-- Page-wrap -->

        <?php
            include "footer.php";
        ?>

        <script type="text/javascript" src="js/script-admin.js"></script>
    </body>
</html>