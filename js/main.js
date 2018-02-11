function iniSearchPage() {
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
            rg: {
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
            edit_rg: {
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

}

