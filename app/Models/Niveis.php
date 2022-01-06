<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveis extends Model
{
    use HasFactory;
    protected $table ='niveis';
    protected $fillable = ['nivel'];

    public function desenvolvedores(){
        return $this->belongsTo(Desenvolvedores::class);
    }
}

