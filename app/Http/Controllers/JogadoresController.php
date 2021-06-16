<?php

namespace App\Http\Controllers;

use App\Models\jogador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JogadoresController extends Controller
{

    public function index()
    {
        //busca todos os jogadores enviando para a view
        $jogadores =jogador::all();
        return view('jogadores', compact('jogadores'));
    }

    public function store(Request $request)
    {
        //verifica se o name e level foram preenchidos
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required',
        ]);

        //caso validator for vazio retorna o primeiro erro
        if ($validator->fails()) {
            return redirect()
            ->back()
            ->with('error',$validator->errors()->first());
        }

        // inicia o try/catch
        try {
            // inicia uma transação
            DB::beginTransaction();

            $model = new Jogador();
            $model->fill($request->all());
            $model->save();

            //se ocorrer erros reverter a gravação de dados , se não continua
            DB::commit();

            return redirect()
            ->back()
            ->with('success', 'Jogador cadastrado com sucesso');
        } catch (\PDOException $e) {
            return redirect()
            ->back()
            ->with('error', $e);
        }

    }

    public function update(Request $request, jogador $jogadores)
    {
        try {
            DB::beginTransaction();

            $jogadores = jogador::find($request->get('id'));
            $jogadores->fill($request->all());
            $jogadores->save();

            DB::commit();

            return redirect()
            ->back()
            ->with('success', 'Jogador Atualizado com sucesso');
        } catch (\PDOException $e) {
            return redirect()
            ->back()
            ->with('error', $e);
        }

    }
    public function destroy(jogador $jogador)
    {
        if($jogador->delete()){
            return redirect()
            ->back()
            ->with('success', 'Jogador Atualizado com sucesso');
       }else{
            return redirect()
            ->back()
            ->with('error', 'falha ao excluir');
       };
    }
}
