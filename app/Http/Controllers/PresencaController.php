<?php

namespace App\Http\Controllers;

use App\Models\presenca;
use App\Models\jogador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PresencaController extends Controller
{
    public function index(Request $request)
    {
       //verifica se o input date esta passando algum dado caso não esteja retorna a data atual
       if(!$request->get('date')){
         $date = date("Y-m-d");
       } else{
           $date = $request->get('date');
       }
        //pesquisa pela data na tabela presenca e retorna para a view
        $presencas = presenca::where('date', $date)->get();
        $jogadores = jogador::all();
        return view('presenca', compact('presencas', 'jogadores'));
    }

    public function store(Request $request)
    {
        //verifica se o jogador_id e date foram preenchidos
        $validator = Validator::make($request->all(), [
            'jogador_id' => 'required',
            'date' => 'required',
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

            // faz um laço para verificar os jogadores marcados
            foreach ($request->get('jogador_id') as  $value) {

            // verifica se o jogador e a data ja existe
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

    public function update(Request $request, presenca $presenca)
    {
        try {
            DB::beginTransaction();
            $presenca->fill($request->all());
            $presenca->presenca = $request->get('presenca') ? 1 : 0 ;
            $presenca->save();
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
    public function destroy(presenca $presenca){
        // se o delete for feito com sucesso retorna para a view
       if($presenca->delete()){
            return redirect()
            ->back()
            ->with('success', 'Jogador Atualizado com sucesso');
       }else{
            return redirect()
            ->back()
            ->with('error', '');
       };
    }
}
