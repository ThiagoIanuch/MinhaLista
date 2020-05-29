$(document).ready(function() {
    // ID do anime/manga pela URL
    var animeID = location.href.substring(location.href.lastIndexOf('=') +1);
    var mangaID = location.href.substring(location.href.lastIndexOf('=') +1);

    // Anime
    // Form de status 
    $('#animeStatus').change(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: 'includes/anime-submit.inc.php?animeid='+animeID,
            data: $('#animeStatus').serialize(),
            success: function() {
                $('#animeStatus').css('background-color', 'rgba(255, 154, 60, 1)');
            }
        })
    });

    // Form de pontuação
    $('#animeScore').change(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'includes/anime-submit.inc.php?animeid='+animeID,
            data: $('#animeScore').serialize(),
            success: function() {
                $('#animeScore').css('background-color', 'rgba(255, 154, 60, 1)');
            }
        });
    });

    // Form de episódios
    $('#animeEpisodes').submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: 'includes/anime-submit.inc.php?animeid='+animeID,
            data: $('#animeEpisodes').serialize(),
            success : function(data) {
                $("#animeEpisodes").load(location.href + " #animeEpisodes>*", "", function(responseTxt, statusTxt){
                if(statusTxt == "success")
                    $('.user-episodes, .user-episodes input').css('background-color', 'rgba(255, 154, 60, 1)');
                if(statusTxt == "error")
                    alert("Erro ao atualizar o número de episódios. Por favor atualize atualize a página e tente novamente. ");
                });
            } 
        });     
    });

    // Manga
    // Form de status 
    $('#mangaStatus').change(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'post',
            url: 'includes/manga-submit.inc.php?mangaid='+mangaID,
            data: $('#mangaStatus').serialize(),
            success: function() {
                $('#mangaStatus').css('background-color', 'rgba(255, 154, 60, 1)');
            }
        })
    });

    // Form de pontuação
    $('#mangaScore').change(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'includes/manga-submit.inc.php?mangaid='+mangaID,
            data: $('#mangaScore').serialize(),
            success: function() {
                $('#mangaScore').css('background-color', 'rgba(255, 154, 60, 1)');
            }
        });
    });

    // Capítulos 
    $('#mangaChapters').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'includes/manga-submit.inc.php?mangaid='+mangaID,
            data: $('#mangaChapters').serialize(),
            success : function() {
                $("#mangaChapters").load(location.href + " #mangaChapters>*", "", function(responseTxt, statusTxt){
                    if(statusTxt == "success")
                        $('.user-chapters, .user-chapters input').css('background-color', 'rgba(255, 154, 60, 1)');
                    if(statusTxt == "error")
                        alert("Erro ao atualizar o número de capítulos. Por favor atualize atualize a página e tente novamente. ");
                });
            }
        });
    });

    // Volumes
    $('#mangaVolumes').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'includes/manga-submit.inc.php?mangaid='+mangaID,
            data: $('#mangaVolumes').serialize(),
            success : function() {
                $("#mangaVolumes").load(location.href + " #mangaVolumes>*", "", function(responseTxt, statusTxt){
                    if(statusTxt == "success")
                        $('.user-volumes, .user-volumes input').css('background-color', 'rgba(255, 154, 60, 1)');
                    if(statusTxt == "error")
                        alert("Erro ao atualizar o número de volumes. Por favor atualize atualize a página e tente novamente. ");
                });
            }
        });
    });

    // Configurações do perfil
    // Avatar
    $('#profile-avatar').change(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: 'includes/settings.inc.php',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == 'Erro1') {
                    $(".error-image.e-avatar").html("Este tipo de imagem não é permitido!");
                }
                else if(data == 'Erro2') {
                    $(".error-image.e-avatar").html("Ocorreu um erro ao enviar sua imagem. Tente novamente!");
                }
                else if(data == 'Erro3') {
                    $(".error-image.e-avatar").html("Sua imagem é muito grande.");
                }
                else {
                    $("#avatar-load").load(location.href + " #avatar-load>*", "");
                    $("#profile-avatar").load(location.href + " #profile-avatar>*", "");
                    $(".error-image.e-avatar").html("");
                }
            }
        });
    });

    // Banner
    $('#profile-banner').change(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: 'includes/settings.inc.php',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == 'Erro1') {
                    $(".error-image.e-banner").html("Este tipo de imagem não é permitido!");
                }
                else if(data == 'Erro2') {
                    $(".error-image.e-banner").html("Ocorreu um erro ao enviar sua imagem. Tente novamente!");
                }
                else if(data == 'Erro3') {
                    $(".error-image.e-banner").html("Sua imagem é muito grande.");
                }
                else {
                    $("#profile-banner").load(location.href + " #profile-banner>*", "");
                    $(".error-image.e-banner").html("")
                }
            }
        });
    });

    // Configurações da lista
    // Banner
    $('#list-banner').change(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: 'includes/settings.inc.php',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == 'Erro1') {
                    $(".error-image.e-bannerList").html("Este tipo de imagem não é permitido!");
                }
                else if(data == 'Erro2') {
                    $(".error-image.e-bannerList").html("Ocorreu um erro ao enviar sua imagem. Tente novamente!");
                }
                else if(data == 'Erro3') {
                    $(".error-image.e-bannerList").html("Sua imagem é muito grande.");
                }
                else {
                    $("#list-banner").load(location.href + " #list-banner>*", "");
                    $(".error-image.e-bannerList").html("");
                }
            }
        });
    });
});