<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Pessoa;
use DB;
use Exception;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function GetView()
    {
        return view('fornecedores.cad_fornecedor');
    }

    public function DataGrid()
    {
        $fornecedor = Fornecedor::
        join('pessoa', 'pessoa.id', '=', 'fornecedor.pessoa_id')
            ->leftJoin('logradouro', 'logradouro.id', '=', 'pessoa.logradouro_id')
            ->leftJoin('bairro', 'bairro.id', '=', 'logradouro.bairro_id')
            ->leftJoin('cidade', 'cidade.id', '=', 'bairro.cidade_id')
            ->selectRaw("fornecedor.id, pessoa.nome, pessoa.cpf_cnpj,
            if(pessoa.logradouro_id = '', '', concat(logradouro.nome, ' ,', pessoa.nr_lograd, ' ,',logradouro.cep,' ,', bairro.nome,' ,', cidade.nome,' - ', cidade.uf)) as endereco,
        date_format(pessoa.dt_nascimento,'%d/%m/%Y') as dt_nascimento,sexo,if(ativo = 1, 'Ativo','Inativo') as situacao,pessoa.id as pessoa_id");

        return $fornecedor->get();
    }


    public function GetPessoa(Request $request)
    {
        $fornecedor = Fornecedor::where('pessoa_id', '=', $request->fornecedor_id)->first();
        $query = $request->query_consulta;
        $pessoas = Pessoa::
        where('pessoa.id', '<>', isset($fornecedor->pessoa_id) ? $fornecedor->pessoa_id : 0)
            ->where(function ($query1) use ($query) {
                $query1->where('nome', 'like', "%{$query}%");
                $query1->orWhere('cpf_cnpj', 'like', "%{$query}%");
            })->selectRaw("id, concat(nome, ' - ', cpf_cnpj, ' - ', date_format(dt_nascimento,'%d/%m/%Y')) as text")->get();

        return json_encode(['results' => $pessoas]);
    }

    public function Delete($fornecedor_id)
    {
        try {
            DB::beginTransaction();

            $fornecedor = Fornecedor::find($fornecedor_id);

            if($fornecedor->entrada()->count() > 0)
                return response()->json(['message' => 'Fornecedor já tem entradas concretizadas!', 'success' => false],422);

            $fornecedor->delete();

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
            $fornecedor = new Fornecedor();
            $fornecedor->pessoa_id = $request->pessoa;
            $fornecedor->ativo = $ativo;
            $fornecedor->save();

            DB::commit();
            return response()->json(['message' => 'Cadastrado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Validacao($fornecedor, Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'pessoa' => 'required',
            'ativo' => 'required'
        ],
            [
                'required' => 'Informe o campo :attribute!'
            ]);

        if ($validator->fails()) {
            return $validator->messages()->first();
        }

        if (Fornecedor::where('pessoa_id', '=', $request->pessoa)->where('fornecedor.id', '<>', $fornecedor)->first() != '')
            return 'Pessoa já possui cadastro de fornecedor!';

        return '';
    }

    public function Update($fornecedor_id, Request $request)
    {
        $validacao = $this->Validacao($fornecedor_id, $request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();
            $ativo = filter_var($request->ativo, FILTER_VALIDATE_BOOLEAN);

            $fornecedor = Fornecedor::find($fornecedor_id);
            $fornecedor->pessoa_id = $request->pessoa;
            $fornecedor->ativo = $ativo;
            $fornecedor->update();

            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Atualizar!' . $e->getMessage(), 'success' => false]);
        }
    }
}
