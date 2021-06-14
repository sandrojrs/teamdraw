<?php

namespace App\Http\Controllers;

use App\Models\presenca;
use App\Models\jogadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PresencaController extends Controller
{
    public function index(Request $request)    
    {
       if(!$request->get('date')){
         $date = date("y-m-d");
       } else{
           $date = $request->get('date');
       }    
        $presencas = presenca::where('date', $date)->get();
        $jogadores = jogadores::all();
        return view('presenca', compact('presencas', 'jogadores'));
    }

    public function store(Request $request)
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

            if (!presenca::where([
                ['jogador_id', $value],
                ['date',$request->get('date')]
                ])->exists()) {
                $model = new presenca();
                $model->jogador_id = $value;
                $model->date = $request->get('date');
                $model->presenca = $request->get('presenca') ? 1 : 0 ;
                $model->save();

                }

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

}
