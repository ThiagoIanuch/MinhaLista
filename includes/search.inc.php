<?php
    include "db.inc.php";
    $lastURL = $_SERVER['HTTP_REFERER'];

    if(isset($_POST['search-submit'])) {
        if(strlen($_POST['search']) > 0) {
        header("Location: ../search.php?s=".$_POST['search']); 
        }
        else {
            header("Location: ".$lastURL);
        }
    }


    if(isset($_GET['s'])) {
        // Valor da pesquisas
        $searchValue = "%{$_GET['s']}%";

        // Pesquisar por anime
        $sql = "SELECT animeID, animeTitle, animeAvatar, animeType, animeEpisodes, animeStatus, animeGenres FROM anime WHERE animeTitle LIKE ? ORDER BY animeTitle LIMIT 10";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $searchValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckAnime = mysqli_num_rows($result);
            if($resultCheckAnime < 0) {
                echo 'Nenhum anime encontrado encontrado';
            } 
            else {
                $animeID = array();
                $animeTitle = array();
                $animeAvatar = array();
                $animeType = array();
                $animeEpisodes = array();
                $animeStatus = array();
                $animeGenres = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $animeID[] = $row['animeID'];
                    $animeTitle[] = $row['animeTitle'];
                    $animeAvatar[] = $row['animeAvatar'];
                    $animeType[] = $row['animeType'];
                    $animeEpisodes[] = $row['animeEpisodes'];
                    $animeStatus[] = $row['animeStatus'];
                    $animeGenres[] = $row['animeGenres'];
                }
            }
        }

        // Pesquisar por manga
        $sql = "SELECT mangaID, mangaTitle, mangaAvatar, mangaType, mangaVolumes, mangaStatus, mangaGenres FROM manga WHERE mangaTitle LIKE ? ORDER BY mangaTitle LIMIT 10";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $searchValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckManga= mysqli_num_rows($result);
            if($resultCheckManga < 0) {
                echo 'Nenhum anime encontrado encontrado';
            } 
            else {
                $mangaID = array();
                $mangaTitle = array();
                $mangaAvatar = array();
                $mangaType = array();
                $mangaVolumes = array();
                $mangaStatus = array();
                $mangaGenres = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $mangaID[] = $row['mangaID'];
                    $mangaTitle[] = $row['mangaTitle'];
                    $mangaAvatar[] = $row['mangaAvatar'];
                    $mangaType[] = $row['mangaType'];
                    $mangaVolumes[] = $row['mangaVolumes'];
                    $mangaStatus[] = $row['mangaStatus'];
                    $mangaGenres[] = $row['mangaGenres'];
                }
            }
        }
        
        // Pesquisar por personagens
        $sql = "SELECT characterID, characterName, characterAvatar FROM characters WHERE characterName LIKE ? ORDER BY characterName LIMIT 10";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $searchValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckCharacter = mysqli_num_rows($result);
            if($resultCheckCharacter < 0) {
                echo 'Nenhum anime encontrado encontrado';
            } 
            else {
                $characterID = array();
                $characterName = array();
                $characterAvatar = array();
                $characterRole = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $characterID[] = $row['characterID'];
                    $characterName[] = $row['characterName'];
                    $characterAvatar[] = $row['characterAvatar'];
                }
            }
        }

        // Pesquisar por usuários
        $sql = "SELECT userID, userName, userAvatar, userDate, userGender FROM users WHERE userName LIKE ? ORDER BY userName LIMIT 10";
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
                echo 'Nenhum usuário encontrado';
            } 
            else {
                $userID = array();
                $userName = array();
                $userAvatar = array();
                $userDate = array();
                $userGender = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $userID[] = $row['userID'];
                    $userName[] = $row['userName'];
                    $userAvatar[] = $row['userAvatar'];
                    $userDate[] = $row['userDate'];
                    $userGender[] = $row['userGender'];
                }
            }
        }
    }
?>