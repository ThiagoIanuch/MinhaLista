$(document).ready(function() {
    // Erros ao registrar uma conta
    $("#signup").submit(function() {
        // Pegar valores digitados
        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var password_confirm = $("#password_confirm").val();
        var terms_accept = $("#terms-accept").val(this.checked);
    
        // Valores aceitos
        var username_accept = /^[A-Za-z-0-9]+$/;
        var email_accept = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        var password_accept = /^[A-Za-z-0-9-*]+$/;

        // Verificar envio
        var submit = true;
    
        // Confirmar o nome de usúario
        if(username.length < 2 || username.length > 16 || !username.match(username_accept)) {
            $(".form-error:nth-of-type(1)").html("* O nome de usúario precisa ter de 2 a 16 caracteres. [A-Za-z] [0-9]");
            submit = false;
        }
        else {
            $(".form-error:nth-of-type(1)").html("");
        }
    
        // Confirmar email
        if(email == "" || !email.match(email_accept)) {
            $(".form-error:nth-of-type(2)").html("* É necessário colocar um email válido");
            submit = false;
        }
        else {
            $(".form-error:nth-of-type(2)").html("");
        }
    
        // Confirmar senha
        if(password.length < 5 || password.length > 16 || !password.match(password_accept)) {
            $(".form-error:nth-of-type(3)").html("* A senha precisa ter de 5 a 16 caracteres. [A-Za-z] [0-9] [*]");
            submit = false;
        }
        else {
            $(".form-error:nth-of-type(3)").html("");
        }
    
        // Confirmar a segunda senha
        if(password_confirm.length < 5 || password_confirm.length > 16 || password_confirm != password || !password_confirm.match(password_accept)) {
            $(".form-error:nth-of-type(4)").html("* As senhas não coincidem");
            submit = false;
        }
        else {
            $(".form-error:nth-of-type(4)").html("");
        }

        // Confirmar se o usúario marcou o checkbox de termos de uso
        if(!this.terms_accept.checked) {
            $(".form-error:nth-of-type(5)").html("* É necessário concordar com os termos de uso");
            submit = false;
        }
        else {
            $(".form-error:nth-of-type(5)").html("");
        }
 
        return submit;
    });

    // Erros ao entrar na conta
    $("#login").submit(function() {
        // Pegar valores digitados
        var username = $("#username").val();
        var password = $("#password").val();

        // Verificar envio
        var submit = true;

        // Confirmar senha
        if(username == "") {
            $(".form-error:nth-of-type(1)").html("* O nome de usúrio não pode estar em branco");
            submit = false;
        }
        else {
            $(".form-error:nth-of-type(1)").html("");
        }

        // Confirmar senha
        if(password == "") {
            $(".form-error:nth-of-type(2)").html("* A senha não pode estar em branco");
            submit = false;
        }
        else {
            $(".form-error:nth-of-type(2)").html("");
        }

        return submit;
    });

    // Não enviar formulário caso pesquisa seja nula na barra de pesquisa
    $("#search-form").submit(function() {
        // Pegar valor
        var search_value = $("#search-autocomplete").val();

        // Verificar envio
        var submit = true;

        // Confirmar pesquisa
        if (search_value.length < 1) {
            return false;
        }

        return submit;
    });

    // Erros ao alterar as configurações gerais do perfil
    $("#settings").submit(function () {
        // Pegar valores
        var about = $("#about").val();
        var localization = $("#localization").val();
        var day = $("#day").val();
        var month = $("#month").val();
        var year = $("#year").val();
        var birthday = day+month+year;

        // Verificar envio
        var submit = true;

        // Confirmar envio sobre o usúario
        if(about.length > 5000) {
            $(".error:nth-of-type(1)").html("* Não é permitido mais que 5000 caracteres");
            submit = false;
        }
        else {
            $(".error:nth-of-type(1)").html("");
        }

        // Confirmar envio da localização
        if(localization.length > 12) {
            $(".error:nth-of-type(2)").html("* A localização não pode ser maior que 12 caracteres");
            submit = false;
        }
        else {
            $(".error:nth-of-type(2)").html("");
        }

        // Confirmar a data de aniversário
        if(birthday.length > 1 && birthday.length < 8) {
            $(".error:nth-of-type(3)").html("* Insira uma data de aniversário válida");
            submit = false;
        }
        else {
            $(".error:nth-of-type(3)").html("");
        }

        return submit;
    });

    // Erro ao enviar comentário no perfil
    $("#comments").submit(function() {
        // Pegar valores digitados
        var comment = $("#comment").val();

        // Verificar envio
        var submit = true;

        // Confirmar comentário
        if(comment.length < 1) {
            $(".error-comment:nth-of-type(1)").html("* O seu comentário não pode estar em branco");
            submit = false;
        }
        else if(comment.length > 20000){
            $(".error-comment:nth-of-type(1)").html("* O seu comentário não pode ultrapassar 20000 caracteres");
            submit = false;
        }

        return submit;
    });

});
