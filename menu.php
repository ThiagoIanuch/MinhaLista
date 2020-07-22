<?php 
    include "includes/friends.inc.php"; 
    include "includes/session-update.inc.php";
?>

<nav class="menu">
    <!-- Menu de links -->
    <div class="menu-left">
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="anime-ranking.php?page=1">Anime</a></li>
            <li><a href="manga-ranking.php?page=1">Mangá</a></li>
            <li class="default">Ajuda
                <ul>
                    <li><a href="about.php">Sobre</a></li>
                    <li><a href="support.php">Suporte</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Barra de pesquisa -->
    <div class="menu-search" id="search">
        <form class="menu-search-bar" action="includes/search.inc.php" method="post" id="search-form">
            <input type="text" name="search" class="menu-search-txt" id="search-autocomplete" placeholder="Procurar por anime, mangá e mais..." autocomplete="off">
            <input type="submit" name="search-submit" class="menu-search-button" value="OK">
        </form>
    </div>
    
    <!-- Notificações/Nome do perfil/avatar -->
    <div class="menu-right">   
        <?php
            if (isset($_SESSION["username"])) {
                if($resultCheckNotifications > 0) {
                    $notificationsClass = 'class="menu-notifications-number"';
                }
                else {
                    $notificationsClass = '';
                }
                echo
                '
                <div class="menu-right-links">
                    <div class="menu-notifications" id="notifications">
                        <div '.$notificationsClass.' data-unread="'.$resultCheckNotifications.'">
                        <i class="fa fa-bell"></i>
                        </div>
                    </div>
                </div>

                <div class="menu-notifications-container" id="notifications-display">';
                    if($resultCheckNotifications > 0) {
                        for($i = 0; $i < count ($friendUserID), $i < count($friendUserName), $i < count($friendUserAvatar); $i++) {

                            if(empty($friendUserAvatar[$i])) {
                                $friendUserAvatar[$i] = 'AvatarDefault';
                            }
                            echo '
                            <div class="menu-notifications-grid">

                                <div class="menu-notifications-avatar">
                                    <a href="profile.php?userid='.$friendUserID[$i].'" class="menu-friend-avatar" style="background-image:url(media/users/avatar/'.$friendUserAvatar[$i].'")></a>
                                </div>

                                <div class="menu-notifications-content">

                                   <div class="menu-friend-username">
                                        <a href="profile.php?userid='.$friendUserID[$i].'">'.$friendUserName[$i].'</a> <span>enviou um pedido de amizade</span>
                                    </div>
                                    
                                   <div class="menu-friend-confirm">
                                        <form action="includes/friends.inc.php" method="post" data-id="'.$friendUserID[$i].'">
                                            <input type="hidden" name="user-request" value="'.$friendUserID[$i].'">
                                            <input type="submit" name="friend-accept" value="Adicionar" class="menu-friend-buttons">
                                        </form>

                                        <form action="includes/friends.inc.php" method="post">
                                            <input type="hidden" name="user-request" value="'.$friendUserID[$i].'">
                                            <input type="submit" name="friend-decline" value="Recusar" class="menu-friend-buttons">
                                        </form>
                                    </div>

                                </div>

                            </div>';
                        }
                    }
                    else {
                        echo '<p class="menu-notifications-none">Nenhuma nova notificação</p>';
                    }
                echo '</div>

                <div class="menu-right-profile" id="profile">
                    <a>'.$_SESSION['username'].'</a>
                </div>
                <div class="menu-right-profile-links" id="profile-links">
                    <ul>
                        <li><a href="profile.php?userid='.$_SESSION["userID"].'">Perfil</a></li>
                        <li><a href="settings.php?edit=profile">Configurações</a></li>';
                        if ($_SESSION["userPermissions"] > 0) {
                            echo '<li><a href="admin.php?view=anime&page=1">Painel de Controle</a></li>';
                        }
                        echo '<li> 
                            <form action="includes/logout.inc.php" method="post">
                                <button type="submit" name="logout-submit" class="menu-right-logout">Sair</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div id="avatar-load">';   
                    if($_SESSION['userAvatar'] == null) {
                        echo '<a href="profile.php?userid='.$_SESSION['userID'].'" class="menu-avatar" style="background-image:url(media/users/avatar/avatarDefault.png)"></a>';
                    }
                    else {
                        echo '<a href="profile.php?userid='.$_SESSION['userID'].'" class="menu-avatar" style="background-image:url(media/users/avatar/'.$_SESSION['userAvatar'].')"></a>'; 
                    }
                echo '</div>';
            }
            else {
                echo
                '<div class="menu-right-buttons">
                    <a href="signup.php" class="menu-right-signup">Registrar</a>
                    <a href="login.php" class="menu-right-login">Entrar</a>
                </div>';
            }
        ?>
    </div>

    <!-- Menu responsivo -->
    <div class="menu-responsive">
        <!-- Links -->
        <div class="links-activator" id="links-activator">
            <i class="fa fa-bars"></i>
        </div>

        <!-- Notificações -->
        <?php
        if(isset($_SESSION['userID'])) {
            echo
            '<div class="menu-responsive-notifications" id="notificationsResponsive">  
                <div '.$notificationsClass.' data-unread="'.$resultCheckNotifications.'">
                    <i class="fa fa-bell"></i>
                </div>
            </div>
            <div class="menu-notifications-container responsive" id="notifications-display-responsive">';
                if($resultCheckNotifications > 0) {
                    for($i = 0; $i < count ($friendUserID), $i < count($friendUserName), $i < count($friendUserAvatar); $i++) {
                        if(empty($friendUserAvatar[$i])) {
                            $friendUserAvatar[$i] = 'AvatarDefault';
                        }
                        echo '
                        <div class="menu-notifications-grid">

                            <div class="menu-notifications-avatar">
                                <a href="profile.php?userid='.$friendUserID[$i].'" class="menu-friend-avatar" style="background-image:url(media/users/avatar/'.$friendUserAvatar[$i].'")></a>
                            </div>

                            <div class="menu-notifications-content">

                                <div class="menu-friend-username">
                                    <a href="profile.php?userid='.$friendUserID[$i].'">'.$friendUserName[$i].'</a> <span>enviou um pedido de amizade</span>
                                </div>
                                
                                <div class="menu-friend-confirm">
                                    <form action="includes/friends.inc.php" method="post" data-id="'.$friendUserID[$i].'">
                                        <input type="hidden" name="user-request" value="'.$friendUserID[$i].'">
                                        <input type="submit" name="friend-accept" value="Adicionar" class="menu-friend-buttons">
                                    </form>

                                    <form action="includes/friends.inc.php" method="post">
                                        <input type="hidden" name="user-request" value="'.$friendUserID[$i].'">
                                        <input type="submit" name="friend-decline" value="Recusar" class="menu-friend-buttons">
                                    </form>
                                </div>

                            </div>

                        </div>';
                    }
                }
                else {
                    echo '<p class="menu-notifications-none">Nenhuma nova notificação</p>';
                }
            echo '</div>';
        }
        ?>

        <!-- Home -->
        <a href="index.php">
            <div class="menu-responsive-home">
                <i class="fa fa-home"></i>
            </div>
        <a>

        <div class="menu-responsive-search" id="searchResponsive">
            <i class="fa fa-search"></i>
        </div>

        <!-- Menu links responsivo -->
        <div class="menu-responsive-links" id="links">
            <ul>
                <?php
                    // Se o usuário estiver logado
                    if(isset($_SESSION['userID'])) {
                        echo '
                        <a href="profile.php?userid='.$_SESSION['userID'].'"><li>Meu perfil</li></a>
                        <a href="anime-ranking.php?page=1"><li>Anime Ranking</li></a>
                        <a href="manga-ranking.php?page=1"><li>Mangá Ranking</li></a>
                        <a href="about.php"><li>Sobre</li></a>
                        <a href="support.php"><li>Suporte</li></a>
                        <a href="settings.php?edit=profile"><li>Configurações</li></a>';
                        if($_SESSION['userPermissions'] > 0) {
                            echo '<a href="admin.php?view=anime&page=1"><li>Painel de Controle</li></a>';
                        }
                        echo '
                        <form action="includes/logout.inc.php" method="post" class="logout-clear">
                            <button type="submit" name="logout-submit" class="menu-responsive-logout"><li>Sair</li></button>
                        </form>
                       ';
                    }
                    // Se o usuário não estiver logado
                    else {
                        echo '
                        <a href="login.php"><li>Entrar</li></a>
                        <a href="signup.php"><li>Registrar</li></a>
                        <a href="anime-ranking.php?page=1"><li>Anime Ranking</li></a>
                        <a href="manga-ranking.php?page=1"><li>Mangá Ranking</li></a>
                        <a href="about.php"><li>Sobre</li></a>
                        <a href="support.php"><li>Suporte</li></a>';
                    }
                ?>
            </ul>
        </div> <!-- Menu links responsivo -->
    </div> <!-- Menu responsivo -->
</nav> <!-- Menu -->

<script type="text/javascript" src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/jquery-ui.min.js"></script> 
<script type="text/javascript" src="js/script-main.js"></script>
<script type="text/javascript" src="js/script-forms.js"></script>
<script type="text/javascript" src="js/script-forms-errors.js"></script>