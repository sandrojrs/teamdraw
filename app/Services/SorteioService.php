<?php

namespace App\Services;

use App\Repositories\SorteioRepository;
use Illuminate\Http\Request;


class SorteioService
{

    protected $sorteioRepository;

    public function __construct(SorteioRepository  $sorteioRepository)
    {
        $this->sorteioRepository = $sorteioRepository;
    }

    public function sorteioData($num)
    {
        $result = $this->sorteioRepository->sorteio($num);
        if ($result){
            return $result;
        }
        return false;
    }
  
}
