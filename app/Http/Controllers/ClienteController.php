<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Logradouro;
use App\Models\Pessoa;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Validator;

class ClienteController extends Controller
{
    public function GetView()
    {
        return view('clientes.cad_cliente');
    }

    public function DataGrid()
    {
        $cliente = Cliente::
        join('pessoa', 'pessoa.id', '=', 'cliente.pessoa_id')
            ->leftJoin('logradouro', 'logradouro.id', '=', 'pessoa.logradouro_id')
            ->leftJoin('bairro', 'bairro.id', '=', 'logradouro.bairro_id')
            ->leftJoin('cidade', 'cidade.id', '=', 'bairro.cidade_id')
            ->selectRaw("cliente.id, pessoa.nome, pessoa.cpf_cnpj,
            if(pessoa.logradouro_id = '', '', concat(logradouro.nome, ' ,', pessoa.nr_lograd, ' ,',logradouro.cep,' ,', bairro.nome,' ,', cidade.nome,' - ', cidade.uf)) as endereco,
        date_format(pessoa.dt_nascimento,'%d/%m/%Y') as dt_nascimento,sexo,if(ativo = 1, 'Ativo','Inativo') as situacao,pessoa.id as pessoa_id");

        return $cliente->get();
    }


    public function GetPessoa(Request $request)
    {
        $cliente = Cliente::where('pessoa_id', '=', $request->cliente_id)->first();
        $query = $request->query_consulta;
        $pessoas = Pessoa::
        where('pessoa.id', '<>', isset($cliente->pessoa_id) ? $cliente->pessoa_id : 0)
            ->where(function ($query1) use ($query) {
                $query1->where('nome', 'like', "%{$query}%");
                $query1->orWhere('cpf_cnpj', 'like', "%{$query}%");
            })->selectRaw("id, concat(nome, ' - ', cpf_cnpj, ' - ', date_format(dt_nascimento,'%d/%m/%Y')) as text")->get();

        return json_encode(['results' => $pessoas]);
    }

    public function Delete($cliente_id){
        try{
            DB::beginTransaction();

            Cliente::find($cliente_id)->delete();
            DB::commit();
            return response()->json(['message' => 'Deletado com sucesso!', 'success' => true]);
        }catch (\Exception $e){
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
            $cliente = new Cliente();
            $cliente->pessoa_id = $request->pessoa;
            $cliente->ativo = $ativo;
            $cliente->save();

            DB::commit();
            return response()->json(['message' => 'Cadastrado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Validacao($cliente_id, Request $request)
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

        if (Cliente::where('pessoa_id', '=', $request->pessoa)->where('cliente.id', '<>', $cliente_id)->first() != '')
            return 'Pessoa já possui cadastro de cliente!';

        return '';
    }

    public function Update($cliente_id, Request $request)
    {
        $validacao = $this->Validacao($cliente_id, $request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();
            $ativo = filter_var($request->ativo, FILTER_VALIDATE_BOOLEAN);

            $cliente = Cliente::find($cliente_id);
            $cliente->pessoa_id = $request->pessoa;
            $cliente->ativo = $ativo;
            $cliente->update();

            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Atualizar!' . $e->getMessage(), 'success' => false]);
        }
    }


}
