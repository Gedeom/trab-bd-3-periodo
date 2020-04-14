<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Vendedor;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;

class VendedorController extends Controller
{
    public function GetView()
    {
        return view('vendedores.cad_vendedor');
    }

    public function DataGrid()
    {
        $vendedor = Vendedor::
        join('pessoa', 'pessoa.id', '=', 'vendedor.pessoa_id')
            ->leftJoin('logradouro', 'logradouro.id', '=', 'pessoa.logradouro_id')
            ->leftJoin('bairro', 'bairro.id', '=', 'logradouro.bairro_id')
            ->leftJoin('cidade', 'cidade.id', '=', 'bairro.cidade_id')
            ->selectRaw("vendedor.id, pessoa.nome, pessoa.cpf_cnpj,
            if(pessoa.logradouro_id = '', '', concat(logradouro.nome, ' ,', pessoa.nr_lograd, ' ,',logradouro.cep,' ,', bairro.nome,' ,', cidade.nome,' - ', cidade.uf)) as endereco,
        date_format(pessoa.dt_nascimento,'%d/%m/%Y') as dt_nascimento,sexo,if(ativo = 1, 'Ativo','Inativo') as situacao,pessoa.id as pessoa_id");

        return $vendedor->get();
    }

    public function GetPessoa(Request $request)
    {
        $vendedor = Vendedor::where('pessoa_id', '=', $request->vendedor_id)->first();
        $query = $request->query_consulta;
        $pessoas = Pessoa::
        where('pessoa.id', '<>', isset($vendedor->pessoa_id) ? $vendedor->pessoa_id : 0)
            ->where(function ($query1) use ($query) {
                $query1->where('nome', 'like', "%{$query}%");
                $query1->orWhere('cpf_cnpj', 'like', "%{$query}%");
            })->selectRaw("id, concat(nome, ' - ', cpf_cnpj, ' - ', date_format(dt_nascimento,'%d/%m/%Y')) as text")->get();

        return json_encode(['results' => $pessoas]);
    }

    public function Delete($vendedor_id)
    {
        try {
            DB::beginTransaction();

            $vendedor = Vendedor::find($vendedor_id);

            if($vendedor->saida()->count() > 0)
                return response()->json(['message' => 'Vendedor já tem vendas concretizadas!', 'success' => false],422);

            $vendedor->delete();
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

            $ativo = filter_var($request->ativo, FILTER_VALIDATE_BOOLEAN);
            $vendedor = new Vendedor();
            $vendedor->pessoa_id = $request->pessoa;
            $vendedor->ativo = $ativo;
            $vendedor->save();

            DB::commit();
            return response()->json(['message' => 'Cadastrado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Validacao($vendedor_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pessoa' => 'required',
            'ativo' => 'required'
        ],
            [
                'required' => 'Informe o campo :attribute!'
            ]);

        if ($validator->fails()) {
            return $validator->messages()->first();
        }

        if (Vendedor::where('pessoa_id', '=', $request->pessoa)->where('vendedor.id', '<>', $vendedor_id)->first() != '')
            return 'Pessoa já possui cadastro de vendedor!';

        return '';
    }

    public function Update($vendedor_id, Request $request)
    {
        $validacao = $this->Validacao($vendedor_id, $request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();
            $ativo = filter_var($request->ativo, FILTER_VALIDATE_BOOLEAN);

            $vendedor = Vendedor::find($vendedor_id);
            $vendedor->pessoa_id = $request->pessoa;
            $vendedor->ativo = $ativo;
            $vendedor->update();

            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Atualizar!' . $e->getMessage(), 'success' => false]);
        }
    }
}
