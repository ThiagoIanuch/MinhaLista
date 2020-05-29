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
                    $userAllFriendsName = $row['userName'];
                    $userAllFriendsBanStatus = $row['userBanStatus'];
                }
                if($userAllFriendsBanStatus == 1) {
                    header("HTTP/1.1 404 Not Found");
                    include "profile-banned.php";
                    exit();
                }
                else {
                    $page = $_GET['page'];
                    $friends_all_per_page = 50;
                    $friends_all_per_page_start = ($page-1) * $friends_all_per_page; 

                    $sql = "SELECT uf.userFriendIDOne, uf.userFriendIDTwo FROM friends_users uf JOIN users u ON uf.userFriendIDOne=u.userID WHERE uf.userFriendIDOne=? OR uf.userFriendIDTwo=? LIMIT $friends_all_per_page_start, $friends_all_per_page";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)) {
                        echo 'Erro ao preparar as declarações';
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "ss", $userIDProfile, $userIDProfile);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $resultCheckFriend = mysqli_num_rows($result);
                        if($resultCheckFriend > 0) {
                            $userFriendAllIDOne = array();
                            $userFriendAllIDTwo = array();
                            while($row = mysqli_fetch_assoc($result)) {
                                $userFriendAllIDOne[] = $row['userFriendIDOne'];
                                $userFriendAllIDTwo[] = $row['userFriendIDTwo'];
                            }

                            $sql = "SELECT userName, userAvatar FROM users WHERE userID=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                echo 'Erro ao preparar as declarações';
                            }
                            else {
                                for ($i = 0; $i < count($userFriendAllIDOne), $i < count($userFriendAllIDTwo); $i++) {
                                    if ($userFriendAllIDOne[$i] != $userIDProfile) {
                                        mysqli_stmt_bind_param($stmt, "s", $userFriendAllIDOne[$i]);
                                    }
                                    else {
                                        mysqli_stmt_bind_param($stmt, "s", $userFriendAllIDTwo[$i]);
                                    }
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    $resultCheck = mysqli_num_rows($result);
                                    if($resultCheck > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $userFriendAllName[] = $row['userName'];
                                            $userFriendAllAvatar[] = $row['userAvatar'];
                                        }
                                    }
                                }
                            }
                        }
                    }
            
                    $total_pages_sql = "SELECT COUNT(ID) FROM friends_users WHERE userFriendIDOne=? OR  userFriendIDTwo=?";
                    $total_pages_stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($total_pages_stmt, $total_pages_sql)) {
                        echo 'Erro ao preparar as declaraçssões';
                    }
                    else {
                        mysqli_stmt_bind_param($total_pages_stmt, "ss", $userIDProfile, $userIDProfile);
                        mysqli_stmt_execute($total_pages_stmt);
                        $result = mysqli_stmt_get_result($total_pages_stmt);
                        $total_rows = mysqli_fetch_array($result)[0];
                        $total_pages = ceil($total_rows / $friends_all_per_page);
                        
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