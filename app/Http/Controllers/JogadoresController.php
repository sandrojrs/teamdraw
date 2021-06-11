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
    public function index_presenca()
    {
        $presencas = presenca::all();
        $jogadores = jogadores::all();
        return view('presenca', compact('presencas', 'jogadores'));
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

    public function storePresenca(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jogador_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->back()
            ->with('error',$validator->errors()->first());
        }

        try {
            DB::beginTransaction();

            foreach ($request->get('jogador_id') as  $value) {

            $model = new presenca();
            $model->jogador_id = $value;
            $model->date = $request->get('date');
            $model->presenca =  0;
            $model->save();

            }

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
        //
    }


    public function edit(jogadores $jogadores)
    {
        //
    }


    public function update(Request $request, jogadores $jogadores)
    {
        //
    }


    public function destroy(jogadores $jogadores)
    {
        //
    }
}
