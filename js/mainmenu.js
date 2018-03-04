function initMainMenu(login) {
    var dados = {
        "login": login
    };
    
    $.ajax({
        type: "POST",
        url: "mainmenucontroller.php",
        dataType: "JSON",
        data: dados,
        success: function(response){
            if(response == -1) {
                window.location.href="login.php";
            } else {
                $("#dadosUsuario").empty();
                $("#dadosUsuario").append("Usuário: " + response['usuario'] + '   ' +
                                  '<a id="logout" href="#" class="btn btn-default">Logout</a>' + 
                                  '<script>' + 
                                      '$("#logout").click(function(){' +
                                      '   alert("Até logo"); initMainMenu(false);' +
                                      '});' + 
                                  '</script>'
                                  );
            }
        }
    });    
}