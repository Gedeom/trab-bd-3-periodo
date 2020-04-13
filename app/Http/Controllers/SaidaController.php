<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Entrada;
use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\Saida;
use App\Models\Vendedor;
use Carbon\Carbon;
use DB;
use Exception;
use GPD\Models\Utils\MathUtils;
use Illuminate\Http\Request;
use Validator;

class SaidaController extends Controller
{
    public function GetView()
    {
        return view('saidas.cad_saida');
    }

    public function DataGrid()
    {
        $entrada = Saida::join('produto', 'produto.id', 'saida.produto_id')
            ->join('categoria_produto as categoria', 'categoria.id', '=', 'produto.categoria_id')
            ->join('cliente', 'cliente.id', '=', 'saida.cliente_id')
            ->join('pessoa as p_cli', 'p_cli.id', '=', 'cliente.pessoa_id')
            ->join('vendedor', 'vendedor.id', '=', 'saida.vendedor_id')
            ->join('pessoa as p_vend', 'p_vend.id', '=', 'vendedor.pessoa_id')
            ->selectRaw("saida.id, concat(produto.nome,  ' - ', categoria.nome) as produto,
             format(saida.qnt,2,'de_DE') as qnt, format(saida.vlr,2,'de_DE') as vlr,date_format(dt_saida, '%d/%m/%Y') as dt_saida,
              concat(p_cli.nome, ' - ', p_cli.cpf_cnpj, ' - ', date_format(p_cli.dt_nascimento,'%d/%m/%Y')) as cliente,
              produto.id as produto_id,cliente.id as cliente_id,
              concat(p_vend.nome, ' - ', p_vend.cpf_cnpj, ' - ', date_format(p_vend.dt_nascimento,'%d/%m/%Y')) as vendedor,
              vendedor.id as vendedor_id");
        return $entrada->get();
    }


    public function Delete($saida_id)
    {
        try {
            DB::beginTransaction();

            Saida::find($saida_id)->delete();
            DB::commit();
            return response()->json(['message' => 'Deletado com sucesso!', 'success' => true]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Deletar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Insert(Request $request)
    {
        $validacao = $this->Validacao(0, $request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();

            $saida = new Saida();
            $saida->produto_id = $request->produto;
            $saida->cliente_id = $request->cliente;
            $saida->vendedor_id = $request->vendedor;
            $saida->qnt = $request->qnt;
            $saida->vlr = $request->vlr;
            $saida->dt_saida = Carbon::createFromFormat('d/m/Y', $request->dt_saida)->toDateString();
            $saida->save();

            DB::commit();
            return response()->json(['message' => 'Cadastrado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Validacao($saida_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produto' => 'required',
            'cliente' => 'required',
            'vendedor' => 'required',
            'qnt' => 'required',
            'vlr' => 'required',
            'dt_saida' => 'required',
        ],
            [
                'required' => 'Informe o campo :attribute!'
            ]);

        if ($validator->fails()) {
            return $validator->messages()->first();
        }

        $produto =  Produto::find($request->produto);
        $saldo_temp = $produto->SaldoEstoque($saida_id,false);
        $saldo_temp-= (float) $request->qnt;

        if (bccomp((float)$saldo_temp,(float)0.00,2) == -1)
            return 'Saldo do produto ficará negativo!';

        if($request->qnt <= 0)
            return 'Quantidade de saida não pode ser zero!';

        if($request->vlr <= 0)
            return 'Valor de saida não pode ser zero!';
        return '';
    }

    public function Update($saida_id, Request $request)
    {
        $validacao = $this->Validacao($saida_id,$request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();

            $saida = Saida::find($saida_id);
            $saida->produto_id = $request->produto;
            $saida->cliente_id = $request->cliente;
            $saida->vendedor_id = $request->vendedor;
            $saida->qnt = $request->qnt;
            $saida->vlr = $request->vlr;
            $saida->dt_saida = Carbon::createFromFormat('d/m/Y', $request->dt_saida)->toDateString();
            $saida->update();



            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Atualizar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function GetCliente(Request $request){
        $query = $request->query_consulta;
        return json_encode(['results' => Cliente::join('pessoa', 'pessoa.id', '=', 'cliente.pessoa_id')
            ->where('pessoa.nome', 'like', "%$query%")
            ->selectRaw("cliente.id, concat(pessoa.nome,' - ',pessoa.cpf_cnpj, ' - ',date_format(pessoa.dt_nascimento,'%d/%m/%Y')) as text")->get()]);

    }

    public function GetVendedor(Request $request){
        $query = $request->query_consulta;
        return json_encode(['results' => Vendedor::join('pessoa', 'pessoa.id', '=', 'vendedor.pessoa_id')
            ->where('pessoa.nome', 'like', "%$query%")
            ->selectRaw("vendedor.id, concat(pessoa.nome,' - ',pessoa.cpf_cnpj, ' - ',date_format(pessoa.dt_nascimento,'%d/%m/%Y')) as text")->get()]);

    }

    public function GetEstoqueProduto($saida_id,$produto_id){
        $produto = Produto::find($produto_id);

        return ['estoque' => $produto->SaldoEstoque($saida_id)];
    }
}
