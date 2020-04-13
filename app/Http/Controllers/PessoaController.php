<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Logradouro;
use App\Models\Pessoa;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use stdClass;
use Validator;

class PessoaController extends Controller
{
    public function GetView()
    {
        return view('pessoas.cad_pessoa');
    }

    public function DataGrid()
    {
        $pessoa = Pessoa::
        leftJoin('logradouro', 'logradouro.id', '=', 'pessoa.logradouro_id')
            ->leftJoin('bairro', 'bairro.id', '=', 'logradouro.bairro_id')
            ->leftJoin('cidade', 'cidade.id', '=', 'bairro.cidade_id')
            ->selectRaw("pessoa.id, pessoa.nome, pessoa.cpf_cnpj,
            if(pessoa.logradouro_id = '', '', concat(logradouro.nome, ' ,', pessoa.nr_lograd, ' ,',logradouro.cep,' ,', bairro.nome,' ,', cidade.nome,' - ', cidade.uf)) as endereco,
        date_format(pessoa.dt_nascimento,'%d/%m/%Y') as dt_nascimento,sexo,celular");

        return $pessoa->get();
    }

    public function DataForm($pessoa_id)
    {
        $pessoa = Pessoa::find($pessoa_id);

        $std_class_pessoa = new stdClass();
        $std_class_pessoa->nome = $pessoa->nome;
        $std_class_pessoa->cpf_cnpj = $pessoa->cpf_cnpj;
        $std_class_pessoa->dt_nascimento = Carbon::parse($pessoa->dt_nascimento)->format('d/m/Y');
        $std_class_pessoa->sexo = $pessoa->sexo;
        $std_class_pessoa->email = $pessoa->email;
        $std_class_pessoa->celular = $pessoa->celular;
        $std_class_pessoa->estado_nome = $pessoa->logradouro_id != null ? $pessoa->logradouro->bairro->cidade->estado->nome : '';
        $std_class_pessoa->estado = $pessoa->logradouro_id != null ? $pessoa->logradouro->bairro->cidade->uf : '';

        $std_class_pessoa->cidade_nome = $pessoa->logradouro_id != null ? $pessoa->logradouro->bairro->cidade->nome : '';
        $std_class_pessoa->cidade = $pessoa->logradouro_id != null ? $pessoa->logradouro->bairro->cidade->id : '';

        $std_class_pessoa->bairro_nome = $pessoa->logradouro_id != null ? $pessoa->logradouro->bairro->nome : '';
        $std_class_pessoa->bairro = $pessoa->logradouro_id != null ? $pessoa->logradouro->bairro->id : '';

        $std_class_pessoa->logradouro = $pessoa->logradouro_id != null ? $pessoa->logradouro->nome : '';
        $std_class_pessoa->nr_lograd = $pessoa->nr_lograd;
        $std_class_pessoa->cep = $pessoa->logradouro->cep;

        return json_encode($std_class_pessoa);
    }

    public function Insert(Request $request)
    {
        $validacao = $this->Validacao(0, $request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();

            $logradouro = Logradouro::join('bairro', 'bairro.id', '=', 'logradouro.bairro_id')
                ->join('cidade', 'cidade.id', '=', 'bairro.cidade_id')
                ->where('bairro.id', '=', $request->bairro)
                ->where('cidade.id', '=', $request->cidade)
                ->where('cidade.uf', '=', $request->estado)
                ->where('cep', '=', $request->cep)
                ->select('logradouro.*')
                ->first();

            if ($logradouro == '') {
                $logradouro = new Logradouro();
                $logradouro->nome = $request->logradouro;
                $logradouro->cep = $request->cep;
                $logradouro->bairro_id = $request->bairro;
                $logradouro->save();
            }
            $pessoa = new Pessoa();
            $pessoa->nome = $request->nome;
            $pessoa->cpf_cnpj = $request->cpf_cnpj;
            $pessoa->dt_nascimento = Carbon::createFromFormat('d/m/Y', $request->dt_nascimento)->toDateString();
            $pessoa->sexo = strlen($request->cpf_cnpj) > 11 ? null : $request->sexo;
            $pessoa->email = $request->email;
            $pessoa->celular = $request->celular;
            $pessoa->nr_lograd = $request->nr_lograd;
            $pessoa->logradouro_id = $logradouro->id;
            $pessoa->save();

            DB::commit();
            return response()->json(['message' => 'Cadastrado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }

    public function Validacao($pessoa_id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cpf_cnpj' => 'required',
            'nome' => 'required',
            'dt_nascimento' => 'string|required',
            'sexo' => strlen($request->cpf_cnpj) == 14 ? 'string' : 'string|required',
            'email' => 'required',
            'celular' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'logradouro' => 'required',
            'nr_lograd' => 'required',
            'cep' => 'required'
        ],
            [
                'required' => 'Informe o campo :attribute!'
            ]);
        if ($validator->fails()) {
            return $validator->messages()->first();
        }

        if (strlen($request->cpf_cnpj) <= 11 && !$this->validate_cpf($request->cpf_cnpj))
            return 'CPF Inválido';
        else if (strlen($request->cpf_cnpj) > 11 && !$this->validate_cnpj($request->cpf_cnpj))
            return 'CNPJ Inválido';

        if (Pessoa::where('cpf_cnpj', '=', "{$request->cpf_cnpj}")->where('id','!=',$pessoa_id)->first() != '')
            return 'Já existe uma pessoa com esse documento';

        return '';
    }

    private function validate_cpf($value)
    {
        /*
         * Salva em $cpf apenas numeros, isso permite receber o cpf em diferentes formatos,
         * como "000.000.000-00", "00000000000", "000 000 000 00"
         */
        $cpf = preg_replace('/\D/', '', $value);
        $num = array();

        /* Cria um array com os valores */
        for ($i = 0; $i < (strlen($cpf)); $i++) {

            $num[] = $cpf[$i];
        }

        if (count($num) != 11) {
            return false;
        } else {
            /*
            Combinações como 00000000000 e 22222222222 embora
            não sejam cpfs reais resultariam em cpfs
            válidos após o calculo dos dígitos verificares e
            por isso precisam ser filtradas nesta parte.
            */
            for ($i = 0; $i < 10; $i++) {
                if ($num[0] == $i && $num[1] == $i && $num[2] == $i
                    && $num[3] == $i && $num[4] == $i && $num[5] == $i
                    && $num[6] == $i && $num[7] == $i && $num[8] == $i) {
                    return false;
                    break;
                }
            }
        }
        /*
        Calcula e compara o
        primeiro dígito verificador.
        */
        $j = 10;
        for ($i = 0; $i < 9; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[9]) {
            return false;
        }
        /*
        Calcula e compara o
        segundo dígito verificador.
        */
        $j = 11;
        for ($i = 0; $i < 10; $i++) {
            $multiplica[$i] = $num[$i] * $j;
            $j--;
        }
        $soma = array_sum($multiplica);
        $resto = $soma % 11;
        if ($resto < 2) {
            $dg = 0;
        } else {
            $dg = 11 - $resto;
        }
        if ($dg != $num[10]) {
            return false;
        } else {
            return true;
        }
    }

    private function validate_cnpj($value)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string)$value);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function Update($id, Request $request)
    {
        $validacao = $this->Validacao(0, $request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();

            $logradouro = Logradouro::join('bairro', 'bairro.id', '=', 'logradouro.bairro_id')
                ->join('cidade', 'cidade.id', '=', 'bairro.cidade_id')
                ->where('bairro.id', '=', $request->bairro)
                ->where('cidade.id', '=', $request->cidade)
                ->where('cidade.uf', '=', $request->estado)
                ->where('cep', '=', $request->cep)
                ->select('logradouro.*')
                ->first();

            if ($logradouro == '') {
                $logradouro = new Logradouro();
                $logradouro->nome = $request->logradouro;
                $logradouro->cep = $request->cep;
                $logradouro->bairro_id = $request->bairro;
                $logradouro->save();
            }
            $pessoa = Pessoa::find($id);
            $pessoa->nome = $request->nome;
            $pessoa->cpf_cnpj = $request->cpf_cnpj;
            $pessoa->dt_nascimento = Carbon::createFromFormat('d/m/Y', $request->dt_nascimento)->toDateString();
            $pessoa->sexo = strlen($request->cpf_cnpj) > 11 ? null : $request->sexo;
            $pessoa->email = $request->email;
            $pessoa->celular = $request->celular;
            $pessoa->nr_lograd = $request->nr_lograd;
            $pessoa->logradouro_id = $logradouro->id;
            $pessoa->update();

            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao cadastrar!' . $e->getMessage(), 'success' => false]);
        }
    }


    public function Delete($pessoa_id)
    {

        try {
            DB::beginTransaction();
//
//            if (Cliente::where('pessoa_id', '=', $pessoa_id)->first() != '')
//                return response()->json(['message' => 'Pessoa já é um Cliente!', 'success' => false], 422);
//
//            if (Fornecedor::where('pessoa_id', '=', $pessoa_id)->first() != '')
//                return response()->json(['message' => 'Pessoa já é um Fornecedor!', 'success' => false], 422);
//
//            if (Vendedor::where('pessoa_id', '=', $pessoa_id)->first() != '')
//                return response()->json(['message' => 'Pessoa já é um Vendedor!', 'success' => false], 422);

            $pessoa = Pessoa::find($pessoa_id);
            $pessoa->logradouro_id = null;
            $pessoa->delete();

            DB::commit();
            return response()->json(['message' => 'Deletado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao deletar!'. $e->getMessage(), 'success' => false], 422);
        }
    }

    public function GetBairro(Request $request)
    {
        $cidade_id = $request->cidade_id;
        $query = $request->query_consulta;
        return json_encode(['results' => Bairro::where('cidade_id', '=', $cidade_id)->where('nome', 'like', "%$query%")->selectRaw('id, nome as text')->get()]);
    }

    public function GetCidade(Request $request)
    {
        $estado_id = $request->estado_id;
        $query = $request->query_consulta;
        return json_encode(['results' => Cidade::where('uf', '=', $estado_id)->where('nome', 'like', "%$query%")->selectRaw('id, nome as text')->get()]);
    }

    public function GetEstado(Request $request)
    {
        $query = $request->query_consulta;
        return json_encode(['results' => Estado::where('nome', 'like', "%$query%")->selectRaw('uf as id, nome as text')->get()]);
    }
}
