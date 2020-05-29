<?php
    session_start();
    include "db.inc.php";
    include "manga.inc.php";
    include "session-update.inc.php";
    $mangaID = $_GET['mangaid'];
    $userID = $_SESSION['userID'];

    // Adicionar manga na lista
    if(isset($_POST['add-submit'])) {
        if(isset($_SESSION['userID'])) {
            $sql = "SELECT mangaID, userID FROM manga_users WHERE mangaID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "ss", $mangaID, $userID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0 ) {
                    echo 'Você já adicionou esse manga na lista';
                }
                else {
                    $sql = "INSERT INTO manga_users (mangaID, userID) VALUES (?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'Erro ao preparar as declarações';
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "ss", $mangaID, $userID);
                        mysqli_stmt_execute($stmt);
                        header("Location: ../manga.php?mangaid=".$mangaID);
                    }
                }   
            }
        }
        else {
            echo 'Erro usúario não logado';
        }
    }
    else {
        header("Location: ../manga.php?mangaid=".$mangaID);
    }

    // Remover manga da lista
    if(isset($_POST['delete'])) {
        $sql = "DELETE FROM manga_users WHERE mangaID=? AND userID=?";
        $smt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mangaID, $userID);
            mysqli_stmt_execute($stmt);

            $sqlTableUpdate = "SET @num = 0;";
            $sqlTableUpdate .= "UPDATE manga_users SET ID = @num := (@num+1);";
            $sqlTableUpdate .= "ALTER TABLE manga_users AUTO_INCREMENT =1;";
            mysqli_multi_query($conn, $sqlTableUpdate);
        }
    }
    else {
        header("Location: ../manga.php?mangaid=".$mangaID);
    }

    // Adicionar manga aos favoritos
    if(isset($_POST['favorite-submit'])) { 
        $sql = "SELECT mangaID, userID FROM manga_favorites WHERE mangaID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mangaID, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                echo 'Você já adicionou este manga na lista';
            }
            else {
                $sql = "SELECT ID FROM manga_favorites WHERE userID=?";
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
                        $sql = "INSERT INTO manga_favorites (userID, mangaID) VALUES (?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            echo 'Erro ao preparar as declarações';
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "ss", $userID, $mangaID);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
            }
        }
    }
    else {
        header("Location: ..manga.php?mangaid=".$mangaID);
    }

    // Remover manga dos favoritos
    if(isset($_POST['favorite-delete'])) {
        $sql = "DELETE FROM manga_favorites WHERE mangaID=? AND userID=?";
        $smt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mangaID, $userID);
            mysqli_stmt_execute($stmt);

            $sqlTableUpdate = "SET @num = 0;";
            $sqlTableUpdate .= "UPDATE manga_favorites SET ID = @num := (@num+1);";
            $sqlTableUpdate .= "ALTER TABLE manga_favorites AUTO_INCREMENT =1;";
            mysqli_multi_query($conn, $sqlTableUpdate);
        }
    }
    else {
        header("Location: ../manga.php?mangaid=".$mangaID);
    }

    // Status do usúario no manga
    if(isset($_POST['status-submit'])) {
        $userStatus = $_POST['status-submit'];
        if($userStatus == '2' && $mangaChapters != NULL && $mangaVolumes != NULL) {
            $sql = "UPDATE manga_users SET userStatus=?, userChapters=?, userVolumes=? WHERE userID=? AND mangaID=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sssss", $userStatus, $mangaChapters, $mangaVolumes, $userID, $mangaID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            $sql = "UPDATE manga_users SET userStatus=? WHERE userID=? AND mangaID=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $userStatus, $userID, $mangaID);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    else {
        header("Location: ../manga.php?mangaid=".$mangaID);
    }

    // Pontuação do usúario no manga
    if(isset($_POST['score-submit'])) {
        $userScore = $_POST['score-submit'];
        if($userScore == "0") {
            $userScore = null;
        }
        $sql = "UPDATE manga_users SET userScore=? WHERE mangaID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';

            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $userScore, $mangaID, $userID);
                mysqli_stmt_execute($stmt);
            }
    }
    else {
        header("Location: ../manga.php?mangaid=".$mangaID);
    }

    // Capítulos do usúario no manga
    if(isset($_POST['chapters'])) {
        $userChapters = $_POST['chapters'];
        if($mangaChapters == null) {
            $mangaChapters = 0;
        }
  
        if ($userChapters < 0 || $mangaChapters!= null && $userChapters > $mangaChapters) {
            $sql = "UPDATE manga_users SET userChapters=? WHERE mangaID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $mangaChapters, $mangaID, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            $sql = "UPDATE manga_users SET userChapters=? WHERE mangaID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $userChapters, $mangaID, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    else {
        header("Location: ../manga.php?mangaid=".$mangaID);
    }

    // Volumes do usúario no manga
    if(isset($_POST['volumes'])) {
        $userVolumes = $_POST['volumes'];
        if($mangaVolumes == null) {
            $mangaVolumes = 0;
        }

        if ($userVolumes < 0 || $mangaVolumes!= null && $userVolumes > $mangaVolumes) {
            $sql = "UPDATE manga_users SET userVolumes=? WHERE mangaID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $mangaVolumes, $mangaID, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            $sql = "UPDATE manga_users SET userVolumes=? WHERE mangaID=? AND userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_bind_param($stmt, "sss", $userVolumes, $mangaID, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    else {
        header("Location: ../manga.php?mangaid=".$mangaID);
    }
?>