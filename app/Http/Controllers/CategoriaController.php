<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;

class CategoriaController extends Controller
{
    public function GetView()
    {
        return view('categorias.cad_categoria');
    }

    public function DataGrid()
    {
        $categoria = Categoria::selectRaw('id, nome');
        return $categoria->get();
    }


    public function Delete($categoria_id)
    {
        try {
            DB::beginTransaction();

            Categoria::find($categoria_id)->delete();
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

            $categoria = new Categoria();
            $categoria->nome = $request->nome;
            $categoria->save();

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
            'nome' => 'required'
        ],
            [
                'required' => 'Informe o campo :attribute!'
            ]);

        if ($validator->fails()) {
            return $validator->messages()->first();
        }

        return '';
    }

    public function Update($categoria_id, Request $request)
    {
        $validacao = $this->Validacao($request);

        if ($validacao != '')
            return response()->json(['message' => $validacao, 'success' => false], 422);

        try {
            DB::beginTransaction();
            $ativo = filter_var($request->ativo, FILTER_VALIDATE_BOOLEAN);

            $categoria = Categoria::find($categoria_id);
            $categoria->nome = $request->nome;
            $categoria->update();

            DB::commit();
            return response()->json(['message' => 'Atualizado com sucesso!', 'success' => true]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Erro ao Atualizar!' . $e->getMessage(), 'success' => false]);
        }
    }
}
