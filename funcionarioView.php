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
    
    <script type="text/javascript" language="JavaScript">
//        $(window).load(function () {
        /* Selecionar botao "Funcionários" ao carregar a tela*/
//            $("li").removeClass();
//            $("#prof").addClass("active");
//        });
        $(document).ready(function () {
            $("#cpf").mask("999.999.999-99");
            $("#rg").mask("99.999.999-9");
            $("#edit_cpf").mask("999.999.999-99");
            $("#edit_rg").mask("99.999.999-9");

            var form_add = $("#frm_add");
            var validator = $("#frm_add").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    cpf: {
                        required: true,
                        minlength: 14
                    },
                    rg:  {
                        required: true,
                        minlength: 12
                    }
                },
                messages: {
                    name: {
                        required: "Por favor, informe seu nome",
                        minlength: "O nome deve ter pelo menos 3 dígitos"
                    },
                    cpf: {
                        required: "Por favor, informe seu cpf",
                        minlength: "O cpf deve ter pelo menos 11 dígitos"
                    },
                    rg: {
                        required: "Por favor, informe seu rg",
                        minlength: "O rg deve ter pelo menos 9 dígitos"
                    }
                }
            });
            
            var form_edit = $("#frm_edit");
            var validator_edit = $("#frm_edit").validate({
                rules: {
                    edit_name: {
                        required: true,
                        minlength: 3
                    },
                    edit_cpf: {
                        required: true,
                        minlength: 14
                    },
                    edit_rg:  {
                        required: true,
                        minlength: 12
                    }
                },
                messages: {
                    edit_name: {
                        required: "Por favor, informe seu nome",
                        minlength: "O nome deve ter pelo menos 3 dígitos"
                    },
                    edit_cpf: {
                        required: "Por favor, informe seu cpf",
                        minlength: "O cpf deve ter pelo menos 11 dígitos"
                    },
                    edit_rg: {
                        required: "Por favor, informe seu rg",
                        minlength: "O rg deve ter pelo menos 9 dígitos"
                    }
                }
            });
            
            /********************************************************/

            var grid = $("#grid-basic").bootgrid({
                ajax: true,
                post: function () {
                    /* To accumulate custom parameter with the request object */
                    return {
                        id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                    };
                },
                url: "funcionarioController.php",
                rowCount: [10, 2, 25, -1],
                //selection: true,
                rowSelect: true,
                labels: {
                    noResults: "Não existem registros cadastrados",
                    infos: "Mostrando {{ctx.start}} até {{ctx.end}} de {{ctx.total}} registros",
                    all: "Todos",
                    search: "Procurar",
                    refresh: "Atualizar",
                    loading: "Procurando..."
                },
                formatters: {
                    "commands": function (column, row) {
                        return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " +
                                "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    }
                }
                //multiSelect: false
            }).on("loaded.rs.jquery.bootgrid", function () {
                grid.find(".command-edit").on("click", function (e) {
                    //alert("You pressed edit on row: " + $(this).data("row-id"));
                    var ele = $(this).parent();
                    var g_id = $(this).parent().siblings(':first').html();
                    var g_name = $(this).parent().siblings(':nth-of-type(2)').html();
                    // Removendo validacoes antigas
                    validator_edit.resetForm();
                    // Removendo classe de formatacao de erro dos inputs (atualmente vermelha) 
                    $('input').removeClass("error");
                    $('#edit_model').modal('show');
                    if ($(this).data("row-id") > 0) {
                        // collect the data
                        $('#edit_id').val(ele.siblings(':first').html()); // in case we're changing the key
                        $('#edit_name').val(ele.siblings(':nth-of-type(2)').html());
                        $('#edit_cpf').val(ele.siblings(':nth-of-type(3)').html());
                        $('#edit_rg').val(ele.siblings(':nth-of-type(4)').html());
                    } else {
                        alert('Now row selected! First select row, then click edit button');
                    }
                });
                grid.find(".command-delete").on("click", function (e) {
                    var conf = confirm('Deseja deletar o registro ' + $(this).data("row-id") + ' ?');
                    if (conf) {
                        $.post('funcionarioController.php', {
                            id: $(this).data("row-id"),
                            action: 'delete'
                        },
                        function () {
                            // when ajax returns (callback), 
                            $("#grid-basic").bootgrid('reload');
                        });
                    }
                });
            });
            
            $("#command-add").click(function () {
                $('#name').val('');
                $('#cpf').val('');
                $('#rg').val('');
                // Removendo validacoes antigas
                validator.resetForm();
                // Removendo classe de formatacao de erro dos inputs (atualmente vermelha) 
                $('input').removeClass("error");
                $('#add_model').modal('show');
            });
            
            $("#btn_add").click(function () {
                if (form_add.valid()) {
                    ajaxAction('add');
                } else {
                    alert("Preencha corretamente os campos obrigatórios !");
                }
            });
            
            $("#btn_edit").click(function () {
                if (form_edit.valid()) {
                    ajaxAction('edit');
                } else {
                    alert("Preencha corretamente os campos obrigatórios !");
                }
            });
            
            function ajaxAction(action) {
                data = $("#frm_" + action).serializeArray();
                $.ajax({
                    type: "POST",
                    url: "funcionarioController.php",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        $('#' + action + '_model').modal('hide');
                        $("#grid-basic").bootgrid('reload');
                    }
                });
            }
        });
    </script>

  </body>
</html>
