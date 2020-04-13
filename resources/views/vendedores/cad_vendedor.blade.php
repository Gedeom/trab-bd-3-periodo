@include('layout._includes.top')

<main>

    <div class="container">

        <!--Section: Products v.5-->
        <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">
            <!-- Grid column -->
            <div class="col-md-12">


                <ul class="nav md-pills pills-info mb-4" id="tabs">
                    <li class="nav-item pl-0">
                        <a class="nav-link active " data-toggle="tab" href="#panelGrid" role="tab">Vendedores</a>
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
                                <table id="table-vendedor"
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
                            <div class="col-md-10">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="pessoa" id="pessoa">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="ativo">
                                    <label class="form-check-label" for="ativo">Ativo?</label>
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
    var id_vendedor = 0;
    $(document).ready(function () {

        $("#pessoa").select2({
                placeholder: "Pessoa",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('vendedor.get_pessoa')}}',
                    data: function (params) {
                        var query_consulta = {
                            vendedor_id: id_vendedor,
                            query_consulta: params.term,
                        };
                        return query_consulta;
                    }
                }
            }
        );

        getDataGrid();


        datatable = $('#table-vendedor').customGrid({
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
                    data: 'cpf_cnpj',
                    name: 'cpf_cnpj',
                    title: 'CPF/CNPJ',
                    visible: true,
                    type: 'string'
                },
                {
                    data: 'endereco',
                    name: 'endereco',
                    visible: true,
                    title: 'Endereço',
                    type: 'string',
                },
                {
                    data: 'dt_nascimento',
                    name: 'dt_nascimento',
                    visible: true,
                    title: 'Data Nascimento/Criação',
                    type: 'date',
                },
                {
                    data: 'sexo',
                    name: 'sexo',
                    visible: true,
                    title: 'Sexo',
                    type: 'string',
                },
                {
                    data: 'situacao',
                    name: 'situacao',
                    visible: true,
                    title: 'Situação',
                    type: 'string',
                },
                {
                    data: 'pessoa_id',
                    name: 'pessoa_id',
                    visible: false,
                    title: 'pessoa_id',
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
                ClearDataVendedor();
            }
        });

        $("#modal_confirm_delete_yes").on('click',function(){
            Excluir(id_vendedor);
        });

        $('#modalConfirmDelete').on('hidden.bs.modal', function () {
            $('#modalConfirmDelete').modal('hide');
            id_vendedor = 0;
        });
    });

    function openModalConfirmDelete(vendedor_id){
        id_vendedor = vendedor_id;
        $('#modalConfirmDelete').modal('show');
    }


    function Editar(vendedor_id) {
        let row = datatable.row(vendedor_id - 1).data();

        $('#pessoa').append($('<option/>').val(row.pessoa_id).text(row.nome + ' - ' + row.cpf_cnpj + ' - ' + row.dt_nascimento));

        $("#ativo").prop('checked', row.situacao == 'Ativo' ? true : false);

        id_vendedor = vendedor_id;
        $('#panelGrid').removeClass('active');
        $('[href="' + '#panelCad' + '"]').tab('show');
    }

    function Excluir(vendedor_id) {
        $.ajax({
            type: 'POST',
            url: '{{route('vendedor.delete')}}' + '/' + vendedor_id,
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

    function ClearDataVendedor() {
        $("#pessoa").empty();
        id_vendedor = 0;
    }

    function getDataGrid() {
        $.ajax({
            type: 'POST',
            url: '{{route('vendedor.data_grid')}}',
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
            url: id_vendedor > 0 ? "{{route('vendedor.update')}}" + '/' + id_vendedor : "{{route('vendedor.insert')}}",
            data: {
                pessoa:$("#pessoa").val(),
                ativo:$('#ativo').is(":checked")
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
