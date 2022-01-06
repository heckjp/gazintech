<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenvoledores extends Model
{
    use HasFactory;
    protected $table = 'desenvolvedores';
    protected $fillable = ['nome','sexo','idade','nivel','datanascimento','hobby'];
    
    public function niveis() {
        $this->hasOne(Niveis::class,'nivel');
     }
     
}

