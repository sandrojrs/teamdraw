<?php

namespace App\Repositories;

use App\Models\presenca;

class SorteioRepository
{

    public function sorteio($num){
        $presentes = presenca::where('presenca', 1)->where('date', date('Y-m-d'))->get();  
        $goleiro = 0 ;  
        $jogadores[] = array();
        foreach ($presentes as $value) {   
            $jogadores[] = $value->jogador_id;
           if($value->jogadores->goalkeeper == 1) {
               $goleiro++;
           }
        }     
        $number = $num * 2;        
        $presente = count($presentes);  
        $sorteado[]= array();   
              

         
        //  $total = array_reduce($produtos, function($acumulador, $produto) {           
        //    $grupo = floor(2 / 2);
        //    dd($produto['valor_unitario']);
        // //    $price += $produto['valor_unitario'];
        //    $acumulador[$grupo] = [$acumulador[$grupo]];
        // //    (...($acumulador[$grupo] || [])), $item];
        //    return $acumulador;
        //  });

        dd($this->separar(5));
         
   
        if($goleiro <= 2 && $num <= $presente){         
            foreach ($presentes as $key => $value) {                
                
            }             
        }  
    }    
    
    public function separar($maximo){
        $arrayBase = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
        $dados = [];
        $resultado = [[]];
        $grupo = 0;

        for ($indice = 0; $indice < count($arrayBase); $indice++) {
            if ($resultado[$grupo] === 'undefined') {
            $resultado[$grupo] = [];
            }

            $resultado[$grupo] = ($arrayBase[$indice]);

            if (($indice + 1) % $maximo === 0) {
            $grupo = $grupo + 1;
            }
        }

        return $resultado;

    }

}