<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presenca extends Model
{
    use HasFactory;
    protected $fillable=['presenca', 'date',];

    public function jogadores(){

        return $this->hasOne(jogadores::class, 'id', 'jogador_id');

    }
}
