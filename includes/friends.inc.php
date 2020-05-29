<?php
    include "db.inc.php";

    // Pegar do usúario atual e do outro usúario
    if(isset($_SESSION['userID'])) {
        $userSession = $_SESSION['userID'];
    }
    if(isset($_GET['userid'])) {
        $userID = $_GET['userid'];
    }

    // Checar se o úsuario já é amigo
    if(isset($_GET['userid'])) {
        $sql = "SELECT userFriendIDOne, userFriendIDTWO FROM friends_users WHERE userFriendIDOne=? AND userFriendIDTwo=? OR userFriendIDOne=? AND userFriendIDTwo=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ssss", $userID, $userSession, $userSession, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultFriend = mysqli_num_rows($result);
        }
    }

    // Verificar se o usúario já enviou um pedido de amizade
    if(isset($_GET['userid'])) {
        $sql = "SELECT userFriendSent, userFriendReceived FROM friends_requests WHERE userFriendSent=? AND userFriendReceived=? OR userFriendSent=? AND userFriendReceived=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ssss", $userID, $userSession, $userSession, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultFriendRequest = mysqli_num_rows($result);
        }
    }

    // Enviar pedido de amizade
    if(isset($_POST['friend-request'])) {
        session_start();
        include "session-update.inc.php";

        $userSession = $_SESSION['userID'];
        $sql = "SELECT userFriendSent, userFriendReceived FROM friends_requests WHERE userFriendSent=? AND userFriendReceived=? OR userFriendSent=? AND userFriendReceived=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ssss", $userID, $userSession, $userSession, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultFriendRequest = mysqli_num_rows($result);
            if($resultFriendRequest > 0) {
                header("Location: ../profile.php?userid=".$userID);
            }
            else {
                $sql = "INSERT INTO friends_requests (userFriendSent, userFriendReceived) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'Erro ao preparar as declarações';
                }
                else {
                    mysqli_stmt_bind_param($stmt, "ss", $userSession, $userID);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../profile.php?userid=".$userID);
                }
            }
        }
    }

    // Remover dos amigos
    if(isset($_POST['friend-remove'])) {
        session_start();
        include "session-update.inc.php";
        
        $userSession = $_SESSION['userID'];
        $sql = "DELETE FROM friends_users WHERE userFriendIDOne=? AND userFriendIDTwo=? OR userFriendIDOne=? AND userFriendIDTwo=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ssss", $userSession, $userID, $userID, $userSession);
            mysqli_stmt_execute($stmt);
            $sqlTableUpdate = "SET @num = 0;";
            $sqlTableUpdate .= "UPDATE friends_users SET ID = @num := (@num+1);";
            $sqlTableUpdate .= "ALTER TABLE friends_users AUTO_INCREMENT =1;";
            mysqli_multi_query($conn, $sqlTableUpdate);

            header("Location: ../profile.php?userid=".$userID);
        }
    }
    
    // Notificações com pedido de amizade
    $sql = "SELECT u.userID, u.userName, u.userAvatar FROM users u JOIN friends_requests fr ON fr.userFriendSent=u.userID WHERE fr.userFriendReceived=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Erro ao preparar as declarações';
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $userSession);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $resultCheckNotifications= mysqli_num_rows($result);
        if($resultCheckNotifications > 0) {
            $friendUserID = array();
            $friendUserName = array();
            $friendAvatar = array();
            while($row = mysqli_fetch_assoc($result)) {
                $friendUserID[] = $row['userID'];
                $friendUserName[] = $row['userName'];
                $friendUserAvatar[] = $row['userAvatar'];
            }
        }
    }

    // Aceitar/Recusar pedido de amizade
    if(isset($_POST['friend-accept'])) {
        session_start();
        include "session-update.inc.php";
        
        $lastURL = $_SERVER['HTTP_REFERER'];
        $userRequest = $_POST['user-request'];
        $userSession = $_SESSION['userID'];
        $sql = "DELETE FROM friends_requests WHERE userFriendSent=? AND userFriendReceived=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $userRequest, $userSession);
            mysqli_stmt_execute($stmt);
            $sql = "INSERT INTO friends_users (userFriendIDOne, userFriendIDTwo) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            mysqli_stmt_bind_param($stmt, "ss", $userSession, $userRequest);
            mysqli_stmt_execute($stmt);
            header("Location: ".$lastURL);
        }
    }

    if(isset($_POST['friend-decline'])) {
        session_start();
        include "session-update.inc.php";

        $lastURL = $_SERVER['HTTP_REFERER'];
        $userRequest = $_POST['user-request'];
        $userSession = $_SESSION['userID'];
        $sql = "DELETE FROM friends_requests WHERE userFriendSent=? AND userFriendReceived=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $userRequest, $userSession);
            mysqli_stmt_execute($stmt);
            $sqlTableUpdate = "SET @num = 0;";
            $sqlTableUpdate .= "UPDATE friends_requests SET ID = @num := (@num+1);";
            $sqlTableUpdate .= "ALTER TABLE friends_requests AUTO_INCREMENT =1;";
            mysqli_multi_query($conn, $sqlTableUpdate);

            header("Location: ".$lastURL);
        }
    }

    // Lista de amigos adicionados
    if(isset($_GET['userid'])) {
        $sql = "SELECT uf.userFriendIDOne, uf.userFriendIDTwo FROM friends_users uf JOIN users u ON uf.userFriendIDOne=u.userID WHERE uf.userFriendIDOne=? OR uf.userFriendIDTwo=? ORDER BY RAND() LIMIT 10";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $userID, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheckFriend = mysqli_num_rows($result);
            if($resultCheckFriend > 0) {
                $userFriendIDOne = array();
                $userFriendIDTwo = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $userFriendIDOne[] = $row['userFriendIDOne'];
                    $userFriendIDTwo[] = $row['userFriendIDTwo'];
                }
            }
        }
    }

    // Total de amigos adicionados
    if(isset($_GET['userid'])) {
        $sql = "SELECT uf.userFriendIDOne, uf.userFriendIDTwo FROM friends_users uf JOIN users u ON uf.userFriendIDOne=u.userID WHERE uf.userFriendIDOne=? OR uf.userFriendIDTwo=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $userID, $userID);
            mysqli_stmt_execute($stmt);
            $resultTotal = mysqli_stmt_get_result($stmt);
            $resultCheckFriendTotal = mysqli_num_rows($resultTotal);
        }
    }
    
    // Avatar dos amigos adicionados
    if(isset($_GET['userid']) && $resultCheckFriend > 0) {
        $sql = "SELECT userName, userAvatar FROM users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            for ($i = 0; $i < count($userFriendIDOne), $i < count($userFriendIDTwo); $i++) {
                if ($userFriendIDOne[$i] != $userID) {
                    mysqli_stmt_bind_param($stmt, "s", $userFriendIDOne[$i]);
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $userFriendIDTwo[$i]);
                }
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $userFriendName[] = $row['userName'];
                        $userFriendAvatar[] = $row['userAvatar'];
                    }
                }
            }
        }
    }
?>