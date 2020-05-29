<?php
    include "db.inc.php";
    if(isset($_GET['userid']) && isset($_GET['status']) && $_GET['status'] > 0 && $_GET['status'] < 6) {
        $userID = $_GET['userid'];
        $userStatus = $_GET['status'];
        
        if($userStatus != '5') {
           $sql = "SELECT m.mangaID, m.mangaTitle, m.mangaAvatar, m.mangaType, m.mangaChapters, m.mangaVolumes, mu.userStatus, mu.userScore, mu.userChapters, mu.userVolumes FROM manga m JOIN manga_users mu ON m.mangaID=mu.mangaID WHERE userID=? AND userStatus=? ORDER BY userStatus, mangaTitle"; 
        }
        else {
            $sql = "SELECT m.mangaID, m.mangaTitle, m.mangaAvatar, m.mangaType, m.mangaChapters, m.mangaVolumes, mu.userStatus, mu.userScore, mu.userChapters, mu.userVolumes FROM manga m JOIN manga_users mu ON m.mangaID=mu.mangaID WHERE userID=?
            ORDER BY userStatus, mangaTitle"; 
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
            $mangaID = array();
            $mangaTitle = array();
            $mangaAvatar = array();
            $mangaType = array();
            $mangaChapters = array();
			$mangaVolumes = array();
            $userStatus = array();
            $userScore = array();
            $userChapters = array();
			$userVolumes = array();
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $mangaID[] = $row['mangaID'];
                    $mangaTitle[] = $row['mangaTitle'];
                    $mangaAvatar[] = $row['mangaAvatar'];
                    $mangaType[] = $row['mangaType'];
                    $mangaChapters[] = $row['mangaChapters'];
					$mangaVolumes[] = $row['mangaVolumes'];
                    $userStatus[] = $row['userStatus'];
                    $userScore[] = $row['userScore'];
                    $userChapters[] = $row['userChapters'];
					$userVolumes[] = $row['userVolumes'];
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