@include('layout._includes.top')

<main>

    <div class="container">

        <!--Section: Products v.5-->
        <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">
            <!-- Grid column -->
            <div class="col-md-12">


                <ul class="nav md-pills pills-info mb-4" id="tabs">
                    <li class="nav-item pl-0">
                        <a class="nav-link active " data-toggle="tab" href="#panelGrid" role="tab">Saidas</a>
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
                                <table id="table-saida"
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
                            <div class="col-md-4">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="produto" id="produto">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="cliente" id="cliente">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="vendedor" id="vendedor">
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
                                    {{Form::text('vlr',null,['class'=>'form-control form-control-sm','id'=>'vlr'])}}
                                    {{Form::label('vlr','Valor')}}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="md-form form-sm">
                                    {{Form::text('dt_saida',null,['class'=>'form-control form-control-sm','id'=>'dt_saida'])}}
                                    {{Form::label('dt_saida','Data Saida')}}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="md-form form-sm">
                                    {{Form::text('saldo',null,['class'=>'form-control form-control-sm','id'=>'saldo','disabled'])}}
                                    {{Form::label('saldo','Saldo')}}
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
    var id_saida = 0;
    $(document).ready(function () {
        $('#dt_saida').customDatePicker();

        $('#qnt').maskMoney({
            allowZero: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 2
        }).trigger('mask.maskMoney');

        $('#qnt').change();

        $('#vlr').maskMoney({
            allowZero: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 2
        }).trigger('mask.maskMoney');

        $('#vlr').change();

        $('#saldo').maskMoney({
            allowZero: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 2
        }).trigger('mask.maskMoney');

        $('#saldo').change();



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
        ).on('change',function(){
            if($(this).val() != '')
                getSaldoProduto(id_saida,$(this).val());
        });

        $("#cliente").select2({
                placeholder: "Cliente",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('saida.get_cliente')}}',
                    data: function (params) {
                        var query_consulta = {
                            query_consulta: params.term,
                        };
                        return query_consulta;
                    }
                }
            }
        );

        $("#vendedor").select2({
                placeholder: "Vendedor",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('saida.get_vendedor')}}',
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


        datatable = $('#table-saida').customGrid({
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
                    title: 'Quantidade Saida',
                    visible: true,
                    type: 'num-fmt'
                },

                {
                    data: 'vlr',
                    name: 'vlr',
                    title: 'Valor Saida',
                    visible: true,
                    type: 'num-fmt'
                },
                {
                    data: 'dt_saida',
                    name: 'dt_saida',
                    visible: true,
                    title: 'Data Saida',
                    type: 'date',
                },
                {
                    data: 'cliente',
                    name: 'cliente',
                    visible: true,
                    title: 'Cliente',
                    type: 'string',
                },
                {
                    data: 'cliente_id',
                    name: 'cliente_id',
                    visible: false,
                    title: 'cliente_id',
                    type: 'string',
                },

                {
                    data: 'vendedor',
                    name: 'vendedor',
                    visible: false,
                    title: 'vendedor',
                    type: 'string',
                },

                {
                    data: 'vendedor',
                    name: 'vendedor_id',
                    visible: false,
                    title: 'vendedor_id',
                    type: 'string',
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
                ClearDataSaida();
            }
        });

        $("#modal_confirm_delete_yes").on('click',function(){
            Excluir(id_saida);
        });

        $('#modalConfirmDelete').on('hidden.bs.modal', function () {
            $('#modalConfirmDelete').modal('hide');
            id_saida = 0;
        });
    });

    function openModalConfirmDelete(saida_id){
        id_saida = saida_id;
        $('#modalConfirmDelete').modal('show');
    }

    function getSaldoProduto(saida_id,produto_id){
        $.ajax({
            type: 'POST',
            url: '{{route('saida.get_estoque_produto')}}' + '/' + saida_id + '/' + produto_id,
            success: function (resposta) {
                $("#saldo").val(formataDinheiro(parseFloat(resposta.estoque)));
            },

            error: function (resposta) {
                toastr["error"](resposta.message == undefined ? resposta.responseJSON.message : resposta.message, "Erro");
            }
        });
    }

    function Editar(saida_id) {
        let row = datatable.row(saida_id - 1).data();

        $('#produto').append($('<option/>').val(row.produto_id).text(row.produto));
        $('#cliente').append($('<option/>').val(row.cliente_id).text(row.cliente));
        $('#vendedor').append($('<option/>').val(row.vendedor_id).text(row.vendedor));
        $('#qnt').val(row.qnt).change();
        $('#vlr').val(row.vlr).change();
        $('#dt_saida').val(row.dt_saida).change();

        $('#produto').change();
        id_saida = saida_id;
        $('#panelGrid').removeClass('active');
        $('[href="' + '#panelCad' + '"]').tab('show');
    }

    function Excluir(saida_id) {
        $.ajax({
            type: 'POST',
            url: '{{route('saida.delete')}}' + '/' + saida_id,
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

    function ClearDataSaida() {
        $('#produto').empty()
        $('#cliente').empty()
        $('#vendedor').empty()
        $('#qnt').val(0).change();
        $('#vlr').val(0).change();
        $('#dt_saida').val('').change();
        $("#saldo").val(0).change();
        id_saida = 0;
    }

    function getDataGrid() {
        $.ajax({
            type: 'POST',
            url: '{{route('saida.data_grid')}}',
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
            url: id_saida > 0 ? "{{route('saida.update')}}" + '/' + id_saida : "{{route('saida.insert')}}",
            data: {
                produto:$("#produto").val(),
                cliente:$("#cliente").val(),
                vendedor:$("#vendedor").val(),
                qnt:$("#qnt").maskMoney('unmasked')[0],
                vlr:$("#vlr").maskMoney('unmasked')[0],
                dt_saida:$("#dt_saida").val(),
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
