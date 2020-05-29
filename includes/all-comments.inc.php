<?php
    include "db.inc.php";

    if(isset($_GET['userid']) && isset($_GET['page']) && $_GET['page'] > 0) {
        $userIDProfile = $_GET['userid'];

        $sql = "SELECT userID, userName, userBanStatus FROM users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userIDProfile);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);    
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $userAllCommentsName = $row['userName'];
                    $userAllCommentsBanStatus = $row['userBanStatus'];
                }
                if($userAllCommentsBanStatus == 1) {
                    header("HTTP/1.1 404 Not Found");
                    include "profile-banned.php";
                    exit();
                }
                else {
                    $page = $_GET['page'];
                    $comments_per_page = 5;
                    $comments_per_page_start = ($page-1) * $comments_per_page; 
    
                    $sql = "SELECT uc.commentID, uc.userComment, uc.userID, uc.commentDate, u.userName, u.userAvatar FROM users_comments uc JOIN users u ON uc.userID=u.userID WHERE userIDProfile=? ORDER BY commentDate DESC LIMIT $comments_per_page_start, $comments_per_page";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'Erro ao preparar as declarações';
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "s", $userIDProfile);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $resultCheckComment = mysqli_num_rows($result);
                        if($resultCheckComment > 0) {
                            $userComment = array();
                            $userCommentDate = array();
                            $userCommentName = array();
                            $userCommentAvatar = array();
                            while($row = mysqli_fetch_assoc($result)) {
                                $userCommentID[] = $row['commentID'];
                                $userComment[] = $row['userComment'];
                                $userIDComment[] = $row['userID'];
                                $userCommentDate[] = $row['commentDate'];
                                $userCommentName[] = $row['userName'];
                                $userCommentAvatar[] = $row['userAvatar'];
                            }
                        }
                    }
            
                    $total_pages_sql = "SELECT COUNT(commentID) FROM users_comments WHERE userIDProfile=?";
                    $total_pages_stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($total_pages_stmt, $total_pages_sql)) {
                        echo 'Erro ao preparar as declarações';
                    }
                    else {
                        mysqli_stmt_bind_param($total_pages_stmt, "s", $userIDProfile);
                        mysqli_stmt_execute($total_pages_stmt);
                        $result = mysqli_stmt_get_result($total_pages_stmt);
                        $total_rows = mysqli_fetch_array($result)[0];
                        $total_pages = ceil($total_rows / $comments_per_page);
                        
                    }
                    
                    if(empty($total_pages)) {
                        $total_pages = 1;
                    }

                    if($page < 1 || $page > $total_pages) {
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
        }
    }
    else {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }
?>