<?php
    include "db.inc.php";

    // Exibir personagens na página de anime
    if(isset($_GET['animeid'])) {
        $sql = "SELECT c.characterID, c.characterName, c.characterAvatar, ac.characterRole FROM characters c JOIN anime_characters ac ON c.characterID = ac.characterID WHERE animeid=? ORDER BY ac.characterRole LIMIT 6";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $animeID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCharacters = mysqli_num_rows($result);
            if($resultCharacters > 0) {
                $characterID = array();
                $characterName = array();
                $characterAvatar = array();
                $characterRole = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $characterID[] = $row['characterID'];
                    $characterName[] = $row['characterName'];
                    $characterAvatar[] = $row['characterAvatar'];
                    $characterRole[] = $row['characterRole'];
                }
            }
            else {
                'Nenhum personaem encontrado';
            }
        }
    }

    // Exibir personagens na página de mangá
    if(isset($_GET['mangaid'])) {
        $sql = "SELECT c.characterID, c.characterName, c.characterAvatar, mc.characterRole FROM characters c JOIN manga_characters mc ON c.characterID = mc.characterID WHERE mangaid=? ORDER BY mc.characterRole LIMIT 6";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $mangaID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCharacters = mysqli_num_rows($result);
            if($resultCharacters > 0) {
                $characterID = array();
                $characterName = array();
                $characterAvatar = array();
                $characterRole = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $characterID[] = $row['characterID'];
                    $characterName[] = $row['characterName'];
                    $characterAvatar[] = $row['characterAvatar'];
                    $characterRole[] = $row['characterRole'];
                }
            }
            else {
                'Nenhum personaem encontrado';
            }
        }
    }

    // Exibir personagens na página de personagens
    if(isset($_GET['characterid'])) {
        $characterID = $_GET['characterid'];
        $sql = "SELECT characterID, characterName, characterAvatar, characterInfo FROM characters WHERE characterID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $characterID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $characterID = $row['characterID'];
                    $characterName = $row['characterName'];
                    $characterAvatar = $row['characterAvatar'];
                    $characterInfo = $row['characterInfo'];
                }
            }
            else {
                header("HTTP/1.1 404 Not Found");
                include "not-found-page.php";
                exit();
            }
        }
    }

    // Verificar se o usúario já adicionou nos favoritos
    if(isset($_SESSION['userID']) && isset($_GET['characterid'])) {
        $characterID = $_GET['characterid'];
        $userID = $_SESSION['userID'];
        $sql = "SELECT ID from characters_favorites WHERE characterID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $characterID, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCharacterFavorite = mysqli_num_rows($result);
        }
    }

    // Adicionar ou remover personagem dos favoritos
    if(isset($_POST['favorite-submit'])) {
        session_start();
        include "session-update.inc.php";

        $characterID = $_GET['characterid'];
        $userID = $_SESSION['userID'];
        
        $sql = "SELECT ID from characters_favorites WHERE characterID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $characterID, $userID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $resultCharacterFavorite = mysqli_num_rows($result);

            if($resultCharacterFavorite > 0) {
                header("Location: ../characters.php?characterid=".$characterID);
            }
            else {
                $sql = "SELECT ID from characters_favorites WHERE userID=?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'Erro ao preparar as declarações';
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s", $userID);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $resultCharacterFavoriteTotal = mysqli_num_rows($result);
                    if($resultCharacterFavoriteTotal >= 10) {
                        header("Location: ../characters.php?characterid=".$characterID);
                    }
                    else {
                        $sql = "INSERT INTO characters_favorites (characterID, userID) VALUES (?, ?)";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            echo 'Erro ao preparar as declarações';
                        }
                        else {
                            mysqli_stmt_bind_param($stmt, "ss", $characterID, $userID);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../characters.php?characterid=".$characterID);
                        }
                    } 
                }
            }
        }
    }

    if(isset($_POST['favorite-delete'])) {
        session_start();
        include "session-update.inc.php";
        
        $characterID = $_GET['characterid'];
        $userID = $_SESSION['userID'];
        $sql = "DELETE FROM characters_favorites WHERE characterID=? AND userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $characterID, $userID);
            mysqli_stmt_execute($stmt);

            $sqlTableUpdate = "SET @num = 0;";
            $sqlTableUpdate .= "UPDATE characters_favorites SET ID = @num := (@num+1);";
            $sqlTableUpdate .= "ALTER TABLE characters_favorites AUTO_INCREMENT =1;";
            mysqli_multi_query($conn, $sqlTableUpdate);

            header("Location: ../characters.php?characterid=".$characterID);
        }
    }

    // Contar número de favoritos
    if(isset($_GET['characterid'])) {
        $characterID = $_GET['characterid'];
        $sql = "SELECT ID from characters_favorites WHERE characterID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'Erro ao preparar as declarações';
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $characterID);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $characterFavoritesTotal = mysqli_num_rows($result);
        }
    }
?>