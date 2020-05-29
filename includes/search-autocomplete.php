<?php
    include "db.inc.php";

    if(isset($_GET['term'])) {
        /* Valor digitado */
        $searchValue = "%{$_GET['term']}%";

        /* Pesquisar por anime */
        $sql = "SELECT animeID, animeTitle, animeAvatar FROM anime WHERE animeTitle LIKE ? ORDER BY animeTitle LIMIT 2";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $searchValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckUsers = mysqli_num_rows($result);
            if($resultCheckUsers < 0) {
                echo 'Nenhum usúario encontrado';
            } 
            else {
                $userID = array();
                $userName = array();
                $userAvatar = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = '
                    <a href="anime.php?animeid='.$row['animeID'].'" class="search-autocomplete-clear">
                        <div class="container-autocomplete">
                            <div class="search-autocomplete-image" style="background-image:url(media/anime/avatar/'.$row['animeAvatar'].')"></div>
                            <div class="search-autocomplete-content">'.$row['animeTitle'].'</div>
                        </div>
                    </a>';
                }
            }   
        }

        /* Pesquisar por manga */
        $sql = "SELECT mangaID, mangaTitle, mangaAvatar FROM manga WHERE mangaTitle LIKE ? ORDER BY mangaTitle LIMIT 2";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $searchValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckUsers = mysqli_num_rows($result);
            if($resultCheckUsers < 0) {
                echo 'Nenhum usúario encontrado';
            } 
            else {
                $userID = array();
                $userName = array();
                $userAvatar = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = '
                    <a href="manga.php?mangaid='.$row['mangaID'].'" class="search-autocomplete-clear">
                        <div class="container-autocomplete">
                            <div class="search-autocomplete-image" style="background-image:url(media/manga/avatar/'.$row['mangaAvatar'].')"></div>
                            <div class="search-autocomplete-content">'.$row['mangaTitle'].'</div>
                        </div>
                    </a>';
                }
            }   
        }

        /* Pesquisar por personagens */
        $sql = "SELECT characterID, characterName, characterAvatar FROM characters WHERE characterName LIKE ? ORDER BY characterName LIMIT 2";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $searchValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckUsers = mysqli_num_rows($result);
            if($resultCheckUsers < 0) {
                echo 'Nenhum usúario encontrado';
            } 
            else {
                $userID = array();
                $userName = array();
                $userAvatar = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $data[] = '
                    <a href="characters.php?characterid='.$row['characterID'].'" class="search-autocomplete-clear">
                        <div class="container-autocomplete">
                            <div class="search-autocomplete-image" style="background-image:url(media/characters/avatar/'.$row['characterAvatar'].')"></div>
                            <div class="search-autocomplete-content">'.$row['characterName'].'</div>
                        </div>
                    </a>';
                }
            }   
        }

        /* Pesquisar por usúarios */
        $sql = "SELECT userID, userName, userAvatar FROM users WHERE userName LIKE ? ORDER BY userName LIMIT 2";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $searchValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckUsers = mysqli_num_rows($result);
            if($resultCheckUsers < 0) {
                echo 'Nenhum usúario encontrado';
            } 
            else {
                $userID = array();
                $userName = array();
                $userAvatar = array();
                while($row = mysqli_fetch_assoc($result)) {
                    if(empty($row['userAvatar'])) {
                        $row['userAvatar'] = "avatarDefault.png";
                    }
                    $data[] = '
                    <a href="profile.php?userid='.$row['userID'].'" class="search-autocomplete-clear">
                        <div class="container-autocomplete">
                            <div class="search-autocomplete-image" style="background-image:url(media/users/avatar/'.$row['userAvatar'].')"></div>
                            <div class="search-autocomplete-content">'.$row['userName'].'</div>
                        </div>
                    </a>';
                }
            }   
        }
        /* Mostrar resultado */
        echo json_encode($data);
    }
    else {
        header("Location: ../index.php");
    }
?>