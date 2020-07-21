// Mostrar função para ir para o outro tipo de lista e ir para o próprio perfil
$(document).ready(function() {
    $('#dropdown, #dropdown2').click(function(e){
        e.stopPropagation();
        $('#display').toggleClass('list-display-block');
    });
    $(document).click(function() {
        $('#display').removeClass('list-display-block');
    });
});
