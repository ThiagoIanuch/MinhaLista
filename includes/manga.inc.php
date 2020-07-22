<?php
    include "db.inc.php";    

    if(isset($_GET['mangaid'])) {
        $mangaID = $_GET['mangaid'];
    }

    // Dados gerais
    $sql = "SELECT * FROM manga WHERE mangaID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Erro ao preparar as declarações';
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $mangaID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $mangaID = $row['mangaID'];
                $mangaTitle = $row['mangaTitle'];
                $mangaSinopse = $row['mangaSinopse'];
                $mangaAvatar = $row['mangaAvatar'];
                $mangaBanner = $row['mangaBanner'];
                $mangaType = $row['mangaType'];
                $mangaChapters = $row['mangaChapters'];
                $mangaVolumes = $row['mangaVolumes'];
                $mangaStatus = $row['mangaStatus'];
                $mangaStart = $row['mangaStart'];
                $mangaEnd = $row['mangaEnd'];
                $mangaGenres = $row['mangaGenres'];
            }
        }
        else {
            header("HTTP/1.1 404 Not Found");
            include "not-found-page.php";
            exit();
        }
    }

    // Usúario já adicionou na lista ou não / status em que o mangá se encontra pro usúario
    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $sql = "SELECT userID, userStatus, userScore, userChapters, userVolumes FROM manga_users WHERE mangaID=? AND userID=?";   
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mangaID, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userAdd = $row['userID'];
                    $userStatus = $row['userStatus'];
                    $userScore = $row['userScore'];
                    $userChapters = $row['userChapters'];
                    $userVolumes = $row['userVolumes'];
                    if(isset($userStatus)) {
                        switch ($userStatus) {
                            case "1";
                                $statusSelect1 = 'selected';
                            break;
                            case "2";
                                $statusSelect2 = 'selected';
                            break;
                            case "3";
                                $statusSelect3 = 'selected';
                            break;
                            case "4";
                                $statusSelect4 = 'selected';
                            break;
                        }
                    }

                    if(isset($userScore)) {
                        switch ($userScore) {
                            case "1";
                                $scoreSelect1 = 'selected';
                                break;
                            case "2";
                                $scoreSelect2 = 'selected';
                            break;
                            case "3";
                                $scoreSelect3 = 'selected';
                            break;
                            case "4";
                                $scoreSelect4 = 'selected';
                            break;
                            case "5";
                                $scoreSelect5 = 'selected';
                            break;
                            case "6";
                                $scoreSelect6 = 'selected';
                            break;
                            case "7";
                                $scoreSelect7 = 'selected';
                            break;
                            case "8";
                                $scoreSelect8 = 'selected';
                            break;
                            case "9";
                                $scoreSelect9 = 'selected';
                            break;
                            case "10";
                                $scoreSelect10 = 'selected';
                            break;
                        }
                    }
                }            
            } 
        }
    }

    // Saber se úsuario adicionou os favoritos
    if(isset($_SESSION['userID'])) {
        $sql = "SELECT ID FROM manga_favorites WHERE mangaID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mangaID, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userAddFavorite = $row['ID'];
                }
            }
        }
    }
    
    // Pontuação e número de membros do mangá
    $sql = "SELECT userScore, AVG(userScore), userID, count(*) mangaUsers, userID FROM manga_users WHERE mangaID=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Erro ao preparar as declarações';
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $mangaID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $mangaScore = $row['AVG(userScore)'];
            $mangaUsers = $row['mangaUsers'];
        }
    }
?>
