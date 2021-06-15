<?php

namespace App\Repositories;

use App\Models\presenca;
use App\Models\jogadores;

class SorteioRepository
{

    public function sorteio($num){
        
        $presentes = presenca::where('presenca', 1)->where('date', date('Y-m-d'))->get();
        $goleiros = [];
        $jogadores = array();

        foreach ($presentes as $value) {                      
           if($value->jogadores->goalkeeper == 1) {
               $goleiros[] = $value->jogador_id ;
           }else{
              $jogadores[] = $value->jogador_id;
                }
        }
        dd($goleiros);
        shuffle($jogadores);
        array_unshift($jogadores, $goleiros[0]);
        
        // foreach( as $key => $goleiro){
        //     array_splice( $jogadores, $num * $key, 0, $goleiro[$key + 1] );       
        // }
       
        $number = $num * 2;
        $presente = count($presentes);

        // if(count($goleiros) <= 2 && $number <= $presente){         
            $object = array_map(function($jogador){
                $jogador = jogadores::find($jogador);               
                return $jogador;
              }, array_chunk($jogadores, $num));      
              dd($object);
              return $object;        

           
        // }else{
        //     return false;
    }
}
