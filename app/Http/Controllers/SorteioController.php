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
            $this->sorteioService->sorteioData($num);           
            return back();

            } catch (ModelNotFoundException $exception) {
                    return back()->withError($exception->getMessage())->withInput();
        }        

    }
}
