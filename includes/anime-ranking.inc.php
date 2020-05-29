<?php
    include "includes/db.inc.php";
    // Anime ranking
    if (isset($_GET['page']) && $_GET['page'] > 0) {
        $page = $_GET['page'];
        $anime_per_page = 5;
        $anime_per_page_start = ($page-1) * $anime_per_page; 

        $sql = "SELECT a.animeID, a.animeTitle, a.animeAvatar, a.animeType, a.animeEpisodes, a.animeStart, a.animeEnd, COUNT(au.userID) AS animeUsers, AVG(userScore) AS animeScore FROM anime a LEFT JOIN anime_users au ON a.animeID=au.animeID GROUP BY animeID ORDER BY animeScore DESC, animeTitle LIMIT $anime_per_page_start, $anime_per_page";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $animeID = array();  
            $animeTitle = array();
            $animeAvatar = array();
            $animeType = array();
            $animeEpisodes = array();
            $animeStart = array();
            $animeEnd = array();
            $animeUsers = array();
            $animeScore = array();
            while($row = mysqli_fetch_assoc($result)) {
                $animeID[] = $row['animeID'];
                $animeTitle[] = $row['animeTitle'];
                $animeAvatar[] = $row['animeAvatar'];
                $animeType[] = $row['animeType'];
                $animeEpisodes[] = $row['animeEpisodes'];
                $animeStart[] = $row['animeStart'];
                $animeEnd[] = $row['animeEnd'];
                $animeUsers[] = $row['animeUsers'];
                $animeScore[] = $row['animeScore'];
            }

            if(isset($_SESSION['userID'])) {
                for($i = 0; $i < count($animeID); $i++) {
                    $sql = "SELECT animeID, userScore, userStatus FROM anime_users WHERE animeID=? AND userID=?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'Erro ao preparar as declarações';
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "ss", $animeID[$i], $_SESSION['userID']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $animeIDCheck[$i] = $row['animeID'];
                                $userScore[$i] = $row['userScore'];
                                $userStatus[$i] = $row['userStatus'];
                            }   
                        }
                    }
                }
            }
        }

        $total_pages_sql = "SELECT COUNT(animeID) FROM anime";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $anime_per_page);
        
        if($page < 1 || $page > $total_pages) {
            header("HTTP/1.1 404 Not Found");
            include "not-found-page.php";
            exit();
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }
?>