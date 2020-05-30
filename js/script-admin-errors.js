$(document).ready(function() {
    var config = location.href.substring(location.href.lastIndexOf('=') +1);

    // Erros ao adicionar e editar anime
    $("#anime-add, #anime-edit").submit(function() {
        // Pegar valores
        var anime_title = $("#anime-title").val();

        var avatar = $("#avatar").val();
        var avatarCheck = $(".error-messages.e-avatar").text();

        var bannerCheck = $(".error-messages.e-banner").text();

        var anime_episodes = $("#anime-episodes").val();

        var animeDayStart = $("#animeDayStart").val();
        var animeMonthStart = $("#animeMonthStart").val();
        var animeYearStart = $("#animeYearStart").val();
        var animeStart = animeYearStart+animeMonthStart+animeDayStart;
     
        var animeDayEnd = $("#animeDayEnd").val();
        var animeMonthEnd = $("#animeMonthEnd").val();
        var animeYearEnd = $("#animeYearEnd").val();
        var animeEnd = animeYearEnd+animeMonthEnd+animeDayEnd;
    
        // Verificar envio
        var submit = true;

        // Confirmar o título
        if(anime_title == "") {
            $(".error-messages:nth-of-type(1)").html("* O título não pode ser nulo");
            submit = false;
        }
        else {
            $(".error-messages:nth-of-type(1)").html("");
        }

        // Confirmar o avatar
        if(avatar == "" && config == "add-anime") {
            $(".error-messages:nth-of-type(2)").html("* É necessário inserir um avatar");
            submit = false;
        }
        else if(avatarCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(2)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(avatarCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(2)").html("* Sua imagem é muito grande!");
            submit = false;
        }

        // Confirmar o banner
        if(bannerCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(3)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(bannerCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(3)").html("* Sua imagem é muito grande!");
            submit = false;
        }

        // Confirmar número de episódios
        if(anime_episodes.length > 0) {
            if(!$.isNumeric(anime_episodes) || anime_episodes.length > 4) {
                $(".error-messages:nth-of-type(4)").html("* O número de episódios é inválido.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(4)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(4)").html("");
        }

        // Confirmar a data
        // Início
        if(animeYearStart != '0000' || animeMonthStart != '00' || animeDayStart != '00'){
            if(animeYearStart == '0000') {
                $(".error-messages:nth-of-type(5)").html("* Insira uma data de início válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else if(animeMonthStart == '00' && animeDayStart != '00') {
                $(".error-messages:nth-of-type(5)").html("* Insira uma data de início válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(5)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(5)").html("");
        }

        // Término
        if(animeYearEnd != '0000' || animeMonthEnd != '00' || animeDayEnd != '00'){
            if(animeYearEnd == '0000') {
                $(".error-messages:nth-of-type(6)").html("* Insira uma data de término válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else if(animeMonthEnd == '00' && animeDayEnd != '00') {
                $(".error-messages:nth-of-type(6)").html("* Insira uma data de término válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(6)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(6)").html("");
        }

        // Comparar a data e verificar se é aceitável
        if(animeEnd > 0) {
            if(animeStart > animeEnd) {
                $(".error-messages:nth-of-type(7)").html("* A data de início não pode ser maior que a de término.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(7)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(7)").html("");
        }

        return submit;
    });

    // Erros ao adicionar e editar manga
    $("#manga-add, #manga-edit").submit(function() {
        // Pegar valores
        var manga_title = $("#manga-title").val();

        var avatar = $("#avatar").val();
        var avatarCheck = $(".error-messages.e-avatar").text();

        var bannerCheck = $(".error-messages.e-banner").text();

        var manga_chapters = $("#manga-chapters").val();
        var manga_volumes = $("#manga-volumes").val();

        var mangaDayStart = $("#mangaDayStart").val();
        var mangaMonthStart = $("#mangaMonthStart").val();
        var mangaYearStart = $("#mangaYearStart").val();
        var mangaStart = mangaYearStart+mangaMonthStart+mangaDayStart;
     
        var mangaDayEnd = $("#mangaDayEnd").val();
        var mangaMonthEnd = $("#mangaMonthEnd").val();
        var mangaYearEnd = $("#mangaYearEnd").val();
        var mangaEnd = mangaYearEnd+mangaMonthEnd+mangaDayEnd;
    
        // Verificar envio
        var submit = true;

        // Confirmar o título
        if(manga_title == "") {
            $(".error-messages:nth-of-type(1)").html("* O título não pode ser nulo");
            submit = false;
        }
        else {
            $(".error-messages:nth-of-type(1)").html("");
        }

        // Confirmar o avatar
        if(avatar == "" && config == "add-manga") {
            $(".error-messages:nth-of-type(2)").html("* É necessário inserir um avatar");
            submit = false;
        }
        else if(avatarCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(2)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(avatarCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(2)").html("* Sua imagem é muito grande!");
            submit = false;
        }

        // Confirmar o banner
        if(bannerCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(3)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(bannerCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(3)").html("* Sua imagem é muito grande!");
            submit = false;
        }

        // Confirmar número de capítulos
        if(manga_chapters.length > 0) {
            if(!$.isNumeric(manga_chapters) || manga_chapters.length > 4) {
                $(".error-messages:nth-of-type(4)").html("* O número de capítulos é inválido.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(4)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(4)").html("");
        }

        // Confirmar número de volumes
        if(manga_volumes.length > 0) {
            if(!$.isNumeric(manga_volumes) || manga_volumes.length > 4) {
                $(".error-messages:nth-of-type(5)").html("* O número de volumes é inválido.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(5)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(5)").html("");
        }

        // Confirmar a data
        // Início
        if(mangaYearStart != '0000' || mangaMonthStart != '00' || mangaDayStart != '00'){
            if(mangaYearStart == '0000') {
                $(".error-messages:nth-of-type(6)").html("* Insira uma data de início válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else if(mangaMonthStart == '00' && mangaDayStart != '00') {
                $(".error-messages:nth-of-type(6)").html("* Insira uma data de início válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(6)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(6)").html("");
        }

        // Término
        if(mangaYearEnd != '0000' || mangaMonthEnd != '00' || mangaDayEnd != '00'){
            if(mangaYearEnd == '0000') {
                $(".error-messages:nth-of-type(7)").html("* Insira uma data de término válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else if(mangaMonthEnd == '00' && mangaDayEnd != '00') {
                $(".error-messages:nth-of-type(7)").html("* Insira uma data de término válida dd/mm/yyyy, mm/yyyy ou 00-00-0000.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(7)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(7)").html("");
        }

        // Comparar a data e verificar se é aceitável
        if(mangaEnd > 0) {
            if(mangaStart > mangaEnd) {
                $(".error-messages:nth-of-type(8)").html("* A data de início não pode ser maior que a de término.");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(8)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(8)").html("");
        }

        return submit;
    });

    // Erros ao adicionar e editar personagens
    $("#character-add, #character-edit").submit(function() {
        // Pegar valores
        var character_name = $("#character-name").val();

        var avatar = $("#avatar").val();
        var avatarCheck = $(".error-messages.e-avatar").text();
    
        // Verificar envio
        var submit = true;

        // Confirmar o nome
        if(character_name == "") {
            $(".error-messages:nth-of-type(1)").html("* O nome não pode ser nulo");
            submit = false;
        }
        else {
            $(".error-messages:nth-of-type(1)").html("");
        }

        // Confirmar o avatar
        if(avatar == "" && config == "add-character") {
            $(".error-messages:nth-of-type(2)").html("* É necessário inserir um avatar");
            submit = false;
        }
        else if(avatarCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(2)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(avatarCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(2)").html("* Sua imagem é muito grande!");
            submit = false;
        }

        return submit;
    });

    // Erros ao editar usuários
    $("#user-edit").submit(function() {
        // Pegar valores
        var username = $("#userName").val();
        var email = $("#userEmail").val();
        var password = $("#userPassword").val();
        var avatarCheck = $(".error-messages.e-avatar").text();
        var bannerCheck = $(".error-messages.e-banner").text();
        var bannerListCheck = $(".error-messages.e-bannerList").text();
        var user_about = $("#userAbout").val();
        var user_localization = $("#userLocalization").val();
        var user_day = $("#userDay").val();
        var user_month = $("#userMonth").val();
        var user_year = $("#userYear").val();
        var birthday = user_day + user_month + user_year;

        // Valores aceitos
        var username_accept = /^[A-Za-z-0-9]+$/;
        var email_accept = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        var password_accept = /^[A-Za-z-0-9-*]+$/;

        // Verificar envio
        var submit = true;

        // Confirmar o nome de usúario
        if(username.length < 2 || username.length > 16 || !username.match(username_accept)) {
            $(".error-messages:nth-of-type(1)").html("* O nome de usúario precisa ter de 2 a 16 caracteres. [A-Za-z] [0-9]");
            submit = false;
        }
        else {
            $(".error-messages:nth-of-type(1)").html("");
        }

        // Confirmar email
        if(email == "" || !email.match(email_accept)) {
            $(".error-messages:nth-of-type(2)").html("* É necessário colocar um email válido");
            submit = false;
        }
        else {
            $(".error-messages:nth-of-type(2)").html("");
        }

        // Confirmar senha
        if(password.length > 0) {
            if(password.length < 5 || password.length > 16 || !password.match(password_accept)) {
                $(".error-messages:nth-of-type(3)").html("* A senha precisa ter de 5 a 16 caracteres. [A-Za-z] [0-9] [*]");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(3)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(3)").html("");
        }

        // Confirmar o avatar
        if(avatarCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(4)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(avatarCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(4)").html("* Sua imagem é muito grande!");
            submit = false;
        }

        // Confirmar o banner
        if(bannerCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(5)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(bannerCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(5)").html("* Sua imagem é muito grande!");
            submit = false;
        }
        
        // Confirmar o banner da lista
        if(bannerListCheck == "* Este tipo de imagem não é permitido!") {
            $(".error-messages:nth-of-type(6)").html("* Este tipo de imagem não é permitido!");
            submit = false;
        }
        else if(bannerListCheck == "* Sua imagem é muito grande!") {
            $(".error-messages:nth-of-type(6)").html("* Sua imagem é muito grande!");
            submit = false;
        }

        // Confirmar envio sobre o usúario
        if(user_about.length > 5000) {
            $(".error-messages:nth-of-type(7)").html("* Não é permitido mais que 5000 caracteres");
            submit = false;
        }
        else {
            $(".error-messages:nth-of-type(7)").html("");
        }

        // Confirmar a data de aniversário
        if(birthday > 0) {
            if(user_day == "00" || user_month == "00" || user_year == "0000" ) {
                $(".error-messages:nth-of-type(8)").html("* Insira uma data de aniversário válida");
                submit = false;
            }
            else {
                $(".error-messages:nth-of-type(8)").html("");
            }
        }
        else {
            $(".error-messages:nth-of-type(8)").html("");
        }

        // Confirmar envio da localização
        if(user_localization.length > 12) {
            $(".error-messages:nth-of-type(9)").html("* A localização não pode ser maior que 12 caracteres");
            submit = false;
        }
        else {
            $(".error-messages:nth-of-type(9)").html("");
        }

        return submit
    });
});