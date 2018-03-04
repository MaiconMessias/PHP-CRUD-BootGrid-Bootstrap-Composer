<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tela login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/login.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="js/login.js"></script>
  </head>
  <body>
    <div id="container-principal">
    
      <div id="divLogin">
        <div class="page-header page-header-login">
          <h1>Login</h1>
        </div>
        <div id="formLogin">
          <form id="frm_login" method="POST"> 
            <div class="form-group">
              <label for="usr">Usuário:</label>
              <input type="text" class="form-control" id="usr" name="usr" placeholder="Usuário">
            </div>  
            <div class="form-group">
              <label for="pwd">Senha:</label>
              <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Senha"><br />
            </div>  
            <a href="#" id="btnEnviar" class="btn btn-default" aria-label="Left Align">
              <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
              Enviar
            </a>
          </form>  
        </div>
      </div>
      
        <div class="linha-vertical"></div>
        
      <div id="divCadastro">
        <div class="page-header page-header-cadastro">
          <h1>Cadastro</h1>
        </div>
        <div id="formCadastro">
          <form id="frm_cadastro" method="POST">
            <div class="form-group">
              <label for="nome">Nome:</label>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email"><br />
            </div>
            <div class="form-group">
              <label for="pwdCadastro">Senha:</label>
              <input type="password" class="form-control" id="pwdCadastro" name="pwdCadastro" placeholder="Senha"><br />
            </div>
            <div class="form-group">
              <label for="pwdComfirmCadastro">Confirmar Senha:</label>
              <input type="password" class="form-control" id="pwdComfirmCadastro" name="pwdComfirmCadastro" placeholder="Confirmar Senha"><br />
            </div>
            <a href="#" id="btnCadastrar" class="btn btn-default" aria-label="Left Align">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              Cadastrar
            </a>
          </form>
        </div>
      </div>
      
    </div>  
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function(){
            init();
        });
    </script>
  </body>
</html>  
