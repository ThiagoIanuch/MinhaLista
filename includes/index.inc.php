<?php
    include "db.inc.php";

    // Genêro não permitido para selecionar
    $notGenre = '%Hentai%';
    
    // Selecionar anime
    $sql = "SELECT animeID, animeTitle, animeAvatar FROM anime WHERE animeGenres NOT LIKE ? OR animeGenres IS NULL ORDER BY RAND() LIMIT 5";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Erro ao preparar as declarações';
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $notGenre);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $animeID = array();
        $animeTitle = array();
        $animeAvatar = array();
        while($row = mysqli_fetch_assoc($result)) {
            $animeID[] = $row['animeID'];
            $animeTitle[] = $row['animeTitle'];
            $animeAvatar[] = $row['animeAvatar'];
        }
    }

    // Selecionar mangá
    $sql = "SELECT mangaID, mangaTitle, mangaAvatar FROM manga WHERE mangaGenres NOT LIKE ? OR mangaGenres IS NULL ORDER BY RAND() LIMIT 5";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Erro ao preparar as declarações';
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $notGenre);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $mangaID = array();
        $mangaTitle = array();
        $mangaAvatar = array();
        while($row = mysqli_fetch_assoc($result)) {
            $mangaID[] = $row['mangaID'];
            $mangaTitle[] = $row['mangaTitle'];
            $mangaAvatar[] = $row['mangaAvatar'];
        }
    }
?>