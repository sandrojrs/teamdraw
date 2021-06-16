<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SorteioService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SorteioController extends Controller
{

    public function __construct(SorteioService $sorteioService)
    {
        $this->sorteioService = $sorteioService;
    }

    public function index()
    {
        return view('sorteio');
    }
    public function sorteio(Request $request)
    {
        try {
            $num = $request->get('num') ? : 0 ;         
            $sorteios = $this->sorteioService->sorteioData($num);             
            if (!isset($sorteios)){
                return redirect('/sorteio')->with('error', 'Altere o valor para a quantidade que forme um time!');
            }             
            return view('sorteio', compact('sorteios'));           
            
            } catch (ModelNotFoundException $exception) {
                    return back()->withError($exception->getMessage())->withInput();
        }        
    }
}
