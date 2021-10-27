<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    use HasFactory;

    public function fundo(){
        return $this->hasOne(Fundo::class,'id','fundo_id');
    }
}
