@include('layout._includes.top')

<title>GVBD - Estoque</title>
<!--Main Layout-->
<main>

    <div class="container">

        <!--Section: Products v.5-->
        <section class="section pb-3 wow fadeIn" data-wow-delay="0.3s">

            <div class="row">

                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/pessoa.jpeg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Pessoas</h4>
                            <!-- Text -->
                            <p class="card-text">Adicionar pessoas para o sistema, tanto fisica, quanto juridica.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('pessoa.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/cliente.jpg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Clientes</h4>
                            <!-- Text -->
                            <p class="card-text">Vincular uma pessoa para ser cliente.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('cliente.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/vendedor.jpg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Vendedores</h4>
                            <!-- Text -->
                            <p class="card-text">Vincular uma pessoa para ser vendedor.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('vendedor.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/fornecedor.jpg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Fornecedores</h4>
                            <!-- Text -->
                            <p class="card-text">Vincular uma pessoa para ser fornecedor.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('fornecedor.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>

            </div>

            <div class="row">


                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/categoria.jpg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Categoria Produtos</h4>
                            <!-- Text -->
                            <p class="card-text">Permite o cadastro da Categoria de Produtos.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('categoria.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/produto.jpg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Produtos</h4>
                            <!-- Text -->
                            <p class="card-text">Permite o cadastro do produtos.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('produto.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/entrada.jpg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Entrada de Produtos</h4>
                            <!-- Text -->
                            <p class="card-text">Permite compra/adição de produtos.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('entrada.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <!-- Card Narrower -->
                    <div class="card card-cascade narrower">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
                            <img class="card-img-top" style="min-height: 180px!important;"
                                 src="{{asset('img/svg/modules/saida.jpg')}}"
                                 alt="Card image cap">
                            <a>
                                <div class="mask rgba-white-slight"></div>
                            </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade">

                            <!-- Title -->
                            <h4 class="font-weight-bold card-title">Saida de Produtos</h4>
                            <!-- Text -->
                            <p class="card-text">Permite a venda/saida de produtos.</p>
                            <!-- Button -->
                            <a class="btn aqua-gradient" href="{{route('saida.get_view')}}">Acessar</a>

                        </div>

                    </div>
                </div>
            </div>


        </section>
    </div>
</main>
@include('layout._includes.footer')
