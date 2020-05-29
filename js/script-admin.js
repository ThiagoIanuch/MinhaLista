$(document).ready(function() {
    // Pegar url para saber a extensão permitida
    var url = new URL(window.location);
    var url = url.searchParams.get("userid");
    if(url > 0) {
        var fileExtAllow = ['jpg', 'jpeg', 'png', 'gif'];
    }
    else {
        var fileExtAllow = ['jpg', 'jpeg', 'png'];
    }

    // Pré-visualizar o avatar
    function readURLavatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
      
            reader.onload = function(e) {
                $('#avatar-show').css('background-image', 'url('+e.target.result +')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
 
    // Pré-visualizar o banner
    function readURLbanner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
      
            reader.onload = function(e) {
                $('#banner-show').css('background-image', 'url('+e.target.result +')');
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }   
    }

    // Pré-visualizar o banner da lista
    function readURLbannerList(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
        
            reader.onload = function(e) {
                $('#bannerList-show').css('background-image', 'url('+e.target.result +')');
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }   
    }

    // Chamar as funções ao alterar o avatar/banner/banner da lista
    $("#avatar").change(function() {
        var file = $(this).val();
        var file = file.split('.'); 
        var fileExt = file[file.length - 1];
        var size = this.files[0].size
        if(jQuery.inArray(fileExt, fileExtAllow) != -1) {
            if(size < 3000000) {
                readURLavatar(this);
                $(".e-avatar").html("");
            }
            else {
                $(".e-avatar").html("* Sua imagem é muito grande.");
            }
        }
        else {
            $(".e-avatar").html("* Este tipo de imagem não é permitido!");
        }
    });

    $("#banner").change(function() {
        var file = $(this).val();
        var file = file.split('.'); 
        var fileExt = file[file.length - 1];
        var size = this.files[0].size
        if(jQuery.inArray(fileExt, fileExtAllow) != -1) {   
            if(size < 6000000) {
                readURLbanner(this);
                $(".e-banner").html("");
            }
            else {
                $(".e-banner").html("* Sua imagem é muito grande.");
            }
        }
        else {
            $(".e-banner").html("* Este tipo de imagem não é permitido!");
        }
    });

    $("#bannerList").change(function() {
        var file = $(this).val();
        var file = file.split('.'); 
        var fileExt = file[file.length - 1];
        var size = this.files[0].size
        if(jQuery.inArray(fileExt, fileExtAllow) != -1) {
            if(size < 6000000) {
                readURLbannerList(this);
                $(".e-bannerList").html("");
            }
            else {
                $(".e-bannerList").html("* Sua imagem é muito grande.");
            }
        }
        else {
            $(".e-bannerList").html("* Este tipo de imagem não é permitido!");
        }
    });
});