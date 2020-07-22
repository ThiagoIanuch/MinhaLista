<?php
    session_start();
    include "includes/manga-ranking.inc.php";
    $page = $_GET['page'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Mangá Ranking - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/ranking.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="container">
                <div class="ranking-container">

                    <div class="page-buttons-top">
                        <?php
                        $pageSum = 1;
                        $pageNext = $page+$pageSum;
                        $pagePrevious = $page-$pageSum;
                        if($page <= $total_pages && $page != 1) {
                            echo '<a href="manga-ranking.php?page='.$pagePrevious.'" class="page-button">Anterior</a>';
                        }
                        if($page < $total_pages) {
                            echo '<a href="manga-ranking.php?page='.$pageNext.'" class="page-button">Próximo</a>';
                        }
                        ?>
                    </div>

                    <div class="grid-header">
                        <div class="rank">Rank</div>
                        <div class="title">Título</div>
                        <div class="score">Pontuação</div>
                        <div class="your-score">Sua pontuação</div>
                        <div class="status">Status</div>
                    </div>
                    <div class="grid">
                        <?php
                            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                            date_default_timezone_set('America/Sao_Paulo');
                            
                            for($i = 0, $ii=0;$i < count($mangaID), $i < count($mangaTitle), $i < count($mangaAvatar), $i < count($mangaType), $i < count($mangaVolumes), $i < count($mangaStart), $i < count ($mangaEnd), $i < count($mangaUsers), $i < count($mangaScore); $i++, $ii++) {
                            
                            $dayStart[$i] = substr($mangaStart[$i], -2, 2); // Dia início
                            $monthStart[$i] = substr($mangaStart[$i], -5, 2); // Mes início
                            $yearStart[$i] = substr($mangaStart[$i], -10, 4); // Ano início

                            $dayEnd[$i] = substr($mangaEnd[$i], -2, 2); // Dia final
                            $monthEnd[$i] = substr($mangaEnd[$i], -5, 2); // Mês final
                            $yearEnd[$i] = substr($mangaEnd[$i], -10, 4); // Ano final
                                            
                            // Data de início
                            if($mangaStart[$i] != null) {
                                // Exibir o mês e o ano
                                if($yearStart[$i] > 0 && $monthStart[$i] > 0 && $dayStart[$i] >= 0) {
                                    $mangaStart[$i] = $yearStart[$i].'-'.$monthStart[$i].'-'.'01';
                                    $mangaStart[$i] = strftime('%b, %Y',strtotime($mangaStart[$i])).' até ';
                                }
                                // Se o mês for nulo, exibir apenas o ano
                                else if($yearStart[$i] > 0 && $monthStart[$i] <= 0 && $dayStart[$i] <= 0) {
                                    $mangaStart[$i] = $yearStart[$i].'-'.'01'.'-'.'01';
                                    $mangaStart[$i] = strftime('%Y',strtotime($mangaStart[$i])).' até ';
                                }
                                else {
                                    $mangaStart[$i] = '? até ';
                                }
                            }
                            else if($mangaStart[$i] == null && $mangaEnd[$i] == null) {
                                $mangaStart[$i] = 'Desconhecido';
                            }
                            else {
                                $mangaStart[$i] = '? até ';
                            }

                            // Data de término
                            if($mangaEnd[$i] != null) {
                                // Exibir o mês e o ano
                                if($yearEnd[$i] > 0 && $monthEnd[$i] > 0 && $dayEnd[$i] >= 0) {
                                    $mangaEnd[$i] = $yearEnd[$i].'-'.$monthEnd[$i].'-'.'01';
                                    $mangaEnd[$i] = strftime('%b, %Y',strtotime($mangaEnd[$i]));
                                }
                                // Se o mês for nulo, exibir apenas o ano
                                else if($yearEnd[$i] > 0 && $monthEnd[$i] <= 0 && $dayEnd[$i] <= 0) {
                                    $mangaEnd[$i] = $yearEnd[$i].'-'.'01'.'-'.'01';
                                    $mangaEnd[$i] = strftime('%Y',strtotime($mangaEnd[$i]));
                                }
                                else {
                                    $mangaEnd[$i] = '?';
                                }
                            }
                            else if($mangaStart[$i] == "Desconhecido" && $mangaEnd[$i] == null) {
                                $mangaEnd[$i] = '';
                            }
                            else {
                                $mangaEnd[$i] = '?';
                            }

                            $mangaAired[$i] = ucfirst($mangaStart[$i]).ucfirst($mangaEnd[$i]);

                            if(empty($mangaVolumes[$i])) {
                                $mangaVolumes[$i] = '?';
                            }

                            if(empty($mangaUsers[$i])) {
                                $mangaUsers[$i] = '?';
                            }

                            if($mangaScore[$i] == 0.00) {
                                $mangaScore[$i] = 'N/A';
                            }
                            else {
                                $mangaScore[$i] = number_format($mangaScore[$i], 2);
                            }

                            if(isset($mangaIDCheck[$i]) && $mangaIDCheck[$i] == $mangaID[$i]) {
                                if(empty($userScore[$i])) {
                                    $userScore[$i] = "N/A";
                                }
                                else {
                                    $userScore[$i] = number_format($userScore[$i], 2);
                                }

                                if(empty($userStatus[$i])) {
                                    $userStatus[$i] = "Adicionar a lista";
                                    $statusColor = "not-add";
                                }
                                else if($userStatus[$i] == 1) {
                                    $userStatus[$i] = 'Lendo';
                                    $statusColor = "reading";
                                }
                                else if($userStatus[$i] == 2) {
                                    $userStatus[$i] = 'Completado';
                                    $statusColor = "completed";
                                }
                                else if($userStatus[$i] == 3) {
                                    $userStatus[$i] = 'Desistiu';
                                    $statusColor = "dropped";
                                }
                                else if($userStatus[$i] == 4) {
                                    $userStatus[$i] = 'Planeja ler';
                                    $statusColor = "plan";
                                }
                            }
                            else {
                                $userStatus[$i] = "Adicionar a lista";
                                $userScore[$i] = "N/A";
                                $statusColor = "not-add";
                            }

                            if($page == 1) {
                                $page_itens = $ii + $page;
                            }
                            else {
                                $page_itens = (($page*5)-4+$ii);
                            }
                            echo '
                            <div class="rank">
                                <span class="rank-number">'
                                    .$page_itens.'
                                </span>
                            </div>
                            
                            <div class="title info">
                                <a href="manga.php?mangaid='.$mangaID[$i].'"><div class="avatar" style="background-image:url(media/manga/avatar/'.$mangaAvatar[$i].')"></div></a>
                                <div class="content">
                                    <div class="manga-title"><a href="manga.php?mangaid='.$mangaID[$i].'">'.$mangaTitle[$i].'</a></div>
                                    <div>'.$mangaType[$i].' ('.$mangaVolumes[$i].' vols)</div>
                                    <div>'.$mangaAired[$i].'</div>
                                    <div>'.$mangaUsers[$i].' usuários</div>
                                </div>
                            </div>
                                    
                            <div class="score grid3">
                                <div class="star-icon" style="background-image:url(img/star.png)"> </div> 
                                <div class="score-total">'.$mangaScore[$i].'</div>
                            </div>       

                            <div class="your-score grid3">
                                <div class="star-icon" style="background-image:url(img/star.png)"> </div> 
                                <div class="score-total">
                                    <a href="manga.php?mangaid='.$mangaID[$i].'">'.$userScore[$i].'</a>
                                </div>
                            </div>
                            
                            <div class="status">
                                <a href="manga.php?mangaid='.$mangaID[$i].'" class="your-status '.$statusColor.'">'.$userStatus[$i].'</a>
                            </div>
                            ';
                            }
                        ?>
                    </div>
                </div>

                <div class="page-buttons-bottom">
                    <?php
                        $pageSum = 1;
                        $pageNext = $page+$pageSum;
                        $pagePrevious = $page-$pageSum;
                        if($page <= $total_pages && $page != 1) {
                            echo '<a href="manga-ranking.php?page='.$pagePrevious.'" class="page-button">Anterior</a>';
                        }
                        if($page < $total_pages) {
                            echo '<a href="manga-ranking.php?page='.$pageNext.'" class="page-button">Próximo</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
            include "footer.php";
        ?>
    </body>
</html>