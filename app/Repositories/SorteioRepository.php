<?php

namespace App\Repositories;

use App\Models\presenca;

class SorteioRepository
{

    public function sorteio($num){
        $presentes = presenca::where('presenca', 1)->where('date', date('Y-m-d'))->get();
        $goleiro = 0 ;
        $jogadores = array();
        foreach ($presentes as $value) {
            $jogadores[] = $value->jogador_id;
           if($value->jogadores->goalkeeper == 1) {
               $goleiro++;
           }
        }
        $number = $num * 2;
        $presente = count($presentes);
        shuffle($jogadores);
        dd(array_chunk($jogadores, $num));
        
        if($goleiro <= 2 && $number <= $presente){
            foreach ($presentes as $key => $value) {

            }
        }
    }

}
