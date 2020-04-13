<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//pessoas
Route::get('Pessoa', ['as' => 'pessoa.get_view', 'uses' => 'PessoaController@GetView']);
Route::post('PessoaInsert', ['as' => 'pessoa.insert', 'uses' => 'PessoaController@Insert']);
Route::post('PessoaUpdate/{id?}', ['as' => 'pessoa.update', 'uses' => 'PessoaController@Update']);
Route::post('PessoaDelete/{id?}', ['as' => 'pessoa.delete', 'uses' => 'PessoaController@Delete']);
Route::post('PessoaDataGrid', ['as' => 'pessoa.data_grid', 'uses' => 'PessoaController@DataGrid']);
Route::post('PessoaDataForm/{id?}', ['as' => 'pessoa.data_form', 'uses' => 'PessoaController@DataForm']);
Route::post('PessoaGetBairro', ['as' => 'pessoa.get_bairro', 'uses' => 'PessoaController@GetBairro']);
Route::post('PessoaGetCidade', ['as' => 'pessoa.get_cidade', 'uses' => 'PessoaController@GetCidade']);
Route::post('PessoaGetEstado', ['as' => 'pessoa.get_estado', 'uses' => 'PessoaController@GetEstado']);

//clientes
Route::get('Cliente', ['as' => 'cliente.get_view', 'uses' => 'ClienteController@GetView']);
Route::post('ClienteInsert', ['as' => 'cliente.insert', 'uses' => 'ClienteController@Insert']);
Route::post('ClienteGetPessoa', ['as' => 'cliente.get_pessoa', 'uses' => 'ClienteController@GetPessoa']);
Route::post('ClienteUpdate/{id?}', ['as' => 'cliente.update', 'uses' => 'ClienteController@Update']);
Route::post('ClienteDelete/{id?}', ['as' => 'cliente.delete', 'uses' => 'ClienteController@Delete']);
Route::post('ClienteDataGrid', ['as' => 'cliente.data_grid', 'uses' => 'ClienteController@DataGrid']);

//vendedores
Route::get('Vendedor', ['as' => 'vendedor.get_view', 'uses' => 'VendedorController@GetView']);
Route::post('VendedorInsert', ['as' => 'vendedor.insert', 'uses' => 'VendedorController@Insert']);
Route::post('VendedorGetPessoa', ['as' => 'vendedor.get_pessoa', 'uses' => 'VendedorController@GetPessoa']);
Route::post('VendedorUpdate/{id?}', ['as' => 'vendedor.update', 'uses' => 'VendedorController@Update']);
Route::post('VendedorDelete/{id?}', ['as' => 'vendedor.delete', 'uses' => 'VendedorController@Delete']);
Route::post('VendedorDataGrid', ['as' => 'vendedor.data_grid', 'uses' => 'VendedorController@DataGrid']);

//fornecedores
Route::get('Fornecedor', ['as' => 'fornecedor.get_view', 'uses' => 'FornecedorController@GetView']);
Route::post('FornecedorInsert', ['as' => 'fornecedor.insert', 'uses' => 'FornecedorController@Insert']);
Route::post('FornecedorGetPessoa', ['as' => 'fornecedor.get_pessoa', 'uses' => 'FornecedorController@GetPessoa']);
Route::post('FornecedorUpdate/{id?}', ['as' => 'fornecedor.update', 'uses' => 'FornecedorController@Update']);
Route::post('FornecedorDelete/{id?}', ['as' => 'fornecedor.delete', 'uses' => 'FornecedorController@Delete']);
Route::post('FornecedorDataGrid', ['as' => 'fornecedor.data_grid', 'uses' => 'FornecedorController@DataGrid']);

//categoria
Route::get('Categoria', ['as' => 'categoria.get_view', 'uses' => 'CategoriaController@GetView']);
Route::post('CategoriaInsert', ['as' => 'categoria.insert', 'uses' => 'CategoriaController@Insert']);
Route::post('CategoriaUpdate/{id?}', ['as' => 'categoria.update', 'uses' => 'CategoriaController@Update']);
Route::post('CategoriaDelete/{id?}', ['as' => 'categoria.delete', 'uses' => 'CategoriaController@Delete']);
Route::post('CategoriaDataGrid', ['as' => 'categoria.data_grid', 'uses' => 'CategoriaController@DataGrid']);

//produto
Route::get('Produto', ['as' => 'produto.get_view', 'uses' => 'ProdutoController@GetView']);
Route::post('ProdutoInsert', ['as' => 'produto.insert', 'uses' => 'ProdutoController@Insert']);
Route::post('ProdutoUpdate/{id?}', ['as' => 'produto.update', 'uses' => 'ProdutoController@Update']);
Route::post('ProdutoDelete/{id?}', ['as' => 'produto.delete', 'uses' => 'ProdutoController@Delete']);
Route::post('ProdutoDataGrid', ['as' => 'produto.data_grid', 'uses' => 'ProdutoController@DataGrid']);
Route::post('ProdutoGetCategoria', ['as' => 'produto.get_categoria', 'uses' => 'ProdutoController@GetCategoria']);

//entrada
Route::get('Entrada', ['as' => 'entrada.get_view', 'uses' => 'EntradaController@GetView']);
Route::post('EntradaInsert', ['as' => 'entrada.insert', 'uses' => 'EntradaController@Insert']);
Route::post('EntradaUpdate/{id?}', ['as' => 'entrada.update', 'uses' => 'EntradaController@Update']);
Route::post('EntradaDelete/{id?}', ['as' => 'entrada.delete', 'uses' => 'EntradaController@Delete']);
Route::post('EntradaDataGrid', ['as' => 'entrada.data_grid', 'uses' => 'EntradaController@DataGrid']);
Route::post('EntradaGetProduto', ['as' => 'entrada.get_produto', 'uses' => 'EntradaController@GetProduto']);
Route::post('EntradaGetFornecedor', ['as' => 'entrada.get_fornecedor', 'uses' => 'EntradaController@GetFornecedor']);


//saida
Route::get('Saida', ['as' => 'saida.get_view', 'uses' => 'SaidaController@GetView']);
Route::post('SaidaInsert', ['as' => 'saida.insert', 'uses' => 'SaidaController@Insert']);
Route::post('SaidaUpdate/{id?}', ['as' => 'saida.update', 'uses' => 'SaidaController@Update']);
Route::post('SaidaDelete/{id?}', ['as' => 'saida.delete', 'uses' => 'SaidaController@Delete']);
Route::post('SaidaDataGrid', ['as' => 'saida.data_grid', 'uses' => 'SaidaController@DataGrid']);
Route::post('SaidaGetCliente', ['as' => 'saida.get_cliente', 'uses' => 'SaidaController@GetCliente']);
Route::post('SaidaGetVendedor', ['as' => 'saida.get_vendedor', 'uses' => 'SaidaController@GetVendedor']);
Route::post('SaidaGetEstoqueProduto/{saida_id?}/{produto_id?}', ['as' => 'saida.get_estoque_produto', 'uses' => 'SaidaController@GetEstoqueProduto']);
