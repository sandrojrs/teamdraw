<?php

namespace App\Repositories;

use App\Models\presenca;
use App\Models\jogador;

class SorteioRepository
{

    public function sorteio($num){

        //tras os dados dos jogadores presentes da data atual
        $presentes = presenca::where('presenca', 1)->where('date', date('Y-m-d'))->get();
        $goleiros = [];
        $jogadores = array();

        //separa jogadore de goleiros adicionando em um array
        foreach ($presentes as $value) {
           if($value->jogadores->goalkeeper == 1) {
               $goleiros[] = $value->jogador_id ;
           }else{
              $jogadores[] = $value->jogador_id;
                }
        }
        //multiplica a quantidade por time para verificar se é possivel formar
        $number = $num * 2;
        //conta o numero de presentes + 2 goleiros
        $presente = count($jogadores ) + 2;

        //verifica se goleiro é maior que dois e se o numero *2 é menor que o numero presente
        if(count($goleiros) >= 2 && $number <= $presente){

        //embaralha o array
        shuffle($jogadores);
        //adiciona o goleiro na posição 0
        array_unshift($jogadores, $goleiros[0]);
         //adiciona o goleiro na posição depois da divisão
        array_splice( $jogadores, $num, 0, $goleiros[1] );
       //verifica se goleiro for maior que 2 adiciona na ultima posição
        if (count($goleiros) > 2){
            for($i= 1; $i <= count($goleiros) - 2; $i++){
                $jogadores[count($jogadores) ] = $goleiros[$i + 1 ];
            }
        }
        //transforma o array com os id's em objeto e depois separa pela quantidade escolhida
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
