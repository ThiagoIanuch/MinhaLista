<?php
    session_start();
    
    if(isset($_GET['edit'])) {
        $profileConfig = $_GET['edit'];
    }

    if(!isset($profileConfig) || $profileConfig != 'profile' && $profileConfig != 'avatar' &&$profileConfig != 'list') {
        include "not-found-page.php";
        exit();
    }
    if(!isset($_SESSION['userID'])) {
        header("HTTP/1.1 404 Not Found");
        include "not-found-page.php";
        exit();
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Configurações - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/settings.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="container">
                <div class="settings-header">
                    <img src="img/logo1.png">
                    <div class="buttons">
                        <a href="settings.php?edit=profile" class="header-edit">Perfil</a>
                        <a href="settings.php?edit=avatar&banner" class="header-edit">Avatar & Banner</a>
                        <a href="settings.php?edit=list" class="header-edit">Lista</a>
                    </div>
                </div>

                <div class="settings-content">
                    <?php 
                        if($profileConfig == 'profile') {
                            switch($_SESSION['userGender']) {
                                case "0":
                                    $genderSelected0 = "selected";
                                    $genderSelected1 = '';
                                    $genderSelected2 = '';
                                break;
                                case "1":
                                    $genderSelected1 = 'selected';
                                    $genderSelected0 = '';
                                    $genderSelected2 = '';
                                break;
                                case "2":
                                    $genderSelected2 = 'selected';
                                    $genderSelected0 = '';
                                    $genderSelected1 = '';
                                break;
                            }

                            $yearBirthday = substr($_SESSION['userBirthday'], -10, 4);
                            $monthBirthday = substr($_SESSION['userBirthday'], -5, 2);
                            $dayBirthday = substr($_SESSION['userBirthday'], -2, 2);

                            echo '
                            <form action="includes/settings.inc.php" method="post" class="section-profile" id="settings"> 
                                <h4>Sobre você</h4>
                                <textarea name="about" placeholder="Um pouco sobre você..." class="textarea-input" id="about">'.$_SESSION['userAbout'].'</textarea>
                                <p class="error"></p>

                                <h4>Gênero</h4>
                                <select name="gender" class="select-input">
                                    <option value="0" '.$genderSelected0.'>Não específicado</option>
                                    <option value="1" '.$genderSelected1.'>Masculino</option>
                                    <option value="2" '.$genderSelected2.'>Feminino</option>
                                </select>

                                <h4>Localização</h4>
                                <input type="text" value="'.$_SESSION['userLocalization'].'" placeholder="Sua localização" name="localization" class="text-input" id="localization">
                                <p class="error"></p>
        
                                <h4>Aniversário</h4>
                                <select name="day" class="birthday-input day" id="day">
                                    <option value="">Selecionar</option>';
                                        for($day = 1; $day <= 31; $day++){
                                            $day = str_pad($day, 2, 0, STR_PAD_LEFT);
                                            if($dayBirthday == $day) {
                                                $daySelected = 'selected';
                                            }
                                            else {
                                                $daySelected = '';
                                            }
                                            echo '<option value="'.$day.'" '.$daySelected.'>'.$day.'</option>';
                                        }
                                echo '</select>
                            
                                <select name="month" class="birthday-input month" id="month">
                                    <option value="">Selecionar</option>';
                                    for($month = 1; $month <= 12; $month++){
                                        $month = str_pad($month, 2, 0, STR_PAD_LEFT);
                                        if($monthBirthday == $month) {
                                            $monthSelected = 'selected';
                                        }
                                        else {
                                            $monthSelected = '';
                                        }
                                        echo '<option value="'.$month.'" '.$monthSelected.'>'.$month.'</option>';
                                    }
                                echo '<select>

                                <select name="year" class="birthday-input year" id="year">
                                    <option value="">Selecionar</option>';
                                    for($year = 2020; $year >= 1930; $year--){
                                        if($yearBirthday == $year) {
                                            $yearSelected = 'selected';
                                        }
                                        else {
                                            $yearSelected = '';
                                        }
                                        echo '<option value="'.$year.'" '.$yearSelected.'>'.$year.'</option>';
                                    }
                                echo '</select> 
                                <p class="error"></p>

                                <input type="submit" name="settings-submit" value="Salvar" class="submit-input">
                            </form>';
                        }

                        else if($profileConfig == 'avatar'){
                            echo '
                            <form class="section" id="profile-avatar" enctype="multipart/form-data">
                                <h4>Avatar</h4>
                                <div class="label">
                                    Formatos permitidos: JPEG, PNG e GIF. Tamanho máximo: 3mb.
                                </div>
                                <div class="dropbox">
                                    <input type="file" name="profile-avatar" class="file-input">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>

                                <div class="avatar" style="background-image:url(media/users/avatar/'.$_SESSION['userAvatar'].');">
                                </div>

                                <p class="error-image e-avatar"></p>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="avatarDelete" name="delete"> <label for="avatarDelete">Excluir o avatar</label>
                                </div>
                            </form>
                            
                            <form class="section" id="profile-banner" enctype="multipart/form-data">
                                <h4>Banner</h4>
                                <div class="label">
                                    Formatos permitidos: JPEG, PNG e GIF. Tamanho máximo: 6mb.
                                </div>
                                <div class="dropbox">
                                    <input type="file" name="profile-banner" class="file-input">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                
                                <div class="banner" style="background-image:url(media/users/banner/'.$_SESSION['userBanner'].');">
                                </div>

                                <p class="error-image e-banner"></p>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="bannerDelete" name="delete"> <label for="bannerDelete">Excluir o banner</label>
                                </div>
                            </form>';
                        }

                        else if($profileConfig == 'list') {
                            echo '
                            <form class="section" id="list-banner" enctype="multipart/form-data">
                                <h4>Banner</h4>
                                <div class="label">
                                    Formatos permitidos: JPEG, PNG e GIF. Tamanho máximo: 6mb.
                                </div>
                                <div class="dropbox" id="dropbox">
                                    <input type="file" name="list-banner" class="file-input">
                                    <p>Solte sua imagem aqui ou clique para upar</p>
                                </div>
                                
                                <div class="banner" style="background-image:url(media/users/bannerList/'.$_SESSION['userBannerList'].');">
                                </div>

                                <p class="error-image e-bannerList"></p>
                                <div class="form-checkbox">
                                    <input type="checkbox" id="bannerListDelete" name="delete"> <label for="bannerListDelete">Excluir o banner da lista</label>
                                </div>
                            </form>';
                        }
                    ?>
                </div> <!-- Settings container -->
            </div> <!-- Container -->
        </div> <!-- Page-wrap -->

        <?php
            include "footer.php";
        ?>
    </body>
</html>