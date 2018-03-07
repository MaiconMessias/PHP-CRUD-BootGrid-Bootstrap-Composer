<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
  <head>
    <title>Teste Integração Bootgrid com PHP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link rel="stylesheet" href="vendor/jquery.bootgrid-1.3.1/bootstrap.min.css"/>-->

    <!-- Arquivos necessarios para implementacao bootgrid -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link href="vendor/jquery.bootgrid-1.3.1/jquery.bootgrid.css" rel="stylesheet" />
    <link href="css/pesquisa.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="vendor/jquery.bootgrid-1.3.1/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="vendor/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js"></script>

    <script src="//oss.maxcdn.com/jquery.mask/1.11.4/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>
  </head>
  <body>
    <?php
    include 'template/mainmenu.html';
    ?>

    <!-- Painel contendo o botao para registro de funcionario -->
    <div class="well clearfix panelGrid">
      <div class="pull-right">
        <button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
          <span class="glyphicon glyphicon-plus"></span>Adicionar Registro</button>
      </div>
    </div>

    <div class="panel panel-default panelGrid">
      <!-- Grid principal -->
      <table id="grid-basic" class="table table-condensed table-hover table-striped">
        <!--data-selection="true" data-row-select="true" >-->
        <thead>
          <tr>
            <th data-column-id="id" data-identifier="true" data-type="numeric">ID</th>
            <th data-column-id="nome">Nome</th>
            <th data-column-id="cpf">CPF</th>
            <th data-column-id="rg">RG</th>
            <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>                    
          </tr>
        </thead>
      </table>
    </div>

    <!-- Formulario modal de inclusao do registro de funcionario -->
    <div id="add_model" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Registrar funcionário</h4>
          </div>
          <div class="modal-body">
            <form method="post" id="frm_add">
              <input type="hidden" value="add" name="action" id="action">
              <div class="form-group">
                <label for="name" class="control-label">Nome:</label>
                <input type="text" class="form-control" id="name" name="name"/>
              </div>
              <div class="form-group">
                <label for="cpf" class="control-label">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf"/>
              </div>
              <div class="form-group">
                <label for="rg" class="control-label">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" id="btn_add" class="btn btn-primary">Savar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulario modal de alteracao do registro do funcionario -->
    <div id="edit_model" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Alterar registro de funcionário</h4>
          </div>
          <form method="post" id="frm_edit">
            <div class="modal-body">
              <input type="hidden" value="edit" name="action" id="action">
              <input type="hidden" value="0" name="edit_id" id="edit_id">
              <div class="form-group">
                <label for="edit_name" class="control-label">Nome:</label>
                <input type="text" class="form-control" id="edit_name" name="edit_name"/>
              </div>
              <div class="form-group">
                <label for="edit_cpf" class="control-label">CPF:</label>
                <input type="text" class="form-control" id="edit_cpf" name="edit_cpf"/>
              </div>
              <div class="form-group">
                <label for="edit_rg" class="control-label">RG:</label>
                <input type="text" class="form-control" id="edit_rg" name="edit_rg"/>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              <button type="button" id="btn_edit" class="btn btn-primary">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>        

    <!-- Filtros -->
    <div class="panel panel-default container-filtro-grid">
        <div class="panel-heading" role="tab" id="headingTwo">
          <h4 class="panel-title">
            <a id="accordion-filtro" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Filtro <span id="span-accordion" class="glyphicon" aria-hidden="true"></span>
            </a>
          </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse panel-filtro-grid" role="tabpanel" aria-labelledby="headingTwo">
          <div class="panel-body">
            <div class="form-group group-input-id">
              <label for="filtro_id" class="control-label">ID:</label>
              <input type="number" min="0" step="0" class="form-control" id="filtro_id" name="filtro_id"/>
            </div>
            <div class="form-group group-input-nome">
              <label for="filtro_nome" class="control-label">Nome:</label>
              <input type="text" class="form-control" id="filtro_nome" name="filtro_nome"/>
            </div>
            <div class="form-group group-input-rg">
              <label for="filtro_rg" class="control-label">RG:</label>
              <input type="text" class="form-control" id="filtro_rg" name="filtro_rg"/>
            </div>
            <div class="form-group group-input-cpf">
              <label for="filtro_cpf" class="control-label">CPF:</label>
              <input type="text" class="form-control" id="filtro_cpf" name="filtro_cpf"/>
            </div>
            <button id="btn-filtrar" type="button" class="btn btn-default">
              Filtrar
            </button>
          </div>
        </div>
      </div>
    
    <script type="text/javascript" language="JavaScript">
        $(document).ready(function () {
            iniSearchPage();
        });
    </script>

  </body>
</html>
