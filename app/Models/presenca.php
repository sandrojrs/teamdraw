<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presenca extends Model
{
    protected $fillable=['presenca', 'date'];
    protected $dates = ['date'];

    public function jogadores(){

        return $this->hasOne(jogadores::class, 'id', 'jogador_id');

    }
}
