@include('layout._includes.top')

<main>

    <div class="container">

        <!--Section: Products v.5-->
        <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">
            <!-- Grid column -->
            <div class="col-md-12">


                <ul class="nav md-pills pills-info mb-4" id="tabs">
                    <li class="nav-item pl-0">
                        <a class="nav-link active " data-toggle="tab" href="#panelGrid" role="tab">Pessoas</a>
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
                                <table id="table-pessoa"
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
                                <div class=" md-form form-sm">
                                    {{Form::text('nome',null,['class'=>'form-control form-control-sm','id'=>'nome'])}}
                                    {{Form::label('nome','Nome')}}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form form-sm">
                                    {{Form::text('cpf_cnpj',null,['class'=>'form-control form-control-sm','id'=>'cpf_cnpj'])}}
                                    {{Form::label('cpf_cnpj','CPF/CNPJ')}}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="md-form form-sm">
                                    {{Form::text('dt_nascimento',null,['class'=>'form-control form-control-sm','id'=>'dt_nascimento'])}}
                                    {{Form::label('dt_nascimento','Data Nascimento')}}
                                </div>
                            </div>

                            <div class="col-md-2" id="div_sexo">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="sexo" id="sexo">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form form-sm">
                                    {{Form::text('email',null,['class'=>'form-control form-control-sm','id'=>'email'])}}
                                    {{Form::label('email','Email')}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="md-form form-sm">
                                    {{Form::text('celular',null,['class'=>'form-control form-control-sm','id'=>'celular'])}}
                                    {{Form::label('celular','Celular')}}
                                </div>
                            </div>


                            <div class="col-md-5">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="estado" id="estado">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="cidade" id="cidade">
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="md-form form-sm">
                                    <select class="form-control form-control-sm" name="bairro" id="bairro">
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="md-form form-sm">
                                    {{Form::text('logradouro',null,['class'=>'form-control form-control-sm','id'=>'logradouro'])}}
                                    {{Form::label('logradouro','Logradouro')}}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="md-form form-sm">
                                    {{Form::text('nr_lograd',null,['class'=>'form-control form-control-sm','id'=>'nr_lograd'])}}
                                    {{Form::label('nr_lograd','Nr. Logradouro')}}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="md-form form-sm">
                                    {{Form::text('cep',null,['class'=>'form-control form-control-sm','id'=>'cep'])}}
                                    {{Form::label('cep','Cep')}}
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
    var id_pessoa = 0;
    $(document).ready(function () {
        $('#dt_nascimento').customDatePicker();

        $("#estado").select2({
                placeholder: "Estado",
                minimumInputLength: 1,
                ajax: {
                    delay: 250,
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('pessoa.get_estado')}}',
                    data: function (params) {
                        var query_consulta = {
                            query_consulta: params.term,
                        };
                        return query_consulta;
                    }
                }
            }
        );

        $("#cidade").select2({
                placeholder: "Cidade",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('pessoa.get_cidade')}}',
                    data: function (params) {
                        var query_consulta = {
                            query_consulta: params.term,
                            estado_id: $('#estado').val()
                        };
                        return query_consulta;
                    }
                }
            }
        );


        $("#bairro").select2({
                placeholder: "Bairro",
                minimumInputLength: 3,
                ajax: {
                    type: 'POST',
                    dataType: "json",
                    url: '{{route('pessoa.get_bairro')}}',
                    data: function (params) {
                        var query_consulta = {
                            query_consulta: params.term,
                            cidade_id: $('#cidade').val()
                        };
                        return query_consulta;
                    }
                }
            }
        );

        getDataGrid();
        $("#sexo").select2({
                placeholder: "Sexo"
            }
        );

        $("#celular").inputmask({mask: ["(99) 99999-9999"], keepStatic: true, showMaskOnHover: false});
        $("#dt_nascimento").inputmask({mask: ["99/99/9999"], keepStatic: true, showMaskOnHover: false});
        $("#cep").inputmask({mask: ["99.999-999"], keepStatic: true, showMaskOnHover: false});

        $('#cpf_cnpj').inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            keepStatic: true,
            showMaskOnHover: false,
            oncomplete: function () {
                if ($(this).val().length == 18)
                    $('#div_sexo').hide();
                else
                    $('#div_sexo').show();
            }
        });


        datatable = $('#table-pessoa').customGrid({
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
                }, {
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
                ClearDataPessoa();
            }
        });

        $("#modal_confirm_delete_yes").on('click',function(){
            Excluir(id_pessoa);
        });

        $('#modalConfirmDelete').on('hidden.bs.modal', function () {
            $('#modalConfirmDelete').modal('hide');
            id_pessoa = 0;
        });
    });

    function openModalConfirmDelete(pessoa_id){
        id_pessoa = pessoa_id;
        $('#modalConfirmDelete').modal('show');
    }


    function Editar(pessoa_id) {

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: '{{route('pessoa.data_form')}}' + '/' + pessoa_id,
            success: function (resposta) {
                $("#estado").append($('<option/>').val(resposta.estado).text(resposta.estado_nome));
                $("#cidade").append($('<option/>').val(resposta.cidade).text(resposta.cidade_nome));
                $("#bairro").append($('<option/>').val(resposta.bairro).text(resposta.bairro_nome));


                $("#nome").val(resposta.nome).change();
                $("#cpf_cnpj").val(resposta.cpf_cnpj).change();
                $("#dt_nascimento").val(resposta.dt_nascimento).change();
                $("#sexo").val(resposta.sexo).change();
                $("#email").val(resposta.email).change();
                $("#celular").val(resposta.celular).change();
                $("#estado").val(resposta.estado).change();
                $("#cidade").val(resposta.cidade).change();
                $("#bairro").val(resposta.bairro).change();
                $("#logradouro").val(resposta.logradouro).change();
                $("#nr_lograd").val(resposta.nr_lograd).change();
                $("#cep").val(resposta.cep).change();
                $("#cpf_cnpj").change();

                if (resposta.cpf_cnpj.length > 11)
                    $("#div_sexo").hide();
                else
                    $("#div_sexo").show();


                id_pessoa = pessoa_id;
                $('#panelGrid').removeClass('active');
                $('[href="' + '#panelCad' + '"]').tab('show');

            },
            error: function (resposta) {
            }
        });
    }

    function Excluir(pessoa_id) {


        $.ajax({
            type: 'POST',
            url: '{{route('pessoa.delete')}}' + '/' + pessoa_id,
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

    function ClearDataPessoa() {
        $("#nome").val('').change();
        $("#cpf_cnpj").val('').change();
        $("#dt_nascimento").val('').change();
        $("#sexo").val('').change();
        $("#email").val('').change();
        $("#celular").val('').change();
        $("#estado").empty();
        $("#cidade").empty();
        $("#bairro").empty();
        $("#logradouro").val('').change();
        $("#nr_lograd").val('').change();
        $("#cep").val('').change();
        $('#div_sexo').show();
        id_pessoa = 0;
    }

    function getDataGrid() {
        $.ajax({
            type: 'POST',
            url: '{{route('pessoa.data_grid')}}',
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
            url: id_pessoa > 0 ? "{{route('pessoa.update')}}" + '/' + id_pessoa : "{{route('pessoa.insert')}}",
            data: {
                nome: $('#nome').val(),
                cpf_cnpj: $('#cpf_cnpj').inputmask('unmaskedvalue'),
                dt_nascimento: $('#dt_nascimento').val(),
                sexo: $('#sexo').val(),
                email: $('#email').val(),
                celular: $('#celular').inputmask('unmaskedvalue'),
                estado: $("#estado").val(),
                cidade: $("#cidade").val(),
                bairro: $("#bairro").val(),
                logradouro: $("#logradouro").val(),
                nr_lograd: $("#nr_lograd").val(),
                cep: $("#cep").inputmask('unmaskedvalue'),
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
