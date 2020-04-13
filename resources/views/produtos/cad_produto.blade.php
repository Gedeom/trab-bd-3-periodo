@include('layout._includes.top')
<title>Produto</title>

<main>

    <div class="container">

        <!--Section: Products v.5-->
        <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">
            <!-- Grid column -->
            <div class="col-md-12">


                <ul class="nav md-pills pills-info mb-4" id="tabs">
                    <li class="nav-item pl-0">
                        <a class="nav-link active " data-toggle="tab" href="#panelGrid" role="tab">Produto</a>
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
                                <table id="table-produto"
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
                                <div class=" md-form form-sm">
                                    {{Form::text('nome',null,['class'=>'form-control form-control-sm','id'=>'nome'])}}
                                    {{Form::label('nome','Nome')}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="categoria" id="categoria">
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="md-form form-sm">
                                    {{Form::text('qnt_inicial',null,['class'=>'form-control form-control-sm','id'=>'qnt_inicial'])}}
                                    {{Form::label('qnt_inicial','Quantidade Inicial')}}
                                </div>
                            </div>
                                <div class="col-md-3">
                                    <div class="md-form form-sm">
                                        {{Form::text('vlr_padrao',null,['class'=>'form-control form-control-sm','id'=>'vlr_padrao'])}}
                                        {{Form::label('vlr_padrao','Valor Padrão')}}
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
    var id_produto = 0;
    $(document).ready(function () {

        $('#qnt_inicial').maskMoney({
            allowZero: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 2
        }).trigger('mask.maskMoney');

        $('#vlr_padrao').maskMoney({
            allowZero: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false,
            precision: 2
        }).trigger('mask.maskMoney');

        $('#qnt_inicial').change();
        $('#vlr_padrao').change();

        $("#categoria").select2({
                placeholder: "Categoria",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('produto.get_categoria')}}',
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


        datatable = $('#table-produto').customGrid({
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
                    data: 'nome',
                    name: 'nome',
                    visible: true,
                    title: 'Nome',
                    type: 'string'
                },
                {
                    data: 'categoria',
                    name: 'categoria',
                    title: 'Categoria',
                    visible: true,
                    type: 'string'
                }, {
                    data: 'categoria_id',
                    name: 'categoria_id',
                    title: 'categoria_id',
                    visible: false,
                    type: 'string'
                },
                {
                    data: 'qnt_estoque',
                    name: 'qnt_estoque',
                    visible: true,
                    title: 'Quantidade Estoque',
                    type: 'num-fmt',
                },
                {
                    data: 'valor',
                    name: 'valor',
                    visible: true,
                    title: 'Valor Padrão',
                    type: 'num-fmt',
                },
                {
                    data: 'qnt_inicial',
                    name: 'qnt_inicial',
                    visible: false,
                    title: 'qnt_inicial',
                    type: 'num-fmt',
                },
                {
                    data: 'qnt_inicial',
                    name: 'qnt_inicial',
                    visible: false,
                    title: 'qnt_inicial',
                    type: 'num-fmt',
                },
                {
                    data: 'acoes',
                    name: 'acoes',
                    visible: true,
                    title: 'Ações',
                    "render": function (data, type, row, meta) {

                        return '<div class="btn-group" role="group">\n' +
                            '  <button type="button" class="btn aqua-gradient btn-edit btn-sm" onclick="Editar(' + row.id + ')">Editar</button>\n' +
                            '  <button type="button" class="btn aqua-gradient btn-delete btn-sm" onclick="openModalConfirmDelete(' + row.id + ')">Excluir</button>\n' +
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
            if (target == '#panelGrid') {
                ClearDataProduto();
            }
        });

        $("#modal_confirm_delete_yes").on('click', function () {
            Excluir(id_produto);
        });

        $('#modalConfirmDelete').on('hidden.bs.modal', function () {
            $('#modalConfirmDelete').modal('hide');
            id_produto = 0;
        });
    });

    function openModalConfirmDelete(produto_id) {
        id_produto = produto_id;
        $('#modalConfirmDelete').modal('show');
    }


    function Editar(produto_id) {
        let row = datatable
            .rows( function ( idx, data, node ) {
                return data.id === produto_id ?
                    true : false;
            } ).data()[0];
        $("#nome").val(row.nome).change();
        $('#categoria').append($('<option/>').val(row.categoria_id).text(row.categoria));
        $("#qnt_inicial").val(row.qnt_inicial);
        $("#vlr_padrao").val(row.valor);


        id_produto = produto_id;
        $('#panelGrid').removeClass('active');
        $('[href="' + '#panelCad' + '"]').tab('show');
    }

    function Excluir(produto_id) {
        $.ajax({
            type: 'POST',
            url: '{{route('produto.delete')}}' + '/' + produto_id,
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

    function ClearDataProduto() {
        $("#nome").val('').change();
        $('#categoria').empty();
        $("#qnt_inicial").val(0);
        $("#qnt_inicial").change();
        $("#vlr_padrao").val(0);
        $("#vlr_padrao").change();
        id_produto = 0;
    }

    function getDataGrid() {
        $.ajax({
            type: 'POST',
            url: '{{route('produto.data_grid')}}',
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
            url: id_produto > 0 ? "{{route('produto.update')}}" + '/' + id_produto : "{{route('produto.insert')}}",
            data: {
                nome: $("#nome").val(),
                categoria: $("#categoria").val(),
                qnt_inicial: $("#qnt_inicial").maskMoney('unmasked')[0],
                vlr_padrao: $("#vlr_padrao").maskMoney('unmasked')[0]
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
