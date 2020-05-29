<?php
    include "includes/db.inc.php";
	/* Manga ranking */
    if (isset($_GET['page']) && $_GET['page'] > 0) {
        $page = $_GET['page'];
        $manga_per_page = 5;
        $manga_per_page_start = ($page-1) * $manga_per_page; 

        $sql = "SELECT m.mangaID, m.mangaTitle, m.mangaAvatar, m.mangaType, m.mangaVolumes, m.mangaStart, m.mangaEnd, COUNT(mu.userID) AS mangaUsers, AVG(userScore) AS mangaScore FROM manga m LEFT JOIN manga_users mu ON m.mangaID=mu.mangaID GROUP BY mangaID ORDER BY mangaScore DESC, mangaTitle LIMIT $manga_per_page_start, $manga_per_page";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $mangaID = array();  
            $mangaTitle = array();
            $mangaAvatar = array();
            $mangaType = array();
            $mangaEpisodes = array();
            $mangaStart = array();
            $mangaEnd = array();
            $mangaUsers = array();
            $mangaScore = array();
            while($row = mysqli_fetch_assoc($result)) {
                $mangaID[] = $row['mangaID'];
                $mangaTitle[] = $row['mangaTitle'];
                $mangaAvatar[] = $row['mangaAvatar'];
                $mangaType[] = $row['mangaType'];
                $mangaVolumes[] = $row['mangaVolumes'];
                $mangaStart[] = $row['mangaStart'];
                $mangaEnd[] = $row['mangaEnd'];
                $mangaUsers[] = $row['mangaUsers'];
                $mangaScore[] = $row['mangaScore'];
            }
            
            if(isset($_SESSION['userID'])) {
                for($i = 0; $i < count($mangaID); $i++) {
                    $sql = "SELECT mangaID, userScore, userStatus FROM manga_users WHERE mangaID=? AND userID=?";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'Erro ao preparar as declarações';
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "ss", $mangaID[$i], $_SESSION['userID']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $resultCheck = mysqli_num_rows($result);
                        if($resultCheck > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $mangaIDCheck[$i] = $row['mangaID'];
                                $userScore[$i] = $row['userScore'];
                                $userStatus[$i] = $row['userStatus'];
                            }   
                        }
                    }
                }
            }
        }

        $total_pages_sql = "SELECT COUNT(mangaID) FROM manga";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $manga_per_page);
        
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