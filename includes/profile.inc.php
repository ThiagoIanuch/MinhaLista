<?php
    include "db.inc.php";
    if(isset($_GET['userid'])) {
        $userID = $_GET['userid'];
    }

    // Informações do usúario
    if(isset($userID)) {
        $sql = "SELECT userName, userPermissions, userAvatar, userBanner, userAbout, userGender, userBirthday, userLocalization, userDate, userOnlineStatus, userBanStatus FROM users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "Erro ao preparar as declarações";
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $num_rows = mysqli_num_rows($result);
            if ($num_rows < 0) {
                header("HTTP/1.1 404 Not Found");
                include "not-found-page.php";
                exit();
            }
            else if ($num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $userName = $row['userName'];
                    $userPermissions = $row['userPermissions'];
                    $userAvatar = $row['userAvatar'];
                    $userBanner = $row['userBanner'];
                    $userAbout = $row['userAbout'];
                    $userGender = $row['userGender'];
                    $userBirthday = $row['userBirthday'];
                    $userDate = $row['userDate'];
                    switch($userGender) {
                        case "0": 
                            $userGender = 'Não específicado';
                        break;
                        case "1";
                            $userGender = "Masculino";
                        break;
                        case "2";
                            $userGender = "Feminino";
                        break;
                    }
                    $userLocalization = $row['userLocalization'];
                    $userOnlineStatus = $row['userOnlineStatus'];
                    $userBanStatus = $row['userBanStatus'];
                }
            }
            else {
                header("HTTP/1.1 404 Not Found");
                include "not-found-page.php";
                exit();
            }
        }
    }

    // Se o usúario estiver banido, mover para página de banido
    if($userBanStatus == 1) {
        header("HTTP/1.1 404 Not Found");
        include "profile-banned.php";
        exit();
    }

    // Contar o número de anime em cada status
    if(isset($_GET['userid'])) {
        $userID = $_GET['userid'];
        $sql = "SELECT userStatus, count(*) AS statusCount FROM anime_users WHERE userID=? GROUP BY userStatus";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $userStatus = array();
            $statusCount = array();
            while ($row = mysqli_fetch_row($result)) {
                $userStatus[] = $row[0];
                $statusCount[] = $row[1];
            }
            if (isset($userStatus[0])) {
                switch ($userStatus[0]) {
                    case "1":
                        $animeWatching = $statusCount[0];
                        break;
                    case "2";
                        $animeCompleted = $statusCount[0];
                        break;
                    case "3";
                        $animeDropped = $statusCount[0];
                        break;
                    case "4";
                        $animePlanToWatch = $statusCount[0];
                        break;
                }
            }

            if(isset($userStatus[1])) {
                switch ($userStatus[1]) {
                    case "1":
                        $animeWatching = $statusCount[1];
                        break;
                    case "2";
                        $animeCompleted = $statusCount[1];
                        break;
                    case "3";
                        $animeDropped = $statusCount[1];
                        break;
                    case "4";
                        $animePlanToWatch = $statusCount[1];
                        break;
                }
            }

            if(isset($userStatus[2])) {
                switch ($userStatus[2]) {
                    case "1":
                        $animeWatching = $statusCount[2];
                        break;
                    case "2";
                        $animeCompleted = $statusCount[2];
                        break;
                    case "3";
                        $animeDropped = $statusCount[2];
                        break;
                    case "4";
                        $animePlanToWatch = $statusCount[2];
                        break;
                }
            }

            if(isset($userStatus[3])) {
                switch ($userStatus[3]) {
                    case "1":
                        $animeWatching = $statusCount[3];
                        break;
                    case "2";
                        $animeCompleted = $statusCount[3];
                        break;
                    case "3";
                        $animeDropped = $statusCount[3];
                        break;
                    case "4";
                        $animePlanToWatch = $statusCount[3];
                        break;
                }
            }
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }

    // Contar o número de manga em cada status
    if(isset($_GET['userid'])) {
        $userID = $_GET['userid'];
        $sql = "SELECT userStatus, count(*) AS statusCount FROM manga_users WHERE userID=? GROUP BY userStatus";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $userStatus = array();
            $statusCount = array();
            while ($row = mysqli_fetch_row($result)) {
                $userStatus[] = $row[0];
                $statusCount[] = $row[1];
            }
            if (isset($userStatus[0])) {
                switch ($userStatus[0]) {
                    case "1":
                        $mangaReading = $statusCount[0];
                        break;
                    case "2";
                        $mangaCompleted = $statusCount[0];
                        break;
                    case "3";
                        $mangaDropped = $statusCount[0];
                        break;
                    case "4";
                        $mangaPlanToReading = $statusCount[0];
                        break;
                }
            }

            if(isset($userStatus[1])) {
                switch ($userStatus[1]) {
                    case "1":
                        $mangaReading = $statusCount[1];
                        break;
                    case "2";
                        $mangaCompleted = $statusCount[1];
                        break;
                    case "3";
                        $mangaDropped = $statusCount[1];
                        break;
                    case "4";
                        $mangaPlanToReading = $statusCount[1];
                        break;
                }
            }

            if(isset($userStatus[2])) {
                switch ($userStatus[2]) {
                    case "1":
                        $mangaReading = $statusCount[2];
                        break;
                    case "2";
                        $mangaCompleted = $statusCount[2];
                        break;
                    case "3";
                        $mangaDropped = $statusCount[2];
                        break;
                    case "4";
                        $mangaPlanToReading = $statusCount[2];
                        break;
                }
            }

            if(isset($userStatus[3])) {
                switch ($userStatus[3]) {
                    case "1":
                        $mangaReading = $statusCount[3];
                        break;
                    case "2";
                        $mangaCompleted = $statusCount[3];
                        break;
                    case "3";
                        $mangaDropped = $statusCount[3];
                        break;
                    case "4";
                        $mangaPlanToReading = $statusCount[3];
                        break;
                }
            }
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }

    // Total de animes adicionados e total de episódios
    if(isset($_GET['userid'])) {
        $sql = "SELECT userID, count(userStatus) AS animeStatusTotal, SUM(userEpisodes) AS animeEpisodesTotal FROM anime_users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                $animeStatusTotal = $row['animeStatusTotal'];
                $animeEpisodesTotal= $row['animeEpisodesTotal'];
            }
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }

    // Total de manga adicionados e total de capítulos e volumes
    if(isset($_GET['userid'])) {
        $sql = "SELECT userID, count(userStatus) AS mangaStatusTotal, SUM(userChapters) AS mangaChaptersTotal, SUM(userVolumes) AS mangaVolumesTotal FROM manga_users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                $mangaStatusTotal = $row['mangaStatusTotal'];
                $mangaChaptersTotal= $row['mangaChaptersTotal'];
                $mangaVolumesTotal= $row['mangaVolumesTotal'];
            }
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }

    // Lista de animes favoritos
    if(isset($_GET['userid'])) {
        $sql = "SELECT a.animeAvatar, a.animeID, a.animeTitle FROM anime a JOIN anime_favorites af ON a.animeID = af.animeID WHERE userID=? ORDER BY af.ID";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                $animeFavorites = array();
                $animeID = array();
                $animeTitle = array();
                while($row = mysqli_fetch_assoc($result)) {
                $animeFavorites[] = $row['animeAvatar'];
                $animeID[] = $row['animeID'];
                $animeTitle[] = $row['animeTitle'];
                }
            }
        }
    }

    // Lista de manga favoritos
    if(isset($_GET['userid'])) {
        $sql = "SELECT m.mangaAvatar, m.mangaID, m.mangaTitle FROM manga m JOIN manga_favorites mf ON m.mangaID = mf.mangaID WHERE userID=? ORDER BY mf.ID";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                $mangaFavorites = array();
                $mangaID = array();
                $mangaTitle = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $mangaFavorites[] = $row['mangaAvatar'];
                    $mangaID[] = $row['mangaID'];
                    $mangaTitle[] = $row['mangaTitle'];
                }
            }
        }
    }

    // Lista de personagens favoritos
    if(isset($_GET['userid'])) {
        $sql = "SELECT c.characterAvatar, c.characterID, c.characterName FROM characters c JOIN characters_favorites cf ON c.characterID = cf.characterID WHERE userID=? ORDER BY cf.ID";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                $charactersFavorites = array();
                $characterID = array();
                $characterName = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $charactersFavorites[] = $row['characterAvatar'];
                    $characterID[] = $row['characterID'];
                    $characterName[] = $row['characterName'];
                }
            }
        }
    }
?>