<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Pessoa;
use App\Models\Produto;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;

class ProdutoController extends Controller
{
    public function GetView()
    {
        return view('produtos.cad_produto');
    }

    public function DataGrid()
    {
        $produto = Produto::
        join('categoria_produto as categoria', 'categoria.id', '=', 'produto.categoria_id')
            ->selectRaw('produto.id, produto.nome,
            format(coalesce((select sum(qnt) from entrada where produto_id = produto.id),0)
            - coalesce((select sum(qnt) from saida where produto_id = produto.id),0)
            + coalesce(qnt_inicial,0),2,\'de_DE\') as qnt_estoque, format(vlr_padrao,2,\'de_DE\') as valor,
            categoria.nome as categoria, format(qnt_inicial,2,\'de_DE\') as qnt_inicial, categoria.id as categoria_id');
        return $produto->get();
    }


    public function Delete($produto_id)
    {
        try {
            DB::beginTransaction();

            $produto = Produto::find($produto_id);

            if($produto->entradas()->count() > 0)
                return response()->json(['message' => 'Produto tem entrada!', 'success' => false],422);

            if($produto->saidas()->count() > 0)
                return response()->json(['message' => 'Produto tem saida!', 'success' => false],422);

            $produto->delete();

            DB::commit();
            return response()->json(['message' => 'Deletado com sucesso!', 'success' => true]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Deletar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Insert(Request $request)
    {
        $validacao = $this->Validacao($request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();

            $produto = new Produto();
            $produto->nome = $request->nome;
            $produto->categoria_id = $request->categoria;
            $produto->qnt_inicial = $request->qnt_inicial;
            $produto->vlr_padrao = $request->vlr_padrao;
            $produto->save();

            DB::commit();
            return response()->json(['message' => 'Cadastrado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function GetCategoria(Request $request){
        $query = $request->query_consulta;
        $categorias = Categoria::
                where('nome', 'like', "%{$query}%")
            ->selectRaw("id, nome as text")->get();

        return json_encode(['results' => $categorias]);
    }

    public function Validacao(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'categoria' => 'required',
            'qnt_inicial' => 'required',
            'vlr_padrao' => 'required',
        ],
            [
                'required' => 'Informe o campo :attribute!'
            ]);

        if ($validator->fails()) {
            return $validator->messages()->first();
        }

        if($request->vlr_padrao == 0)
            return 'Informe o valor padrão do produto!';

        return '';
    }

    public function Update($produto_id, Request $request)
    {
        $validacao = $this->Validacao($request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();

            $produto = Produto::find($produto_id);
            $produto->nome = $request->nome;
            $produto->categoria_id = $request->categoria;
            $produto->qnt_inicial = $request->qnt_inicial;
            $produto->vlr_padrao = $request->vlr_padrao;
            $produto->update();

            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Atualizar!' . $e->getMessage(), 'success' => false]);
        }
    }
}
