<?php

namespace App\Http\Controllers;

use App\Models\jogadores;
use App\Models\presenca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class JogadoresController extends Controller
{

    public function index()
    {
        $jogadores =jogadores::all();
        return view('jogadores', compact('jogadores'));
    }
    

    public function create()
    {
        //
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

            $model = new Jogadores();
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

    public function show(jogadores $jogadores)
    {
      dd('oi');
    }


    public function edit(jogadores $jogadores)
    {
        //
    }


    public function update(Request $request, jogadores $jogadores)
    {
        try {
            DB::beginTransaction();

            $jogadores = jogadores::find($request->get('id'));
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
    public function destroy($id)
    {
        try {          
            $jogador = jogadores::findOrFail($id);
            $jogador->delete();
            return redirect()
            ->back()
            ->with('success', 'Jogador excluido com sucesso');
        } catch (\PDOException $e) {
            return redirect()
            ->back()
            ->with('error', $e);
        }
    }
}
