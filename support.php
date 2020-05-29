<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Suporte - MinhaLista</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="img/icon1.png">
        <link rel="stylesheet" type="text/css" href="css/support.css">
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/footer.css">
        <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css.css">
    </head>
    <body>
        <?php
            include "menu.php";
        ?>

        <div class="page-wrap">
            <div class="container-all">
                <div class="container">
                    <div class="logo">
                        <img src="img/logo1.png">
                    </div>
                    <p>O português é o único idioma disponível para suporte no MinhaLista, não podemos responder a perguntas em outros idiomas. Pedimos desculpas pela inconveniência.</p>  
                    <p>Contate nosso suporte caso tenha problemas com:</p>

                    <h3>Problemas com acesso a conta</h3>
                    <li>Não me lembro do meu e-mail registrado.</li>
                    <li>Não me lembro da minha senha registrada.</li>
                    <li>Qualquer outro problema de acesso.</li>

                    <h3>Problemas com o perfil ou com a lista de anime / manga</h3>
                    <li>Erros de upload de imagem.</li>
                    <li>Problemas de exibição.</li>
                    <li>Erros de estatística.</li>
                    <li>Relatório de abuso (usuários, imagens, comentários etc...)</li>

                    <h3>Problemas no banco de dados (anime, manga ou personagem)</h3>
                    <li>Para fazer solicitações de alterações no banco de dados, adições ou relatar outros problemas.</li>

                    <h3>Sugestões para recursos / alterações</h3>
                    <li>Para sugerir alterações no site ou novos recursos.</li>

                    <h3>Relatórios de erros / bugs</h3>
                    <li>Relatório de erros.</li>
                    <li>Relatório de bugs.</li>

                    <h3>Outras perguntas</h3>
                    <li>Sinta-se livre para obter suporte sobre qualquer outra coisa relacionado ao MinhaLista, porém que não está listada acima.</li>

                    <div class="support-info">
                        <p>Para obter suporte envie um email para minhalista@gmail.com com todas as informações possíveis para que possamos ajudá-lo.</p>
                        <p>Você será respondido dentro de um periódo de 7 dias úteis. Não esqueça de verificar sua caixa de spam.</p>
                    </div>
                </div>
            </div>
        </div>

        <?php
            include "footer.php";
        ?>
    </body>
</html>