<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Fornecedor;
use App\Models\Produto;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;

class EntradaController extends Controller
{
    public function GetView()
    {
        return view('entradas.cad_entrada');
    }

    public function DataGrid()
    {
        $entrada = Entrada::join('produto', 'produto.id', 'entrada.produto_id')
            ->join('categoria_produto as categoria', 'categoria.id', '=', 'produto.categoria_id')
            ->join('fornecedor', 'fornecedor.id', '=', 'entrada.fornecedor_id')
            ->join('pessoa', 'pessoa.id', '=', 'fornecedor.pessoa_id')
            ->selectRaw("entrada.id, concat(produto.nome,  ' - ', categoria.nome) as produto,
             format(entrada.qnt,2,'de_DE') as qnt, date_format(dt_entrada, '%d/%m/%Y') as dt_entrada,
              concat(pessoa.nome, ' - ', pessoa.cpf_cnpj, ' - ', date_format(pessoa.dt_nascimento,'%d/%m/%Y')) as fornecedor,
              produto.id as produto_id,fornecedor.id as fornecedor_id");
        return $entrada->get();
    }

    public function GetProduto(Request $request)
    {
        $query = $request->query_consulta;
        return json_encode(['results' => Produto::join('categoria_produto as categ', 'categ.id', '=', 'produto.categoria_id')
            ->where('produto.nome', 'like', "%$query%")
            ->orWhere('categ.nome', 'like', "%$query%")
            ->selectRaw("produto.id, concat(produto.nome,' - ',categ.nome) as text")->get()]);
    }

    public function GetFornecedor(Request $request)
    {
        $query = $request->query_consulta;
        return json_encode(['results' => Fornecedor::join('pessoa', 'pessoa.id', '=', 'fornecedor.pessoa_id')
            ->where('pessoa.nome', 'like', "%$query%")
            ->selectRaw("fornecedor.id, concat(pessoa.nome,' - ',pessoa.cpf_cnpj, ' - ',date_format(pessoa.dt_nascimento,'%d/%m/%Y')) as text")->get()]);

    }


    public function Delete($entrada_id)
    {
        try {
            DB::beginTransaction();

            $entrada = Entrada::find($entrada_id);
            $saldo_temp = $entrada->produto->SaldoEstoque(0,false);
            $saldo_temp-= (float) $entrada->qnt;

            if (bccomp((float)$saldo_temp,0.00,2) == -1)
                return response()->json(['message'=>'Saldo do produto ficará negativo!','success'=>false],422);
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

            $entrada = new Entrada();
            $entrada->produto_id = $request->produto;
            $entrada->fornecedor_id = $request->fornecedor;
            $entrada->qnt = $request->qnt;
            $entrada->dt_entrada = Carbon::createFromFormat('d/m/Y', $request->dt_entrada)->toDateString();
            $entrada->save();

            DB::commit();
            return response()->json(['message' => 'Cadastrado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Validacao(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produto' => 'required',
            'fornecedor' => 'required',
            'qnt' => 'required',
            'dt_entrada' => 'required',
        ],
            [
                'required' => 'Informe o campo :attribute!'
            ]);

        if ($validator->fails()) {
            return $validator->messages()->first();
        }

        return '';
    }

    public function Update($entrada_id, Request $request)
    {
        $validacao = $this->Validacao($request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();
            $entrada = Entrada::find($entrada_id);
            $entrada->produto_id = $request->produto;
            $entrada->fornecedor_id = $request->fornecedor;
            $entrada->qnt = $request->qnt;
            $entrada->dt_entrada = Carbon::createFromFormat('d/m/Y', $request->dt_entrada)->toDateString();
            $entrada->update();


            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Atualizar!' . $e->getMessage(), 'success' => false]);
        }
    }
}
