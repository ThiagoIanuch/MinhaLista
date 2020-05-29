<?php
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    if(isset($_SESSION['userID'])) {
        $userIDsession = $_SESSION['userID'];
        $sql = "SELECT userName, userEmail, userPassword, userPermissions, userAvatar, userBanner, userBannerList, userAbout, userGender, userBirthday, userLocalization, userDate, userBanStatus FROM users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $userIDsession);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)) {
                $userUpdateName = $row['userName'];
                $userUpdateEmail = $row['userEmail'];
                $userUpdatePassword = $row['userPassword'];
                $userUpdatePermissions = $row['userPermissions'];
                $userUpdateAvatar = $row['userAvatar'];
                $userUpdateBanner = $row['userBanner'];
                $userUpdateBannerList = $row['userBannerList'];
                $userUpdateAbout = $row['userAbout'];
                $userUpdateGender = $row['userGender'];
                $userUpdateBirthday = $row['userBirthday'];
                $userUpdateLocalization = $row['userLocalization'];
                $userUpdateDate = $row['userDate'];
                $userUpdateBanStatus = $row['userBanStatus'];
            }
            $online = date('Y-m-d G:i:s');
            $sql = "UPDATE users SET userOnlineStatus=? WHERE userID=?";
            mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'err';
            }
            else {
                mysqli_stmt_bind_param($stmt, "ss", $online, $userIDsession);
                mysqli_stmt_execute($stmt);
            }
        }
        $_SESSION['username'] = $userUpdateName;
        $_SESSION['userEmail'] = $userUpdateEmail;
        $_SESSION['userPassword'] = $userUpdatePassword;
        $_SESSION['userPermissions'] = $userUpdatePermissions;
        $_SESSION['userAvatar'] = $userUpdateAvatar;
        $_SESSION['userBanner'] = $userUpdateBanner;
        $_SESSION['userBannerList'] = $userUpdateBannerList;
        $_SESSION['userAbout'] = $userUpdateAbout;
        $_SESSION['userGender'] = $userUpdateGender;
        $_SESSION['userBirthday'] = $userUpdateBirthday;
        $_SESSION['userLocalization'] = $userUpdateLocalization;
        $_SESSION['userDate'] = $userUpdateDate;
        $_SESSION['userBanStatus'] = $userUpdateBanStatus;
    }

    if(isset($_SESSION['userID'])) {
        if($_SESSION['userBanStatus'] == 1) {
            session_unset();
            session_destroy();
        }
    }
?>