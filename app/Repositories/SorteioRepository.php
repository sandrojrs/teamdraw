<?php

namespace App\Repositories;

use App\Models\presenca;
use App\Models\jogador;

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
        $number = $num * 2;
        $presente = count($jogadores ) + 2;
        
        if(count($goleiros) >= 2 && $number <= $presente){ 

        shuffle($jogadores);
        array_unshift($jogadores, $goleiros[0]); 
        array_splice( $jogadores, $num, 0, $goleiros[1] );  
        if (count($goleiros) > 2){    
            for($i= 1; $i <= count($goleiros) - 2; $i++){            
                $jogadores[count($jogadores) ] = $goleiros[$i + 1 ];
            }
        }             
        
        $object = array_map(function($jogador){             
            $jogador = jogador::find($jogador);               
            return $jogador;
            }, array_chunk($jogadores, $num));            
            return $object;  
        } else{
            return;
        }
    }
}
