<?php
    session_start();

    include "includes/all-comments.inc.php";
?>

<!DOCTYPE html>
    <head>
        <title>Comentários de <?php echo $userAllCommentsName;?> - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="container comments-container-all">
                <div class="comments">
                    
                    <div class="page-buttons-top">
                        <?php
                            $pageSum = 1;
                            $pageNext = $page+$pageSum;
                            $pagePrevious = $page-$pageSum;
                            if($page <= $total_pages && $page != 1) {
                                echo '<a href="all-comments.php?userid='.$userID.'&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                            }
                            if($page < $total_pages) {
                                echo '<a href="all-comments.php?userid='.$userID.'&page='.$pageNext.'" class="page-button">Próximo</a>';
                            }
                        ?>
                    </div>

                    <?php
                        echo '<h3>Comentários no perfil de '.$userAllCommentsName.'</h3>';
                        if($resultCheckComment > 0) {
                            echo '<div class="comments-grid all">';
                            for($i = 0; $i < count($userCommentID), $i < count($userComment), $i < count($userIDComment), $i < count($userCommentDate), $i < count($userCommentName), $i < count($userCommentAvatar); $i++) {
                            
                                if(empty($userCommentAvatar[$i])) {
                                    $userCommentAvatar[$i] = "avatarDefault.png";
                                }

                                echo '
                                <div class="comment-grid">
                                    <div class="user-comment-avatar">
                                        <a href="profile.php?userid='.$userIDComment[$i].'" style="background-image:url(media/users/avatar/'.$userCommentAvatar[$i].')" class="user-comment-avatar"></a>
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-username">
                                            <a href="profile.php?userid='.$userIDComment[$i].'">'.$userCommentName[$i].'</a>
                                        </div>
                                        <div class="comment-date">'.  date("d/m/Y H:i A", strtotime($userCommentDate[$i])).'</div>
                                        <div class="comment-text">'.$userComment[$i].'</div>';

                                        if(isset($_SESSION['userID']) && $userID == $_SESSION['userID'] || isset($_SESSION['userID']) && $userIDComment[$i] == $_SESSION['userID']) {
                                        echo '
                                        <div class="comment-delete">
                                            <form action="includes/comments.inc.php" method="post">
                                                <input type="hidden" name="commentID" value="'.$userCommentID[$i].'">
                                                <input type="submit" name="comment-delete" value="Deletar" class="comment-delete-btn">
                                            </form>
                                        </div>';
                                        }
                                    echo ' 
                                    </div>
                                </div>';        
                            }
                            echo '</div>';
                        }
                        else {
                            echo '<div class="not-comment">Este perfil não possui nenhum comentário</div>';
                        }
                    ?>

                </div> <!-- Comments -->                
            </div> <!-- Container -->

            <div class="page-buttons-bottom">
            <?php
                $pageSum = 1;
                $pageNext = $page+$pageSum;
                $pagePrevious = $page-$pageSum;
                if($page <= $total_pages && $page != 1) {
                    echo '<a href="all-comments.php?userid='.$userID.'&page='.$pagePrevious.'" class="page-button">Anterior</a>';
                }
                if($page < $total_pages) {
                    echo '<a href="all-comments.php?userid='.$userID.'&page='.$pageNext.'" class="page-button">Próximo</a>';
                }
                ?>
            </div> <!-- Page buttons bottom  -->

        </div> <!-- Page wrap -->

        <?php
            include "footer.php";
        ?>
    </body>
</html>