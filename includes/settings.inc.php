<?php
    include "db.inc.php";
    session_start();
    include "session-update.inc.php";
    
    $userID = $_SESSION["userID"];
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    // Configurações gerais
    if(isset($_POST['settings-submit'])) {
        $sql = "UPDATE users SET userAbout=?, userGender=?, userBirthday=?, userLocalization=? WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        $userAbout = $_POST['about'];
        $userGender = $_POST['gender'];
        $userLocalization = $_POST['localization'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $userBirthday = $year.'-'.$month.'-'.$day;

        if(empty($userAbout)) {
            $userAbout = null;
        }

        if(strlen($userAbout) > 5000) {
            $userAbout = $_SESSION['userAbout'];
        }

        if(empty($day) || empty($month) | empty($year)) {
            $userBirthday = null;
        }

        if(empty($userLocalization)) {
            $userLocalization = null;
        }

        if(strlen($userLocalization) > 12) {
            $userLocalization = $_SESSION['userLocalization'];
        }

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo "Erro ao preparar as declarações";
        }
        else {  
            mysqli_stmt_bind_param($stmt, "sssss", $userAbout, $userGender, $userBirthday, $userLocalization, $userID);
            mysqli_stmt_execute($stmt);
            header("Location: ../settings.php?edit=profile");
        }
    }

    // Atualizar avatar do perfil
    if(isset($_FILES['profile-avatar']['name'])) {
        $userAvatarName = $_FILES['profile-avatar']['name'];
        $userAvatarTmpName = $_FILES['profile-avatar']['tmp_name'];
        $userAvatarSize = $_FILES['profile-avatar']['size'];
        $userAvatarError = $_FILES['profile-avatar']['error'];

        $userAvatarExt = explode('.', $userAvatarName);
        $userAvatarActualExt = strtolower(end($userAvatarExt));

        if(isset($_POST['delete'])) {
            $userAvatarName = null;
        }

        if(empty($userAvatarName) && !empty($_SESSION['userAvatar'])) {
            unlink("../media/users/avatar/".$_SESSION['userAvatar']);
            $userAvatar = null;

            $sql = "UPDATE users SET userAvatar=? WHERE userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Erro ao preparar as declarações";
            }
            else {  
                mysqli_stmt_bind_param($stmt, "ss", $userAvatar, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            if(!empty($userAvatarName)) {
                if(in_array($userAvatarActualExt, $allowed)) {
                    if($userAvatarError === 0) {
                        if($userAvatarSize < 3000000) {
                    
                            $userAvatar = time().uniqid(rand()).".".$userAvatarActualExt;
                            $userAvatarDestination = '../media/users/avatar/'.$userAvatar;
                        
                            if(!empty($_SESSION['userAvatar'])) {
                                unlink("../media/users/avatar/".$_SESSION['userAvatar']);
                            }

                            $sql = "UPDATE users SET userAvatar=? WHERE userID=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "Erro ao preparar as declarações";
                            }
                            else {  
                                move_uploaded_file($userAvatarTmpName, $userAvatarDestination);
                                mysqli_stmt_bind_param($stmt, "ss", $userAvatar, $userID);
                                mysqli_stmt_execute($stmt);
                            }
                        }
                        else {
                            echo "Erro3";
                        }
                    }
                    else {
                        echo "Erro2";
                    }
                }
                else {
                    echo "Erro1";
                }
            }
        }
    } 

    // Atualizar banner do perfil
    if(isset($_FILES['profile-banner']['name'])) {
        $userBannerName = $_FILES['profile-banner']['name'];
        $userBannerTmpName = $_FILES['profile-banner']['tmp_name'];
        $userBannerSize = $_FILES['profile-banner']['size'];
        $userBannerError = $_FILES['profile-banner']['error'];

        $userBannerExt = explode('.', $userBannerName);
        $userBannerActualExt = strtolower(end($userBannerExt));

        if(isset($_POST['delete'])) {
            $userBannerName = null;
        }

        if(empty($userBannerName) && !empty($_SESSION['userBanner'])) {
            unlink("../media/users/banner/".$_SESSION['userBanner']);
            $userBanner = null;
            
            $sql = "UPDATE users SET userBanner=? WHERE userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Erro ao preparar as declarações";
            }
            else {  
                mysqli_stmt_bind_param($stmt, "ss", $userBanner, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            if(!empty($userBannerName)) {
                if(in_array($userBannerActualExt, $allowed)) {
                    if($userBannerError === 0) {
                        if($userBannerSize < 6000000) {
                    
                            $userBanner = time().uniqid(rand()).".".$userBannerActualExt;
                            $userBannerDestination = '../media/users/banner/'.$userBanner;
                        
                            if(!empty($_SESSION['userBanner'])) {
                                unlink("../media/users/banner/".$_SESSION['userBanner']);
                            }

                            $sql = "UPDATE users SET userBanner=? WHERE userID=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "Erro ao preparar as declarações";
                            }
                            else {  
                                move_uploaded_file($userBannerTmpName, $userBannerDestination);
                                mysqli_stmt_bind_param($stmt, "ss", $userBanner, $userID);
                                mysqli_stmt_execute($stmt);
                            }
                        }
                        else {
                            echo "Erro3";
                        }
                    }
                    else {
                        echo "Erro2";
                    }
                }
                else {
                    echo "Erro1";
                }
            }
        }
    } 

    // Atualizar o banner da lista
    if(isset($_FILES['list-banner']['name'])) {
        $listBannerName = $_FILES['list-banner']['name'];
        $listBannerTmpName = $_FILES['list-banner']['tmp_name'];
        $listBannerSize = $_FILES['list-banner']['size'];
        $listBannerError = $_FILES['list-banner']['error'];

        $listBannerExt = explode('.', $listBannerName);
        $listBannerActualExt = strtolower(end($listBannerExt));

        if(isset($_POST['delete'])) {
            $listBannerName = null;
        }

        if(empty($listBannerName) && !empty($_SESSION['userBannerList'])) {
            unlink("../media/users/bannerList/".$_SESSION['userBannerList']);
            $listBanner = null;

            $sql = "UPDATE users SET userBannerList=? WHERE userID=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo "Erro ao preparar as declarações";
            }
            else {  
                mysqli_stmt_bind_param($stmt, "ss", $listBanner, $userID);
                mysqli_stmt_execute($stmt);
            }
        }
        else {
            if(!empty($listBannerName)) {
                if(in_array($listBannerActualExt, $allowed)) {
                    if($listBannerError === 0) {
                        if($listBannerSize < 6000000) {
                    
                            $listBanner = time().uniqid(rand()).".".$listBannerActualExt;
                            $listBannerDestination = '../media/users/bannerList/'.$listBanner;
                        
                            if(!empty($_SESSION['userBannerList'])) {
                                unlink("../media/users/bannerList/".$_SESSION['userBannerList']);
                            }

                            $sql = "UPDATE users SET userBannerList=? WHERE userID=?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "Erro ao preparar as declarações";
                            }
                            else {  
                                move_uploaded_file($listBannerTmpName, $listBannerDestination);
                                mysqli_stmt_bind_param($stmt, "ss", $listBanner, $userID);
                                mysqli_stmt_execute($stmt);
                            }
                        }
                        else {
                            echo "Erro3";
                        }
                    }
                    else {
                        echo "Erro2";
                    }
                }
                else {
                    echo "Erro1";
                }
            }
        }
    }  
?>