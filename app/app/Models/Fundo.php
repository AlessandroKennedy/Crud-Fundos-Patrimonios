<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundo extends Model
{
    use HasFactory;

    public function patrimonios(){
        return $this->hasMany(Patrimonio::class,'fundo_id','id');
    }
}
