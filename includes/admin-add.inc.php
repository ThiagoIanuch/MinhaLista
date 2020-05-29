<?php
    include "db.inc.php";
    $allowed = array('jpg', 'jpeg', 'png');

    /* Adicionar anime */
    if(isset($_POST['anime-add'])) {
        $animeTitleAdd = $_POST['title'];
        $animeSinopseAdd = $_POST['sinopse'];
    
        /* Pegar o avatar e banner */
        $animeAvatarNameAdd = $_FILES['avatar']['name'];
        $animeAvatarTmpNameAdd = $_FILES['avatar']['tmp_name'];
        $animeAvatarSizeAdd = $_FILES['avatar']['size'];
        $animeAvatarErrorAdd = $_FILES['avatar']['error'];

        $animeBannerNameAdd = $_FILES['banner']['name'];
        $animeBannerTmpNameAdd = $_FILES['banner']['tmp_name'];
        $animeBannerSizeAdd = $_FILES['banner']['size'];
        $animeBannerErrorAdd = $_FILES['banner']['error'];

        $animeAvatarExtAdd = explode('.', $animeAvatarNameAdd);
        $animeAvatarActualExtAdd = strtolower(end($animeAvatarExtAdd));
        
        $animeBannerExtAdd = explode('.', $animeBannerNameAdd);
        $animeBannerActualExtAdd = strtolower(end($animeBannerExtAdd));

        $animeTypeAdd = $_POST['type'];
        $animeEpisodesAdd = $_POST['episodes'];
        $animeStatusAdd = $_POST['status'];
        $animeSourceAdd = $_POST['source'];
        $animeDayStartAdd = $_POST['dayStart'];
        $animeMonthStartAdd = $_POST['monthStart'];
        $animeYearStartAdd = $_POST['yearStart'];
        $animeStartAdd = $animeYearStartAdd.'-'.$animeMonthStartAdd.'-'.$animeDayStartAdd;
        $animeDayEndAdd = $_POST['dayEnd'];
        $animeMonthEndAdd = $_POST['monthEnd'];
        $animeYearEndAdd = $_POST['yearEnd'];
        $animeEndAdd = $animeYearEndAdd.'-'.$animeMonthEndAdd.'-'.$animeDayEndAdd;

        /* Não permitir o título nulo e avatar nulo*/
        if(empty($animeTitleAdd) || empty($animeAvatarNameAdd)) {
            header("Location: ../admin-add.php?config=add-anime");
            exit();
        }
        else {
            $sql = "SELECT animeID FROM anime";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $animeIDAddImage = $row['animeID']+1;
                    }
                }
                else {
                    $animeIDAddImage = 1;
                }
            }

            /* Confirmações para enviar o avatar */
            if(!empty($animeAvatarNameAdd)) {
                if(in_array($animeAvatarActualExtAdd, $allowed)) {
                    if($animeAvatarErrorAdd === 0) {
                        if($animeAvatarSizeAdd < 3000000) {
                            $animeAvatarAdd = $animeIDAddImage.".".$animeAvatarActualExtAdd;
                            $animeAvatarDestinationAdd = '../media/anime/avatar/'.$animeAvatarAdd;
                        }
                    }
                    else {
                        header("Location: ../admin-add.php?config=add-anime");
                        exit();
                    }
                }
                else {
                    header("Location: ../admin-add.php?config=add-anime");
                    exit();
                }
            }
            
            /* Confirmações para enviar o banner */
            if(!empty($animeBannerNameAdd)) {
                if(in_array($animeBannerActualExtAdd, $allowed)) {
                    if($animeBannerErrorAdd === 0) {
                        if($animeBannerSizeAdd < 6000000) {
                            $animeBannerAdd = $animeIDAddImage.".".$animeBannerActualExtAdd;
                            $animeBannerDestinationAdd = '../media/anime/banner/'.$animeBannerAdd;
                        }
                    }
                    else {
                        header("Location: ../admin-add.php?config=add-anime");
                        exit();
                    }
                }
                else {
                    header("Location: ../admin-add.php?config=add-anime");
                    exit();
                }
            }

            /* Se a sinopse/banner/source não possuir nenhuma informação */
            if(empty($animeSinopseAdd)) {
                $animeSinopseAdd = null;
            }
            if(empty($animeBannerAdd)) {
                $animeBannerAdd = null;
            }
            if(empty($animeSourceAdd)) {
                $animeSourceAdd = null;
            }

            /* Se os episódios não forem números | for nulo | ou maior que 4 digitos || ou menor que 0*/
            if(!is_numeric($animeEpisodesAdd)|| empty($animeEpisodesAdd) || strlen($animeEpisodesAdd) > 4 || $animeEpisodesAdd < 0) {
                $animeEpisodesAdd = null;
            }

            /* Se o ano de início for nulo | Se o dia não for nulo, mas o mês sim | Se a data for nula */
            if($animeYearStartAdd == '0000') {
                $animeStartAdd = null;
            }
            if($animeMonthStartAdd == '00' && $animeDayStartAdd != '00') {
                $animeStartAdd = null;
            }
            if($animeYearStartAdd == '0000' && $animeMonthStartAdd == '00' && $animeDayStartAdd == '00') {
                $animeStartAdd = null;
            }

            /* Se o ano de término for nulo | Se o dia não for nulo, mas o mês sim | Se a data for nula */
            if($animeYearEndAdd == '0000') {
                $animeEndAdd = null;
            }
            if($animeMonthEndAdd == '00' && $animeDayEndAdd != '00') {
                $animeEndAdd = null;
            }
            if($animeYearEndAdd == '0000' && $animeMonthEndAdd == '00' && $animeDayEndAdd == '00') {
                $animeEndAdd = null;
            }

            /* Se a data de término for menor que a de início */
            if($animeStartAdd > $animeEndAdd) {
                $animeStartAdd = null;
                $animeEndAdd = null;
            }
            
            /* Pegar os gêneros */
            if(!isset($_POST['genres'])) {
                $animeGenresAdd = null;
            }
            else {
                $animeGenresAdd = implode(', ', $_POST['genres']);
            }

            $sql = "INSERT INTO anime (animeTitle, animeSinopse, animeAvatar, animeBanner, animeType, animeEpisodes, animeStatus, animeStart, animeEnd, animeSource, animeGenres) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ap preparar as declarações';
            }
            else {
                move_uploaded_file($animeAvatarTmpNameAdd, $animeAvatarDestinationAdd);

                if(isset($animeBannerAdd)) {
                    move_uploaded_file($animeBannerTmpNameAdd, $animeBannerDestinationAdd);
                }
                else {
                    $animeBannerAdd = null;
                }
                
                mysqli_stmt_bind_param($stmt, "sssssssssss", $animeTitleAdd, $animeSinopseAdd, $animeAvatarAdd, $animeBannerAdd, $animeTypeAdd, $animeEpisodesAdd, $animeStatusAdd, $animeStartAdd, $animeEndAdd, $animeSourceAdd, $animeGenresAdd);
                mysqli_stmt_execute($stmt);
            }
        }

        /* Pegar o ID do anime que foi inserido */
        $animeIDAdd = mysqli_insert_id($conn);

        /* Verificar o número de personagens que existem no banco de dados */
        $sqlCharacterVerify = "SELECT characterID FROM characters";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlCharacterVerify)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_execute($stmt);
            $characterVerify = mysqli_stmt_get_result($stmt);
            $characterVerifyTotal = mysqli_num_rows($characterVerify);
        }

        /* Pegar o ID de cada personagem e se ele é principal ou secundário */
        $characterIDPost = $_POST['characterID'];
        $characterRolePost = $_POST['characterRole'];
        for($i = 0; $i <= 5; $i++) {
            $characterIDAdd = $characterIDPost[$i];
            $characterRoleAdd = $characterRolePost[$i];
            /* Adicionar na tabela apenas se existir um personagem a ser adicionado no formulário e se o personagem existir no banco de dados */
            if($characterIDAdd > 0 && $characterIDAdd <= $characterVerifyTotal && !empty($characterRoleAdd)) {
                $sqlCharactersAdd = "INSERT INTO anime_characters (animeID, characterID, characterRole) VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sqlCharactersAdd)) {
                    echo 'Erro ao preparar as declarações';
                }
                else {
                    mysqli_stmt_bind_param($stmt, "sss", $animeIDAdd, $characterIDAdd, $characterRoleAdd);
                    mysqli_stmt_execute($stmt);
                }
            }
        } 
        /* Atualizar o AUTO_INCREMENT da tabela, para evitar erros */
        $sqlTableUpdate = "SET @num = 0;";
        $sqlTableUpdate .= "UPDATE anime_characters SET ID = @num := (@num+1);";
        $sqlTableUpdate .= "ALTER TABLE anime_characters AUTO_INCREMENT =1;";
        mysqli_multi_query($conn, $sqlTableUpdate);

        /* Voltar para a página de adição de anime */
        header("Location: ../admin-add.php?config=add-anime");
    }

    /* Adicionar manga */
    if(isset($_POST['manga-add'])) {
        $mangaTitleAdd = $_POST['title'];
        $mangaSinopseAdd = $_POST['sinopse'];

        /* Pegar o avatar e banner */
        $mangaAvatarNameAdd = $_FILES['avatar']['name'];
        $mangaAvatarTmpNameAdd = $_FILES['avatar']['tmp_name'];
        $mangaAvatarSizeAdd = $_FILES['avatar']['size'];
        $mangaAvatarErrorAdd = $_FILES['avatar']['error'];

        $mangaBannerNameAdd = $_FILES['banner']['name'];
        $mangaBannerTmpNameAdd = $_FILES['banner']['tmp_name'];
        $mangaBannerSizeAdd = $_FILES['banner']['size'];
        $mangaBannerErrorAdd = $_FILES['banner']['error'];

        $mangaAvatarExtAdd = explode('.', $mangaAvatarNameAdd);
        $mangaAvatarActualExtAdd = strtolower(end($mangaAvatarExtAdd));
        
        $mangaBannerExtAdd = explode('.', $mangaBannerNameAdd);
        $mangaBannerActualExtAdd = strtolower(end($mangaBannerExtAdd));

        $mangaTypeAdd = $_POST['type'];
        $mangaChaptersAdd = $_POST['chapters'];
		$mangaVolumesAdd = $_POST['volumes'];
        $mangaStatusAdd = $_POST['status'];
        $mangaDayStartAdd = $_POST['dayStart'];
        $mangaMonthStartAdd = $_POST['monthStart'];
        $mangaYearStartAdd = $_POST['yearStart'];
        $mangaStartAdd = $mangaYearStartAdd.'-'.$mangaMonthStartAdd.'-'.$mangaDayStartAdd;
        $mangaDayEndAdd = $_POST['dayEnd'];
        $mangaMonthEndAdd = $_POST['monthEnd'];
        $mangaYearEndAdd = $_POST['yearEnd'];
        $mangaEndAdd = $mangaYearEndAdd.'-'.$mangaMonthEndAdd.'-'.$mangaDayEndAdd;

        /* Não permitir o título e avatar nulo */
        if(empty($mangaTitleAdd) || empty($mangaAvatarNameAdd)) {
            header("Location: ../admin-add.php?config=add-manga");
            exit();
        }
        else {
            $sql = "SELECT mangaID FROM manga";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $mangaIDAddImage = $row['mangaID']+1;
                    }
                }
                else {
                    $mangaIDAddImage = 1;
                }
            }

            /* Confirmações para enviar o avatar */
            if(!empty($mangaAvatarNameAdd)) {
                if(in_array($mangaAvatarActualExtAdd, $allowed)) {
                    if($mangaAvatarErrorAdd === 0) {
                        if($mangaAvatarSizeAdd < 3000000) {
                            $mangaAvatarAdd = $mangaIDAddImage.".".$mangaAvatarActualExtAdd;
                            $mangaAvatarDestinationAdd = '../media/manga/avatar/'.$mangaAvatarAdd;
                        }
                    }
                    else {
                        header("Location: ../admin-add.php?config=add-manga");
                        exit();
                    }
                }
                else {
                    header("Location: ../admin-add.php?config=add-manga");
                    exit();
                }
            }
            
            /* Confirmações para enviar o banner */
            if(!empty($mangaBannerNameAdd)) {
                if(in_array($mangaBannerActualExtAdd, $allowed)) {
                    if($mangaBannerErrorAdd === 0) {
                        if($mangaBannerSizeAdd < 6000000) {
                            $mangaBannerAdd = $mangaIDAddImage.".".$mangaBannerActualExtAdd;
                            $mangaBannerDestinationAdd = '../media/manga/banner/'.$mangaBannerAdd;
                        }
                    }
                    else {
                        header("Location: ../admin-add.php?config=add-manga");
                        exit();
                    }
                }
                else {
                    header("Location: ../admin-add.php?config=add-manga");
                    exit();
                }
            }

            /* Se a sinopse/banner não possuir nenhuma informação */
            if(empty($mangaSinopseAdd)) {
                $mangaSinopseAdd = null;
            }
            if(empty($mangaBannerAdd)) {
                $mangaBannerAdd = null;
            }

            /* Se os capítulos não forem números | for nulo | ou maior que 4 digitos || ou menor que 0*/
            if(!is_numeric($mangaChaptersAdd)|| empty($mangaChaptersAdd) || strlen($mangaChaptersAdd) > 4 || $mangaChaptersAdd < 0) {
                $mangaChaptersAdd = null;
            }

            /* Se os volumes não forem números | for nulo | ou maior que 4 digitos || ou menor que 0*/
            if(!is_numeric($mangaVolumesAdd)|| empty($mangaVolumesAdd) || strlen($mangaVolumesAdd) > 4 || $mangaVolumesAdd < 0) {
                $mangaVolumesAdd = null;
            }

            /* Se o ano de início for nulo | Se o dia não for nulo, mas o mês sim | Se a data for nula */
            if($mangaYearStartAdd == '0000') {
                $mangaStartAdd = null;
            }
            if($mangaMonthStartAdd == '00' && $mangaDayStartAdd != '00') {
                $mangaStartAdd = null;
            }
            if($mangaYearStartAdd == '0000' && $mangaMonthStartAdd == '00' && $mangaDayStartAdd == '00') {
                $mangaStartAdd = null;
            }

            /* Se o ano de término for nulo | Se o dia não for nulo, mas o mês sim | Se a data for nula */
            if($mangaYearEndAdd == '0000') {
                $mangaEndAdd = null;
            }
            if($mangaMonthEndAdd == '00' && $mangaDayEndAdd != '00') {
                $mangaEndAdd = null;
            }
            if($mangaYearEndAdd == '0000' && $mangaMonthEndAdd == '00' && $mangaDayEndAdd == '00') {
                $mangaEndAdd = null;
            }

            /* Se a data de término for maior que a de início */
            if($mangaStartAdd > $mangaEndAdd) {
                $mangaStartAdd = null;
                $mangaEndAdd = null;
            }

            /* Pegar os gêneros */
            if(!isset($_POST['genres'])) {
                $mangaGenresAdd = null;
            }
            else {
                $mangaGenresAdd = implode(', ', $_POST['genres']);
            }

            $sql = "INSERT INTO manga (mangaTitle, mangaSinopse, mangaAvatar, mangaBanner, mangaType, mangaChapters, mangaVolumes, mangaStatus, mangaStart, mangaEnd, mangaGenres) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                move_uploaded_file($mangaAvatarTmpNameAdd, $mangaAvatarDestinationAdd);

                if(isset($mangaBannerAdd)) {
                    move_uploaded_file($mangaBannerTmpNameAdd, $mangaBannerDestinationAdd);
                }
                else {
                    $mangaBannerAdd = null;
                }

                mysqli_stmt_bind_param($stmt, "sssssssssss", $mangaTitleAdd, $mangaSinopseAdd, $mangaAvatarAdd, $mangaBannerAdd, $mangaTypeAdd, $mangaChaptersAdd, $mangaVolumesAdd, $mangaStatusAdd, $mangaStartAdd, $mangaEndAdd, $mangaGenresAdd);
                mysqli_stmt_execute($stmt);
            }
        }

        /* Pegar o ID do manga que foi inserido */
        $mangaIDAdd = mysqli_insert_id($conn);

        /* Verificar o número de personagens que existem no banco de dados */
        $sqlCharacterVerify = "SELECT characterID FROM characters";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sqlCharacterVerify)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_execute($stmt);
            $characterVerify = mysqli_stmt_get_result($stmt);
            $characterVerifyTotal = mysqli_num_rows($characterVerify);
        }

        /* Pegar o ID de cada personagem e se ele é principal ou secundário */
        $characterIDPost = $_POST['characterID'];
        $characterRolePost = $_POST['characterRole'];
        for($i = 0; $i <= 5; $i++) {
            $characterIDAdd = $characterIDPost[$i];
            $characterRoleAdd = $characterRolePost[$i];
            /* Adicionar na tabela apenas se existir um personagem a ser adicionado no formulário e se o personagem existir no banco de dados */
            if($characterIDAdd > 0 && $characterIDAdd <= $characterVerifyTotal && !empty($characterRoleAdd)) {
                $sqlCharactersAdd = "INSERT INTO manga_characters (mangaID, characterID, characterRole) VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sqlCharactersAdd)) {
                    echo 'Erro ao preparar as declarações';
                }
                else {
                    mysqli_stmt_bind_param($stmt, "sss", $mangaIDAdd, $characterIDAdd, $characterRoleAdd);
                    mysqli_stmt_execute($stmt);
                }
            }
        } 
        /* Atualizar o AUTO_INCREMENT da tabela, para evitar erros */
        $sqlTableUpdate = "SET @num = 0;";
        $sqlTableUpdate .= "UPDATE manga_characters SET ID = @num := (@num+1);";
        $sqlTableUpdate .= "ALTER TABLE manga_characters AUTO_INCREMENT =1;";
        mysqli_multi_query($conn, $sqlTableUpdate);

        /* Voltar para a página de adição de manga */
        header("Location: ../admin-add.php?config=add-manga");
    }

    /* Adicionar personagem */
    if(isset($_POST['character-add'])) {
        $characterNameAdd = $_POST['name'];
    
        /* Pegar o avatar */
        $characterAvatarNameAdd = $_FILES['avatar']['name'];
        $characterAvatarTmpNameAdd = $_FILES['avatar']['tmp_name'];
        $characterAvatarSizeAdd = $_FILES['avatar']['size'];
        $characterAvatarErrorAdd = $_FILES['avatar']['error'];
        
        $characterAvatarExtAdd = explode('.', $characterAvatarNameAdd);
        $characterAvatarActualExtAdd = strtolower(end($characterAvatarExtAdd));
                
        $characterInfoAdd = $_POST['info'];

        /* Se o nome/avatar for nulo */
        if(empty($characterNameAdd) || empty($characterAvatarNameAdd)) {
            header("Location: ../admin-add.php?config=add-character");
        }
        else {
            $sql = "SELECT characterID FROM characters";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $characterIDAddImage = $row['characterID']+1;
                    }
                }
                else {
                    $characterIDAddImage = 1;
                }
            }

            /* Confirmações para enviar o avatar */
            if(!empty($characterAvatarNameAdd)) {
                if(in_array($characterAvatarActualExtAdd, $allowed)) {
                    if($characterAvatarErrorAdd === 0) {
                        if($characterAvatarSizeAdd < 3000000) {
                            $characterAvatarAdd = $characterIDAddImage.".".$characterAvatarActualExtAdd;
                            $characterAvatarDestinationAdd = '../media/characters/avatar/'.$characterAvatarAdd;
                        }
                    }
                    else {
                        header("Location: ../admin-add.php?config=add-character");
                        exit();
                    }
                }
                else {
                    header("Location: ../admin-add.php?config=add-character");
                    exit();
                }
            }

            /* Se a informação for nula */
            if(empty($characterInfoAdd)) {
                $characterInfoAdd = null;
            }
            $sql = "INSERT INTO characters(characterName, characterAvatar, characterInfo) VALUES (?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'Erro ao preparar as declarações';
            }
            else {
                move_uploaded_file($characterAvatarTmpNameAdd, $characterAvatarDestinationAdd);
                mysqli_stmt_bind_param($stmt, "sss", $characterNameAdd, $characterAvatarAdd, $characterInfoAdd);
                mysqli_stmt_execute($stmt);
                header("Location: ../admin-add.php?config=add-character");
            }
        }
    }
?>