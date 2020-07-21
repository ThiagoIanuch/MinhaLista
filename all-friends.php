<?php
    session_start();

    include "includes/all-friends.inc.php";
?>

<!DOCTYPE html>
    <head>
        <title>Amigos de <?php echo $userAllFriendsName; ?> - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="container friends-container-all">
                <div class="friends">
                    
                    <div class="page-buttons-top">
                        <?php
                            $pageSum = 1;
                            $pageNext = $page+$pageSum;
                            $pagePrevious = $page-$pageSum;
                            if($page <= $total_pages && $page != 1) {
                                echo '<a href="all-friends.php?userid='.$userID.'&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                            }
                            if($page < $total_pages) {
                                echo '<a href="all-friends.php?userid='.$userID.'&page='.$pageNext.'" class="page-button">Próximo</a>';
                            }
                        ?>
                    </div>

                    <h3>Amigos</h3>
                    <?php  
                        if($resultCheckFriend > 0 ){
                            echo '<div class="all-friends-grid">';
                            for($i = 0; $i < count($userFriendAllIDOne), $i < count ($userFriendAllIDTwo); $i++) {
                                if(empty($userFriendAllAvatar[$i])) {
                                    $userFriendAllAvatar[$i] = 'AvatarDefault.png';
                                }
                                
                                if($userFriendAllIDTwo[$i] == $userIDProfile) {
                                    $userFriendAllID = $userFriendAllIDOne[$i];
                                }
                                else {
                                    $userFriendAllID = $userFriendAllIDTwo[$i];
                                }
                                echo' <a href="profile.php?userid='.$userFriendAllID.'" title="'.$userFriendAllName[$i].'" class="all-friends-avatar" style="background-image:url(media/users/avatar/'.$userFriendAllAvatar[$i].')"></a>'; 
                            }
                            echo '</div>';
                        }
                        else {
                            echo '<h4>Nenhum amigo adicionado</h4>';
                        }
                        echo '</div>';
                    ?>

                </div> <!-- Friends -->     
                <div class="page-buttons-bottom">
                    <?php
                        $pageSum = 1;
                        $pageNext = $page+$pageSum;
                        $pagePrevious = $page-$pageSum;
                        if($page <= $total_pages && $page != 1) {
                            echo '<a href="all-friends.php?userid='.$userID.'&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                        }
                        if($page < $total_pages) {
                            echo '<a href="all-friends.php?userid='.$userID.'&page='.$pageNext.'" class="page-button">Próximo</a>';
                        }
                    ?>
                </div> <!-- Page buttons bottom  -->           
            </div> <!-- Container -->
        </div> <!-- Page wrap -->

        <?php
            include "footer.php";
        ?>
    </body>
</html>