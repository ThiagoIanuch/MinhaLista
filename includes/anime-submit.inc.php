<?php
    session_start();
    include "db.inc.php";
    include "anime.inc.php";
    include "session-update.inc.php";
    
    $animeID = $_GET['animeid'];
    $userID = $_SESSION['userID'];

    // Adicionar anime na lista
    if(isset($_POST['add-submit'])) {
        if(isset($_SESSION['userID'])) {
            $sql = "SELECT animeID, userID FROM anime_users WHERE animeID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "ss", $animeID, $userID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0 ) {
                    header("Location: ../anime.php?animeid=".$animeID);
                }
                else {
                    $sql = "INSERT INTO anime_users (animeID, userID) VALUES (?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'Erro ao preparar as declarações';
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "ss", $animeID, $userID);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../anime.php?animeid=".$animeID);
                    }
                }   
            }
        }
        else {
            echo 'Erro usúario não logado';
        }
    }
    else {
        header("Location: ../anime.php?animeid=".$animeID);
    }

    // Remover anime da lista
    if(isset($_POST['delete'])) {
        $sql = "DELETE FROM anime_users WHERE animeID=? AND userID=?";
        $smt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $animeID, $userID);
            mysqli_stmt_execute($stmt);

            $sqlTableUpdate = "SET @num = 0;";
            $sqlTableUpdate .= "UPDATE anime_users SET ID = @num := (@num+1);";
            $sqlTableUpdate .= "ALTER TABLE anime_users AUTO_INCREMENT =1;";
            mysqli_multi_query($conn, $sqlTableUpdate);
        }
    }
    else {
        header("Location: ../anime.php?animeid=".$animeID);
    }

    // Adicionar anime aos favoritos
    if(isset($_POST['favorite-submit'])) { 
        $sql = "SELECT animeID, userID FROM anime_favorites WHERE animeID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $animeID, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                echo 'Você já adicionou este anime na lista';
            }
            else {
                $sql = "SELECT ID FROM anime_favorites WHERE userID=?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'Erro ao preparar as declarações';
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $userID);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck >= 10) {
                        echo 'Você já possui mais de 10 favoritos na lista';
                    }
                    else {
                        $sql = "INSERT INTO anime_favorites (userID, animeID) VALUES (?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            echo 'Erro ao preparar as declarações';
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "ss", $userID, $animeID);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
            }
        }
    }
    else {
        header("Location: ..anime.php?animeid=".$animeID);
    }

    // Remover anime dos favoritos
    if(isset($_POST['favorite-delete'])) {
        $sql = "DELETE FROM anime_favorites WHERE animeID=? AND userID=?";
        $smt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $animeID, $userID);
            mysqli_stmt_execute($stmt);

            $sqlTableUpdate = "SET @num = 0;";
            $sqlTableUpdate .= "UPDATE anime_favorites SET ID = @num := (@num+1);";
            $sqlTableUpdate .= "ALTER TABLE anime_favorites AUTO_INCREMENT =1;";
            mysqli_multi_query($conn, $sqlTableUpdate);
        }
    }
    else {
        header("Location: ../anime.php?anime=".$animeID);
    }

    // Status do usúario no anime
    if(isset($_POST['status-submit'])) {
        $userStatus = $_POST['status-submit'];
        if($userStatus == '2' && $animeEpisodes != NULL) {
            $sql = "UPDATE anime_users SET userStatus=?, userEpisodes=? WHERE userID=? AND animeID=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "ssss", $userStatus, $animeEpisodes, $userID, $animeID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            $sql = "UPDATE anime_users SET userStatus=? WHERE userID=? AND animeID=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $userStatus, $userID, $animeID);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    else {
        header("Location: ../anime.php?animeid=".$animeID);
    }

    // Pontuação do usúario no anime
    if(isset($_POST['score-submit'])) {
        $userScore = $_POST['score-submit'];
        if($userScore == "0") {
            $userScore = null;
        }
        $sql = "UPDATE anime_users SET userScore=? WHERE animeID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';

            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $userScore, $animeID, $userID);
                mysqli_stmt_execute($stmt);
            }
    }
    else {
        header("Location: ../anime.php?animeid=".$animeID);
    }

    // Episódios do usúario no anime
    if(isset($_POST['episodes-submit'])) {
        $userEpisodes = $_POST['episodes-submit'];

        if($animeEpisodes == null) {
            $animeEpisodes = 0;
        }
        
        if ($userEpisodes < 0 || $animeEpisodes != null && $userEpisodes > $animeEpisodes) {
            $sql = "UPDATE anime_users SET userEpisodes=? WHERE animeID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $animeEpisodes, $animeID, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            $sql = "UPDATE anime_users SET userEpisodes=? WHERE animeID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $userEpisodes, $animeID, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    else {
        header("Location: ../anime.php?animeid=".$animeID);
    }
?>