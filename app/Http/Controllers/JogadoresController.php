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
        $jogadores =jogador::all();
        return view('jogadores', compact('jogadores'));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'level' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->with('error',$validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            $model = new Jogador();
            $model->fill($request->all());
            $model->save();

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
