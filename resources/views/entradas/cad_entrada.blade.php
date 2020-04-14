@include('layout._includes.top')
<title>Entrada</title>

<main>

    <div class="container">

        <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">
            <!-- Grid column -->
            <div class="col-md-12">


                <ul class="nav md-pills pills-info mb-4" id="tabs">
                    <li class="nav-item pl-0">
                        <a class="nav-link active " data-toggle="tab" href="#panelGrid" role="tab">Entradas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panelCad" role="tab">Cadastro/Edição</a>
                    </li>
                </ul>
                <!-- Tab panels -->
                <div class="tab-content card">
                    <div class="tab-pane fade in show active" id="panelGrid" role="tabpanel">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <table id="table-entrada"
                                       class="table table-striped table-bordered table-hover display shadow_person"
                                       style="width:100%">
                                    <thead></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade in" id="panelCad" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="produto" id="produto">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="fornecedor" id="fornecedor">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="md-form form-sm">
                                    {{Form::text('qnt',null,['class'=>'form-control form-control-sm','id'=>'qnt'])}}
                                    {{Form::label('qnt','Quantidade')}}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="md-form form-sm">
                                    {{Form::text('dt_entrada',null,['class'=>'form-control form-control-sm','id'=>'dt_entrada'])}}
                                    {{Form::label('dt_entrada','Data Entrada')}}
                                </div>
                            </div>
                        </div>
                        <div class="row text-right">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success float-right" id="btn-salvar">
                                    Salvar/Atualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </section>

    </div>

</main>

@include('layout._includes.footer')

<script>
    var id_entrada = 0;
    $(document).ready(function () {
        $('#dt_entrada').customDatePicker();

        $('#qnt').maskMoney({
            allowZero: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 2
        }).trigger('mask.maskMoney');

        $('#qnt').change();

        $("#produto").select2({
                placeholder: "Produto",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('entrada.get_produto')}}',
                    data: function (params) {
                        var query_consulta = {
                            query_consulta: params.term,
                        };
                        return query_consulta;
                    }
                }
            }
        );

        $("#fornecedor").select2({
                placeholder: "Fornecedor",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('entrada.get_fornecedor')}}',
                    data: function (params) {
                        var query_consulta = {
                            query_consulta: params.term,
                        };
                        return query_consulta;
                    }
                }
            }
        );

        getDataGrid();


        datatable = $('#table-entrada').customGrid({
            "columns": [
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                    title: 'id',
                    type: 'integer',
                    class: 'not-export-column'
                },
                {
                    data: 'produto',
                    name: 'produto',
                    visible: true,
                    title: 'Produto',
                    type: 'string'
                },
                {
                    data: 'produto_id',
                    name: 'produto_id',
                    visible: false,
                    title: 'produto_id',
                    type: 'string'
                },
                {
                    data: 'qnt',
                    name: 'qnt',
                    title: 'Quantidade Entrada',
                    visible: true,
                    type: 'num-fmt'
                },
                {
                    data: 'dt_entrada',
                    name: 'dt_entrada',
                    visible: true,
                    title: 'Data Entrada',
                    type: 'date',
                },
                {
                    data: 'fornecedor',
                    name: 'fornecedor',
                    visible: true,
                    title: 'Fornecedor',
                    type: 'date',
                },
                {
                    data: 'fornecedor_id',
                    name: 'fornecedor_id',
                    visible: false,
                    title: 'fornecedor_id',
                    type: 'date',
                },
                {
                    data: 'acoes',
                    name: 'acoes',
                    visible: true,
                    title: 'Ações',
                    "render": function (data, type, row, meta) {

                        return '<div class="btn-group" role="group">\n' +
                            '  <button type="button" class="btn aqua-gradient btn-edit btn-sm" onclick="Editar(' + row.id + ')">Editar</button>\n' +
                            '  <button type="button" class="btn aqua-gradient btn-delete btn-sm" onclick="openModalConfirmDelete(' + row.id +')">Excluir</button>\n' +
                            '</div>';
                    },
                    class: 'not-export-column dt-center'

                },
            ],
            order: []
        });

        $("#btn-salvar").on('click', function () {
            Salvar();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            target = e.target.hash;
            if (target == '#panelGrid'){
                ClearDataEntrada();
            }
        });

        $("#modal_confirm_delete_yes").on('click',function(){
            Excluir(id_entrada);
        });

        $('#modalConfirmDelete').on('hidden.bs.modal', function () {
            $('#modalConfirmDelete').modal('hide');
            id_entrada = 0;
        });
    });

    function openModalConfirmDelete(entrada_id){
        id_entrada = entrada_id;
        $('#modalConfirmDelete').modal('show');
    }


    function Editar(entrada_id) {
        let row = datatable
            .rows( function ( idx, data, node ) {
                return data.id === entrada_id ?
                    true : false;
            } ).data()[0];
        $('#produto').append($('<option/>').val(row.produto_id).text(row.produto));
        $('#fornecedor').append($('<option/>').val(row.fornecedor_id).text(row.fornecedor));
        $('#qnt').val(row.qnt).change();
        $('#dt_entrada').val(row.dt_entrada).change();

        id_entrada = entrada_id;
        $('#panelGrid').removeClass('active');
        $('[href="' + '#panelCad' + '"]').tab('show');
    }

    function Excluir(entrada_id) {
        $.ajax({
            type: 'POST',
            url: '{{route('entrada.delete')}}' + '/' + entrada_id,
            success: function (resposta) {
                if (resposta.success) {
                    toastr["success"](resposta.message, "Sucesso");

                    window.setTimeout(function () {
                        location.reload();
                    }, 2000);

                } else {
                    toastr["error"](resposta.message, "Erro");
                }            },
            error: function (resposta) {
                toastr["error"](resposta.message == undefined ? resposta.responseJSON.message : resposta.message, "Erro");
            }
        });
    }

    function ClearDataEntrada() {
        $('#produto').empty()
        $('#fornecedor').empty()
        $('#qnt').val('').change();
        $('#dt_entrada').val('').change();
        id_entrada = 0;
    }

    function getDataGrid() {
        $.ajax({
            type: 'POST',
            url: '{{route('entrada.data_grid')}}',
            success: function (resposta) {
                datatable.rows.add(resposta).draw();
            },
            error: function (resposta) {
            }
        });
    }

    function Salvar() {
        $.ajax({
            type: 'POST',
            url: id_entrada > 0 ? "{{route('entrada.update')}}" + '/' + id_entrada : "{{route('entrada.insert')}}",
            data: {
                produto:$("#produto").val(),
                fornecedor:$("#fornecedor").val(),
                qnt:$("#qnt").maskMoney('unmasked')[0],
                dt_entrada:$("#dt_entrada").val(),
            },
            success: function (resposta) {
                if (resposta.success) {
                    toastr["success"](resposta.message, "Sucesso");

                    window.setTimeout(function () {
                        location.reload();
                    }, 2000);

                } else {
                    toastr["error"](resposta.message, "Erro");
                }
            },
            error: function (resposta) {
                toastr["error"](resposta.message == undefined ? resposta.responseJSON.message : resposta.message, "Erro");
            }

        });
    }
</script>
@include('layout.modals.modal_confirm_delete')
