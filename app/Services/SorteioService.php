<?php

namespace App\Services;

use App\Repositories\SorteioRepository;

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
        return;
    }
  
}
