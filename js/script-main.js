
$(document).ready(function() {
    // Alterar texto na pagina
    $(function(){
        var text = 1;
        var string;
        $('#text-changing').html('SUA LISTA DE ANIME E MANGÁ');
        setInterval(function(){

            switch(text) {
                case 1: string = "CRIE SEU PERFIL"; break;
                case 2: string = "ADICIONE SEUS FAVORITOS"; break;
                case 3: string = "DESCUBRA NOVOS ANIME E MANGÁ"; break;
                case 4: string = "SUA LISTA DE ANIME E MANGÁ"; break;
            }
            $('#text-changing').html(string);
            
            text != 4 ? text++ : text = 1;
        }, 2000);
    });

    // Fechar e abrir o menu normal
    $(document).click(function() {
        $("#profile-links").hide();
        $("#profile").removeClass('clicked');
        $("#notifications-display").hide();
    });    

    $("#profile").click(function(e) {
        e.stopPropagation();
        $("#profile-links").fadeToggle();
        $("#profile").toggleClass('clicked');
        $("#notifications-display").hide();
    });

    // Notificações 
    $("#notifications").click(function(e) {
        e.stopPropagation();
        $("#profile-links").hide();
        $("#profile").removeClass('clicked');
        $("#notifications-display").fadeToggle();
    });

    // Fechar e abrir o menu responsivo //
    $(document).click(function() {
        $("#links").removeClass("view");
        $("#notifications-display-responsive").hide();
    });

    $("#links-activator").click(function(e) {
        e.stopPropagation();
        $("#links").toggleClass("view");
        $("#notifications-display-responsive").hide();
        $("#search").hide()
    });

    // Notificações menu responsivo
    $("#notificationsResponsive").click(function(e) {
        e.stopPropagation();
        $("#notifications-display-responsive").fadeToggle();
        $("#links").removeClass("view");
        $("#search").hide()
    });

    // Botão para abrir barra de pesquisa
    $("#searchResponsive").click(function(e){
        e.stopPropagation();
        $("#search").fadeToggle();
        $("#links").removeClass("view");
        $("#notifications-display-responsive").hide();  
    });

    // Auto completar a barra de pesquisa //
    $("#search-autocomplete").autocomplete({
        source: 'includes/search-autocomplete.php',
        minLength: 1,
        focus: function(){
            return false;
        },
        select: function(event, ui) {
            log(ui.item ? ui.item.id : "");
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {  
        return $("<li class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.label)
        .appendTo(ul);
    };  

    // Chamar o menu novamente ao redimensinar a página //
    $(window).resize(function() {
        $("#search-autocomplete").autocomplete("search");
    });
});