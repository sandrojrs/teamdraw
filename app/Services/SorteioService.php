<?php

namespace App\Services;

use App\Repositories\SorteioRepository;

class SorteioService
{
    protected $sorteioRepository;

    //construtor da classe repositories
    public function __construct(SorteioRepository  $sorteioRepository)
    {
        $this->sorteioRepository = $sorteioRepository;
    }

    public function sorteioData($num)
    {
        //passa o valor recebido do controller para o repositories
        $result = $this->sorteioRepository->sorteio($num);
        if ($result){
            return $result;
        }
        return;
    }

}
