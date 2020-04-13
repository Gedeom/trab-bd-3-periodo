<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    {{-- css    --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="{{asset('/css/inputmask.css')}}" rel="stylesheet">

    {{-- css datatables   --}}

    <link rel="stylesheet" href="{{asset('css/addons/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/datatables-select.min.css')}}">
{{--    <link href="{{asset('DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('DataTables/Select-1.3.0/css/select.bootstrap4.css')}}" rel="stylesheet">--}}
    <link href="{{asset('DataTables/ColReorder-1.5.0/css/colReorder.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('DataTables/FixedHeader-3.1.4/css/fixedHeader.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('DataTables/Responsive-2.2.2/css/responsive.bootstrap4.css')}}" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('css/addons/directives.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/flag.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/jquery.zmd.hierarchical-display.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/rating.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/steppers.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/timeline.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/chat.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/multi-range.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/simple-charts.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/addons/cards-extended.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/modules/animations-extended.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/modules/accordion-extended.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/modules/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/modules/megamenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/modules/parallax.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2-materialize.css')}}">

    <link href='{{asset('font/roboto/Roboto-Bold.woff2')}}' rel='stylesheet' type='text/css'>
    <link href='{{asset('font/roboto/Roboto-Light.woff2')}}' rel='stylesheet' type='text/css'>
    <link href='{{asset('font/roboto/Roboto-Medium.woff2')}}' rel='stylesheet' type='text/css'>
    <link href='{{asset('font/roboto/Roboto-Regular.woff2')}}' rel='stylesheet' type='text/css'>
    <link href='{{asset('font/roboto/Roboto-Thin.woff2')}}' rel='stylesheet' type='text/css'>


    {{--  js  --}}
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/mdb.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/inputmask.min.js')}}"></script>
    <script src="{{asset('js/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('js/jquery.maskMoney.min.js')}}"></script>
    <script src="{{asset('js/addons/datatables.min.js')}}"></script>
    <script src="{{asset('js/addons/datatables-select.min.js')}}"></script>
    <script src="{{asset('js/addons/directives.min.js')}}"></script>
    <script src="{{asset('js/addons/flag.min.js')}}"></script>
    <script src="{{asset('js/addons/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('js/addons/jquery.zmd.hierarchical-display.min.js')}}"></script>
    <script src="{{asset('js/addons/masonry.pkgd.min.js')}}"></script>
    <script src="{{asset('js/addons/rating.min.js')}}"></script>
    <script src="{{asset('js/addons/multi-range.min.js')}}"></script>
    <script src="{{asset('js/addons/cards-extended.min.js')}}"></script>
    <script src="{{asset('js/addons/chat.min.js')}}"></script>
    <script src="{{asset('js/addons/simple-charts.min.js')}}"></script>
    <script src="{{asset('js/addons/timeline.min.js')}}"></script>
    <script src="{{asset('js/addons/steppers.min.js')}}"></script>
    <script src="{{asset('js/addons/waves.js')}}"></script>
    <script src="{{asset('js/addons/picker.js')}}"></script>
    <script src="{{asset('js/addons/picker-date.js')}}"></script>
    <script src="{{asset('js/addons/picker-time.js')}}"></script>
{{--    <script src="{{asset('js/addons/material-select.js')}}"></script>--}}
{{--    <script src="{{asset('js/addons/material-select-view.js')}}"></script>--}}
{{--    <script src="{{asset('js/addons/material-select-view-renderer.js')}}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    {{-- Plugins DataTable js   --}}
{{--    <script src="{{asset('DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js')}}"></script>--}}
    <script src="{{asset('DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js')}}"></script>
{{--    <script src="{{asset('DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js')}}"></script>--}}
    <script src="{{asset('DataTables/JSZip-2.5.0/jszip.min.js')}}"></script>
    <script src="{{asset('DataTables/pdfmake-0.1.36/pdfmake.min.js')}}"></script>
    <script src="{{asset('DataTables/pdfmake-0.1.36/vfs_fonts.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-1.5.6/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-1.5.6/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-1.5.6/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('DataTables/ColReorder-1.5.0/js/dataTables.colReorder.min.js')}}"></script>
    <script src="{{asset('DataTables/ColReorder-1.5.0/js/colReorder.bootstrap4.min.js')}}"></script>
    <script src="{{asset('DataTables/FixedHeader-3.1.4/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('DataTables/FixedHeader-3.1.4/js/fixedHeader.bootstrap4.min.js')}}"></script>
    <script src="{{asset('DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('DataTables/Responsive-2.2.2/js/responsive.bootstrap4.min.js')}}"></script>
{{--    <script src="{{asset('DataTables/Select-1.3.0/js/dataTables.select.js')}}"></script>--}}

    {{-- modules    --}}
    <script src="{{asset('js/modules/accordion-extended.min.js')}}"></script>
    <script src="{{asset('js/modules/animations-extended.min.js')}}"></script>
    <script src="{{asset('js/modules/buttons.min.js')}}"></script>
    <script src="{{asset('js/modules/character-counter.min.js')}}"></script>
    <script src="{{asset('js/modules/collapsible.min.js')}}"></script>
    <script src="{{asset('js/modules/dropdown.min.js')}}"></script>
    <script src="{{asset('js/modules/dropdown-searchable.min.js')}}"></script>
    <script src="{{asset('js/modules/file-input.min.js')}}"></script>
    <script src="{{asset('js/modules/forms-free.min.js')}}"></script>
    <script src="{{asset('js/modules/lightbox.min.js')}}"></script>
    <script src="{{asset('js/modules/megamenu.min.js')}}"></script>
    <script src="{{asset('js/modules/preloading.min.js')}}"></script>
    <script src="{{asset('js/modules/range-input.min.js')}}"></script>
    <script src="{{asset('js/modules/scrolling-navbar.min.js')}}"></script>
    <script src="{{asset('js/modules/sidenav.min.js')}}"></script>
    <script src="{{asset('js/modules/smooth-scroll.min.js')}}"></script>
    <script src="{{asset('js/modules/sticky.min.js')}}"></script>
    <script src="{{asset('js/modules/treeview.min.js')}}"></script>
    <script src="{{asset('js/modules/wow.min.js')}}"></script>




    <script>

        function getTextWidth_Height(text, font, w_h = 'w') {
            // re-use canvas object for better performance
            var canvas = getTextWidth_Height.canvas || (getTextWidth_Height.canvas = document.createElement("canvas"));
            var context = canvas.getContext("2d");
            context.font = font;
            var metrics = context.measureText(text);

            return (w_h === 'w' ? metrics.width : canvas.height);

        }

        function formataDinheiro(n,casasDecimais) {
            if(casasDecimais === undefined){
                return n.toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
            }else{
                return n.toFixed(casasDecimais).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
            }

        }
        //extend date picker
        $.fn.customDatePicker = function(options){

            let default_object =  {
                monthsFull: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro',
                    'Novembro', 'Dezembro'],
                monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out',
                    'Nov', 'Dez'],
                weekdaysFull: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],

                today: 'Hoje',
                clear: 'Limpar',
                formatSubmit: 'dd/mm/yyyy',
                format: 'dd/mm/yyyy'
            };

            return $(this).pickadate($.extend(true, default_object, options));

        };

        //extend datatable
        $.fn.customGrid = function (options) {
            let default_object = {
                "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-3'i><'col-md-6'><'col-md-3'p>>",
                pagingType: 'full_numbers',
                select: true,
                responsive: true,
                "language": {
                    "url": '{!! asset('DataTables/DataTables-1.10.18/language/pt-br.json') !!}',
                    select: {
                        rows: {
                            _: "%d linhas selecionadas",
                            0: '',
                            1: "1 linha selecionada"
                        }
                    }
                },

                columns: []
            };


            return $(this).DataTable($.extend(true, default_object, options));

        };

        function select2_search ($el, term) {
            $el.select2('open');

            // Get the search box within the dropdown or the selection
            // Dropdown = single, Selection = multiple
            var $search = $el.data('select2').dropdown.$search || $el.data('select2').selection.$search;
            // This is undocumented and may change in the future

            $search.val(term);
            $search.trigger('keyup');
        }

        $(document).ready(function(){
            $('.date_apply').customDatePicker();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style>
        header
        {
            height: 100px;
        }


        .page-footer {
            bottom: 0px !important;
            margin-top: auto !important;
        }

    </style>

</head>

<body>
<!--Main Navigation-->
<header>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar aqua-gradient">
        <div class="container">
            <a class="navbar-brand" href="/">
                <strong>GVBD - Estoque</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
                    aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">Pessoas</a>
                        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink1">
                            <a class="dropdown-item" href="{{route('pessoa.get_view')}}">Pessoas</a>
                            <a class="dropdown-item" href="{{route('cliente.get_view')}}">Clientes</a>
                            <a class="dropdown-item" href="{{route('fornecedor.get_view')}}">Fornecedores</a>
                            <a class="dropdown-item" href="{{route('vendedor.get_view')}}">Vendedores</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categoria.get_view')}}">Categoria Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('produto.get_view')}}">Produtos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('entrada.get_view')}}">Entrada Estoque</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('saida.get_view')}}">Saida Estoque</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
