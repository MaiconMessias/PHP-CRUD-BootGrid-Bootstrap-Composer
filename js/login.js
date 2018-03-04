// JavaScript Document
var validatorLogin;
var validatorCadastro;
var form_login;
var form_cadastro;

function init(){
        form_login = $("#frm_login");
        validatorLogin = $("#frm_login").validate({
        rules: {
            usr: {
                required: true
            },
            pwd: {
                required: true
            }
        },
        messages: {
            usr: {
                required: "Preencha o campo usuário !"
            },
            pwd: {
                required: "Preencha o campo senha !"
            }
        } 
    });
    
    form_cadastro = $("#frm_cadastro");
    validatorCadastro = $("#frm_cadastro").validate({
        rules: {
            nome: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            pwdCadastro: {
                required: true
            },
            pwdComfirmCadastro: {
                required: true,
                equalTo: "#pwdCadastro"
            }
        },
        messages: {
            nome: {
                required: "Preencha o campo nome !"
            },
            email: {
                required: "Preencha o campo email !"
            },
            pwdCadastro: {
                required: "Preencha o campo senha !"
            },
            pwdComfirmCadastro: {
                required: "Preencha o campo confirmar senha !",
                equalTo: "Campo confirmar senha precisa ser igual ao campo senha !"
            }
        }
    });
    
    $("#frm_login input").focus(function(){ 
        limpaValidacoesLogin();
    });
    
    $("#btnEnviar").click(function(){
        validaUsuario();
    });

    $("#frm_cadastro input").focus(function(){ 
        limpaValidacoesCadastro();    
    });
    
    $("#btnCadastrar").click(function(){
        cadastraUsuario();
    });
}

function validaUsuario() {
    if (form_login.valid()) {
        data = $("#frm_login").serializeArray();
        $.ajax({
            type: "POST",
            url: "validalogin.php",
            data: data,
            dataType: "json",
            success: function (response) {
                switch(response) {
                    case -1:{
                        alert("Usuário não cadastrado no sistema !");
                        break;
                    } case 0: {
                        alert("Usuário e/ou senha inválidos !");
                        break;
                    } default: {
                        alert("Login efetuado com sucesso !");
                        window.location.href="index.php"; 
                    }
                }
            }
        });
    } else {
        alert("Preencha os campos requiridos !");
    }
}

function cadastraUsuario() {
    if (form_cadastro.valid()) {
        data = $("#frm_cadastro").serializeArray();
        $.ajax({
            type: "POST",
            url: "cadastrausuario.php",
            data: data,
            dataType: "json",
            success: function (response) {
                if (response == 0)
                    alert("Erro ao cadastrar o usuário !");
                else 
                    alert("Usuário cadastrado com sucesso !");
            }
        });
    } else 
        alert("Preencha os campos requiridos !");
}

function limpaValidacoesLogin() {
    validatorLogin.resetForm();
}

function limpaValidacoesCadastro() {
    validatorCadastro.resetForm();    
}


