<?php
    include "db.inc.php";
    if(isset($_GET['userid']) && isset($_GET['status']) && $_GET['status'] > 0 && $_GET['status'] < 6) {
        $userID = $_GET['userid'];
        $userStatus = $_GET['status'];
        
        if($userStatus != '5') {
           $sql = "SELECT a.animeID, a.animeTitle, a.animeAvatar, a.animeType, a.animeEpisodes, au.userStatus, au.userScore,au.userEpisodes FROM anime a JOIN anime_users au ON a.animeID=au.animeID WHERE userID=? AND userStatus=? ORDER BY userStatus, animeTitle"; 
        }
        else {
            $sql = "SELECT a.animeID, a.animeTitle, a.animeAvatar, a.animeType, a.animeEpisodes, au.userStatus, au.userScore,au.userEpisodes FROM anime a JOIN anime_users au ON a.animeID=au.animeID WHERE userID=?
            ORDER BY userStatus, animeTitle"; 
        }
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            if($userStatus != '5') {
                mysqli_stmt_bind_param($stmt, "ss", $userID, $userStatus);
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $userID);
            }
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            $animeID = array();
            $animeTitle = array();
            $animeAvatar = array();
            $animeType = array();
            $animeEpisodes = array();
            $userStatus = array();
            $userScore = array();
            $userEpisodes = array();
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $animeID[] = $row['animeID'];
                    $animeTitle[] = $row['animeTitle'];
                    $animeAvatar[] = $row['animeAvatar'];
                    $animeType[] = $row['animeType'];
                    $animeEpisodes[] = $row['animeEpisodes'];
                    $userStatus[] = $row['userStatus'];
                    $userScore[] = $row['userScore'];
                    $userEpisodes[] = $row['userEpisodes'];
                }
            } 
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }

    if(isset($_GET['userid'])) {
        $sql = "SELECT userName, userBannerList FROM users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck2 = mysqli_num_rows($result);
            if($resultCheck2 > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $userName = $row['userName'];
                    $userBannerList = $row['userBannerList'];
                }
            }
            else {
                header("HTTP/1.1 404 Not Found");
                include "not-found-page.php";
                exit();
            }
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }
?>